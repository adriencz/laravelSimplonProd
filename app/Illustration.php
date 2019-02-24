<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Illustration extends Model
{
    protected $fillable = ['filename', 'post_id'];

    public $timestamps = false;

    public static $rulesUpdate = [
      'illustration'  => 'mimes:jpeg,jpg,bmp,png|max:4096',
    ];
}
