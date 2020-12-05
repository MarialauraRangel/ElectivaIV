<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories_24";

	protected $fillable = [
		'name', 
		'slug',
		'description'
	];

	public function articles() {
        return $this->hasMany(Article::class);
    }
}
