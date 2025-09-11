<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduces extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'parent_id',
        'sort',
        'status',
        'default'
    ];

    public function parent()
    {
        return $this->belongsTo(Introduces::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Introduces::class, 'parent_id')->orderBy('sort');
    }
}
