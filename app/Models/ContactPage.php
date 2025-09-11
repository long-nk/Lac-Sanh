<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    use HasFactory;

    protected $table = 'contact_page';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'image2',
        'content',
        'parent_id',
        'sort',
        'status',
        'default'
    ];

    public function parent()
    {
        return $this->belongsTo(ContactPage::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(ContactPage::class, 'parent_id')->orderBy('sort');
    }
}
