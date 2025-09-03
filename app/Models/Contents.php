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

    protected $fillable = [
        'title',
        'slug',
        'file_item_id',
        'image',
        'summary',
        'content',
        'view',
        'type',
        'check',
        'sort',
        'status'
    ];

    public function fileItem(){
        return $this->belongsTo(FileItems::class);
    }

    public function getCreatedAttribute(){
        return Carbon::parse($this->created_at)->format('H:i d-m-Y');
    }
}
