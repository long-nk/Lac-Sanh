<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'percent',
        'term',
        'status',
        'start_date',
        'end_date',
        'check_all',
        'hotel',
        'villa',
        'homestay',
        'resort',
        'yacht',
        'tour',
        'image',
        'number',
        'used',
        'cost'
    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotels::class, 'hotel_vouchers', 'voucher_id', 'hotel_id');
    }

    public function tours()
    {
        return $this->belongsToMany(Tours::class, 'tour_vouchers', 'voucher_id', 'tour_id');
    }

    public function hotelVouchers()
    {
        return $this->hasMany(HotelVouchers::class, 'voucher_id');
    }
}
