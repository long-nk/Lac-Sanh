<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomComforts extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'comfort_id'];

    public function room() {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
    public function comfort() {
        return $this->belongsTo(Comforts::class, 'comfort_id');
    }
}
