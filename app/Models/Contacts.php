<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message'
    ];



    public function getCreatedAttribute(){

        return Carbon::parse($this->created_at)->format('H:i d-m-Y');

    }
}
