<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	
		
    protected $fillable = [
		'parent_id', 'short_title', 'title', 'description', 'photo_filename', 'body',
		'status', 'order_number'
	];
	
	public function isEnabled() {
		return $this->status == 1;
	}
        
        public function frontendUrl() {
            
            return route('static-page', [
                
                'id' => $this->id,
                'slug' => str_slug($this->title)
            ]);
        }
}
