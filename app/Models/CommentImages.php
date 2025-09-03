<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentImages extends Model
{
    use HasFactory;

    protected $table = "comment_images";

    protected $fillable = [
        'comment_id',
        'name',
        'mime',
        'size',
        'path'
    ];

    public function comment() {
        return $this->belongsTo(Comments::class);
    }
}
