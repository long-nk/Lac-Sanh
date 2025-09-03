<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourVouchers extends Model
{
    use HasFactory;
    protected $table = 'tour_vouchers';
    protected $fillable = [
        'tour_id',
        'voucher_id',
    ];

    public function tours() {
        return $this->belongsTo(Tours::class, 'tour_id');
    }

    public function vouchers() {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }
}
