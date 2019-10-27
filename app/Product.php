<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
	protected $fillable = ['name', 'price', 'image', 'description'];

	public function deleteImage(){
		unlink($this->image);
	}
}
