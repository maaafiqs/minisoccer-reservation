<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        \App\Models\Reservation::cleanupExpired();

        // 1. Total Pendapatan (Status: paid, accepted, completed/selesai)
        $totalRevenue = Reservation::whereIn('status', ['paid', 'accepted', 'completed', 'diterima', 'selesai'])->sum('total_price');
        
        // 2. Total Reservasi (Semua kecuali yang cancelled)
        $totalReservations = Reservation::where('status', '!=', 'cancelled')->count();
        
        // 3. Pengguna Terdaftar (Hanya role user)
        $totalUsers = User::where('role', 'user')->count();
        
        // 4. Transaksi Terbaru (5 Terakhir)
        $recentTransactions = Reservation::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        // 5. Data Chart 7 Hari Terakhir
        $chartLabels = [];
        $chartDataRegular = [];
        $chartDataEvent = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $dateString = $date->format('Y-m-d');
            $chartLabels[] = $date->translatedFormat('d M');
            
            $regularCount = Reservation::where('reservation_date', $dateString)
                ->where('status', '!=', 'cancelled')
                ->where(function($q) {
                    $q->where('type', 'regular')->orWhereNull('type');
                })
                ->count();
                
            $eventCount = Reservation::where('reservation_date', $dateString)
                ->where('status', '!=', 'cancelled')
                ->where('type', 'event')
                ->count();
                
            $chartDataRegular[] = $regularCount;
            $chartDataEvent[] = $eventCount;
        }

        return view('admin.dashboard', compact('totalRevenue', 'totalReservations', 'totalUsers', 'recentTransactions', 'chartLabels', 'chartDataRegular', 'chartDataEvent'));
    }

    public function reservations()
    {
        \App\Models\Reservation::cleanupExpired();
        
        $reservations = Reservation::with('user', 'voucher')->orderBy('reservation_date', 'desc')->orderBy('start_time', 'desc')->paginate(15);
        return view('admin.reservations', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate(['status' => 'required|in:pending,paid,accepted,cancelled']);
        $reservation->update(['status' => $request->status]);

        if (in_array($request->status, ['accepted', 'cancelled'])) {
            $reservation->user->notify(new \App\Notifications\ReservationStatusUpdated($reservation));
        }

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success', 'Riwayat reservasi berhasil dihapus.');
    }
}
