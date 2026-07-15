<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class ExpireReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire pending reservations older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCount = Reservation::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->update(['status' => 'cancelled']);

        $this->info("Expired {$expiredCount} reservations.");
    }
}
