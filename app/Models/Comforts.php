<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comforts extends Model
{
    use HasFactory;

    const KS = 0;
    const TO = 1;
    const HS = 2;
    const RS = 3;
    const DT = 4;
    const RM = 5;
    protected $table = "comforts";

    protected $fillable = [
        'parent_id',
        'name',
        'image',
        'special',
        'check',
        'status',
        'type'
    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotels::class, 'hotel_comforts', 'comfort_id', 'hotel_id');
    }

    public function rooms() {
        return $this->belongsToMany(Rooms::class, 'room_comforts', 'comfort_id', 'room_id');
    }

    public function children()
    {
        return $this->hasMany(Comforts::class, 'parent_id');
    }

    // Định nghĩa mối quan hệ cha (nếu cần)
    public function parent()
    {
        return $this->belongsTo(Comforts::class, 'parent_id');
    }
}
