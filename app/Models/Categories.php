<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'image',
        'svg',
        'slug',
        'intro',
        'status',
        'sort',
        'link',
        'check'
    ];
}
