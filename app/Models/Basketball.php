<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basketball extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'type', 'price', 'image'];
}
