<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;

    const WIDTH_THUMBS = 600;
    const TIN_TUC = 1;
    const CHINH_SACH = 2;

    const NEWS = 1;
    const TERM = 2;

    protected $fillable = [
        'title',
        'title_seo',
        'slug',
        'file_item_id',
        'image',
        'alt',
        'meta',
        'summary',
        'content',
        'view',
        'type',
        'check',
        'link',
        'video',
        'user_id',
        'user_update_id',
        'status',
        'parent_id',
        'sort',
        'star',
        'point',
        'deleted_at',
        'created_at',
        'updated_at',
        'script'
    ];

    public function fileItem(){
        return $this->belongsTo(FileItems::class);
    }

    public function getCreatedAttribute(){
        return Carbon::parse($this->created_at)->format('H:i d-m-Y');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'content_id')->whereNull('type');
    }

    public function parent()
    {
        return $this->belongsTo(Contents::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Contents::class, 'parent_id')->orderBy('sort');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'user_update_id');
    }


    public function questions()
    {
        return $this->belongsToMany(Questions::class, 'question_contents', 'content_id', 'question_id')->where('type', 1);
    }

}
