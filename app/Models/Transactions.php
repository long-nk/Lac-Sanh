<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'check_in',
        'check_out',
        'payment',
        'note',
        'status',
        'total',
        'reason'
    ];
}
