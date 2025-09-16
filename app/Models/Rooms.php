<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    const ONE_SINGLE_BED = 1;
    const TWO_SINGLE_BED = 2;
    const THREE_SINGLE_BED = 3;
    const FOUR_SINGLE_BED = 9;
    const ONE_DOUBLE_BED = 4;
    const TWO_DOUBLE_BED = 5;
    const THREE_DOUBLE_BED = 6;
    const ONE_SINGLE_ONE_DOUBLE = 7;
    const ONE_DOUBLE_TWO_SINGLE = 8;
    const OTHER_BED = 9;

    protected $fillable = [
        'name',
        'slug',
        'hotel_id',
        'people',
        'bed',
        'price',
        'sale',
        'detail',
        'size',
        'view',
        'service',
        'surcharge',
        'surcharge_infor',
        'surcharge_check',
        'surcharge_adult',
        'surcharge_child',
        'surcharge_child2',
        'cancel',
        'voucher',
        'status',
        'alt',
        'meta'
    ];

    public function hotel() {
        return $this->belongsTo(Hotels::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImages::class, 'room_id');
    }

    public function orders() {
        return $this->hasMany(Orders::class, 'room_id');
    }

    public function comforts()
    {
        return $this->belongsToMany(Comforts::class, 'room_comforts', 'room_id', 'comfort_id');
    }

    public function listComfort() {
        return $this->comforts->groupBy('parent_id');
    }
}
