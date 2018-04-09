<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     protected $fillable = ['title', 'synopsis', 'cover', 'user_id'];

     public function chapters()
     {
     	return $this->hasMany(Chapter::class);
     }
}
