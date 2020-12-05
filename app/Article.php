<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles_24";

	protected $fillable = [
		'category_id', 
		'slug',
		'cod',
		'name',
		'stock',
		'sale_price',
		'purchase_price',
		'description',
		'photo'
	]; 

	public function getNameAttribute($value)
	{
		return strtoupper($value);
	}

	public function category() {
		return $this->belongsTo(Category::class);
	}
}
