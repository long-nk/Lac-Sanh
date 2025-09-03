<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirects extends Model
{

    protected $fillable = [
        'code',
        'link',
        'redirect',
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
}
