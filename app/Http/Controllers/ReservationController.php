<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        \App\Models\Reservation::cleanupExpired();
        
        $reservations = Auth::user()->reservations()->orderBy('reservation_date', 'desc')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        \App\Models\Reservation::cleanupExpired();
        
        $fields = \App\Models\Field::where('is_active', true)->get();
        return view('reservations.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:regular,event',
            'event_name' => 'required_if:type,event|nullable|string|max:255',
            'field_id' => 'required|exists:fields,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i:s',
            'duration' => 'required|integer|min:1|max:12',
            'voucher_code' => 'nullable|string'
        ]);

        if ($request->type === 'event') {
            $minDate = \Carbon\Carbon::today()->addDays(3);
            $requestedDate = \Carbon\Carbon::parse($request->reservation_date);
            if ($requestedDate->lt($minDate)) {
                return back()->withErrors(['reservation_date' => 'Khusus tipe Acara/Turnamen, reservasi harus dilakukan minimal H-3 dari tanggal bermain.']);
            }
        }

        $date = $request->reservation_date;
        $time = $request->start_time;
        $duration = $request->duration;
        
        // Prevent dadakan/past hour booking
        if ($date == \Carbon\Carbon::today()->format('Y-m-d')) {
            $currentHour = \Carbon\Carbon::now()->hour;
            $requestedHour = (int) substr($time, 0, 2);
            if ($requestedHour <= $currentHour) {
                return back()->withErrors(['start_time' => 'Tidak bisa pesan dadakan untuk waktu yang sudah terlewat atau terlalu mepet.']);
            }
        }
        
        // Cek satu kali booking per hari
        $existingBooking = Reservation::where('user_id', Auth::id())
            ->where('reservation_date', $date)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['reservation_date' => 'Maaf, Anda hanya diperbolehkan membuat satu reservasi per harinya.']);
        }
        
        // Cek bentrok
        $startTime = strtotime($time);
        for ($i = 0; $i < $duration; $i++) {
            $checkTime = date('H:i:s', $startTime + ($i * 3600));
            $isBooked = Reservation::where('field_id', $request->field_id)
                ->where('reservation_date', $date)
                ->where('status', '!=', 'cancelled')
                ->where(function($query) use ($checkTime) {
                    $query->whereRaw("? >= start_time AND ? < ADDTIME(start_time, SEC_TO_TIME(duration * 3600))", [$checkTime, $checkTime]);
                })->exists();
                
            if ($isBooked) {
                return back()->withErrors(['start_time' => 'Jadwal pada jam ' . $checkTime . ' di lapangan ini sudah terisi.']);
            }
        }

        $field = \App\Models\Field::findOrFail($request->field_id);
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;
        $isWeekend = ($dayOfWeek == \Carbon\Carbon::SATURDAY || $dayOfWeek == \Carbon\Carbon::SUNDAY);
        $isNight = \Carbon\Carbon::parse($time)->hour >= 18;

        if ($isWeekend) {
            $pricePerHour = $field->weekend_price;
        } else {
            $pricePerHour = $isNight ? $field->weekday_night_price : $field->weekday_day_price;
        }

        $totalPrice = $pricePerHour * $duration;
        $voucherId = null;

        if ($request->voucher_code) {
            $voucher = Voucher::where('code', $request->voucher_code)->where('is_active', true)->first();
            if ($voucher) {
                if ($voucher->type === 'percent') {
                    $discount = ($totalPrice * $voucher->discount_amount) / 100;
                    $totalPrice -= $discount;
                } else {
                    $totalPrice -= $voucher->discount_amount;
                }
                $voucherId = $voucher->id;
            } else {
                return back()->withErrors(['voucher_code' => 'Voucher tidak valid atau kadaluarsa.']);
            }
        }

        // Generate Reservation Number
        $latest = Reservation::latest('id')->first();
        $nextId = $latest ? $latest->id + 1 : 1;
        $reservationNumber = 'RES-' . date('Ymd', strtotime($date)) . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        Reservation::create([
            'reservation_number' => $reservationNumber,
            'user_id' => Auth::id(),
            'voucher_id' => $voucherId,
            'field_id' => $request->field_id,
            'type' => $request->type,
            'event_name' => $request->type === 'event' ? $request->event_name : null,
            'reservation_date' => $date,
            'start_time' => $time,
            'duration' => $duration,
            'price_per_hour' => $pricePerHour,
            'total_price' => max(0, $totalPrice),
            'status' => 'pending'
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function paymentView(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reservations.pay', compact('reservation'));
    }

    public function pay(Request $request, Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $reservation->update([
                'status' => 'paid',
                'payment_proof' => $path
            ]);
        }
        
        return redirect()->route('reservations.index')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
    }

    public function printPdf(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Fallback since DomPDF failed to install
        return view('reservations.print', compact('reservation'));
    }

    public function checkVoucher(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $voucher = Voucher::where('code', $request->code)->where('is_active', true)->first();
        if ($voucher) {
            return response()->json([
                'valid' => true,
                'type' => $voucher->type,
                'discount_amount' => $voucher->discount_amount
            ]);
        }
        return response()->json(['valid' => false]);
    }

    public function getAvailableSlots(Request $request)
    {
        \App\Models\Reservation::cleanupExpired();
        
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        
        $reservations = Reservation::where('field_id', $request->field_id)
            ->where('status', '!=', 'cancelled')
            ->whereBetween('reservation_date', [\Carbon\Carbon::parse($request->start)->format('Y-m-d'), \Carbon\Carbon::parse($request->end)->format('Y-m-d')])
            ->get();
            
        $events = [];
        foreach($reservations as $res) {
            $startDateTime = $res->reservation_date . 'T' . $res->start_time;
            $endDateTime = \Carbon\Carbon::parse($startDateTime)->addHours($res->duration)->format('Y-m-d\TH:i:s');
            
            $events[] = [
                'title' => 'Terisi',
                'start' => $startDateTime,
                'end' => $endDateTime,
                'color' => '#ef4444', // red
                'allDay' => false
            ];
        }
        
        return response()->json($events);
    }
}
