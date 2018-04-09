<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseChapters extends Model
{
	protected $table = "purchase_chapters";
	
    protected $fillable = [
    	'chapter_id', 'user_id'
    ];
}
