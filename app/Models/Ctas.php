<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctas extends Model
{

    protected $fillable = [
        'title',
        'name',
        'link',
        'image',
        'alt',
        'meta',
        'sort',
        'status',
        'user_id',
        'user_update_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'user_update_id');
    }

    public function getUrlImageAttribute()
    {
        return asset($this->image);
    }

}
