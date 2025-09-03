<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory;
    const CHO_DUYET = 0;
    const DAT_THANH_CONG = 1;
    const HUY_DON = 2;
    const HOAN_THANH = 3;

    use SoftDeletes;


    protected $fillable = [
        'username',
        'phone_number',
        'email',
        'room_id',
        'hotel_id',
        'number',
        'people',
        'child',
        'price',
        'sale',
        'surcharge',
        'payment',
        'total',
        'voucher',
        'check_in',
        'check_out',
        'status'
    ];

    protected $dates = ['check_in', 'check_out'];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function room() {
        return $this->belongsTo(Rooms::class);
    }

    public function hotel() {
        return $this->belongsTo(Hotels::class);
    }

    public function getFormattedCheckinAttribute()
    {
        Carbon::setLocale('vi');
        return $this->check_in ? $this->customDateFormat($this->check_in) : null;
    }

    public function getFormattedCheckoutAttribute()
    {
        Carbon::setLocale('vi');
        return $this->check_out ? $this->customDateFormat($this->check_out) : null;
    }

    public function getDaysDifferenceAttribute()
    {
        if ($this->check_in && $this->check_out) {
            $hours = $this->check_in->diffInHours($this->check_out);
            $days = ceil($hours / 24);
            return $days;
        }
        return null;
    }

    private function customDateFormat($date)
    {
        $dayOfWeekMap = [
            'Monday' => 'T2',
            'Tuesday' => 'T3',
            'Wednesday' => 'T4',
            'Thursday' => 'T5',
            'Friday' => 'T6',
            'Saturday' => 'T7',
            'Sunday' => 'CN'
        ];

        $dayOfWeek = $dayOfWeekMap[$date->format('l')];
        $day = $date->format('d');
        $month = $date->translatedFormat('F');

        return "{$dayOfWeek}, {$day} {$month}";
    }
}
