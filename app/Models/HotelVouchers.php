<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelVouchers extends Model
{
    use HasFactory;
    protected $table = 'hotel_vouchers';
    protected $fillable = [
        'hotel_id',
        'voucher_id',
    ];

    public function hotels() {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }

    public function vouchers() {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }
}
