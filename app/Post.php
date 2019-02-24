<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'illustration'];

    public static $rules = [
      'title'         => 'required|max:255',
      'illustration'  => 'mimes:jpeg,jpg,bmp,png|required|max:4096',
      'content'       => 'required',
    ];

    public static $rulesUpdate = [
      'title'         => 'required|max:255',
      'content'       => 'required',
    ];

    public function illustration()
    {
      return $this->hasOne('App\Illustration', 'post_id', 'id');
    }
}
