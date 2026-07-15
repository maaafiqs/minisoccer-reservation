<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'event_name', 'reservation_number', 'user_id', 'voucher_id', 'field_id', 'reservation_date', 'start_time',
        'duration', 'price_per_hour', 'total_price', 'status', 'payment_proof'
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'start_time' => 'datetime:H:i',
    ];

    /**
     * Hapus reservasi yang berstatus pending dan sudah melewati batas waktu 24 jam.
     */
    public static function cleanupExpired()
    {
        self::where('status', 'pending')
            ->where('created_at', '<', now()->subHours(24))
            ->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
