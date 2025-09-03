<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileItems extends Model
{
    use HasFactory;

    protected $table = "file_items";

    protected $fillable = [
        'name',
        'mime',
        'size',
        'path'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
        return $this->hasOne(Contents::class, 'file_item_id');
    }


    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return asset('images/uploads/' . $this->path . '/' . $this->name);
    }

    /**
     * @return string
     */
    public function getUrlThumbsAttribute()
    {
        return asset('images/uploads/thumbs/'. $this->name);
    }
}
