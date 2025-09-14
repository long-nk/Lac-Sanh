<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'title_seo',
        'slug',
        'summary',
        'content',
        'link',
        'image',
        'user_id',
        'user_update_id',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'user_update_id');
    }

    public function getCreatedAttribute(){
        return Carbon::parse($this->created_at)->format('H:i d-m-Y');
    }
}
