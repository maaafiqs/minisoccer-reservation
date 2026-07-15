<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;

class HomeController extends Controller
{
    public function index()
    {
        \App\Models\Reservation::cleanupExpired();
        
        $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();
        
        $fields = \App\Models\Field::where('is_active', true)->get();
        
        $bookedSlots = Reservation::where('status', '!=', 'cancelled')
            ->where('reservation_date', '>=', now()->toDateString())
            ->get(['reservation_date', 'start_time', 'duration', 'field_id']);
            
        return view('home', compact('announcements', 'bookedSlots', 'fields'));
    }
}
