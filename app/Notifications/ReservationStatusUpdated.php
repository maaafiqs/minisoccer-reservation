<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Reservation;

class ReservationStatusUpdated extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $statusMap = [
            'accepted' => 'diterima',
            'cancelled' => 'dibatalkan',
            'paid' => 'sudah dibayar',
        ];
        
        $statusIndo = $statusMap[$this->reservation->status] ?? $this->reservation->status;

        return new DatabaseMessage([
            'reservation_id' => $this->reservation->id,
            'message' => 'Reservasi dengan nomor ' . $this->reservation->reservation_number . ' telah ' . $statusIndo . '.',
            'url' => route('reservations.index')
        ]);
    }
}
