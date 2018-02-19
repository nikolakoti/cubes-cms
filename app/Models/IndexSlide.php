<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexSlide extends Model
{
	protected $table = 'index_slides';
	
	protected $fillable = ['title', 'url', 'description', 'photo_filename', 'status', 'order_number'];
}
