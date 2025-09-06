<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tour_id',
        'detail',
        'sort',
        'status'
    ];

    public function tour() {
        return $this->belongsTo(Tours::class);
    }

}
