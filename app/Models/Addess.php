<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addess extends Model
{
    use HasFactory;

    protected $table = "address";

    protected $fillable = [
        'name',
        'address',
        'status'
    ];
}
