<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{
    protected $fillable = [
        'date',
        'total_orders',
        'total_amount',
        'cash_amount',
        'card_amount',
        'qpay_amount',
        'closed_at',
    ];

    protected $casts = [
        'date' => 'date',
        'closed_at' => 'datetime',
    ];

    /**
     * Одоогийн бизнесийн өдрийг тодорхойлно.
     * Хэрэв өнөөдрийн хуанлийн огноо аль хэдийн хаагдсан бол,
     * бодит цаг хэд ч байсан шууд дараагийн өдрийг буцаана.
     */
    public static function currentBusinessDate(): string
    {
        $today = today()->toDateString();

        $lastClosing = static::orderByDesc('date')->first();

        if ($lastClosing && $lastClosing->date->toDateString() >= $today) {
            return $lastClosing->date->copy()->addDay()->toDateString();
        }

        return $today;
    }
}