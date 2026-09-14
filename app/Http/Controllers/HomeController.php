<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Models\Reservation;

class HomeController extends Controller
{
    public function index()
    {
        // Auto-migrate & seed jika tabel belum ada di database cloud
        if (!Schema::hasTable('announcements') || !Schema::hasTable('fields')) {
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
        }

        Reservation::cleanupExpired();
        
        $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();
        
        $fields = \App\Models\Field::where('is_active', true)->get();
        
        $bookedSlots = Reservation::where('status', '!=', 'cancelled')
            ->where('reservation_date', '>=', now()->toDateString())
            ->get(['reservation_date', 'start_time', 'duration', 'field_id']);
            
        return view('home', compact('announcements', 'bookedSlots', 'fields'));
    }
}
