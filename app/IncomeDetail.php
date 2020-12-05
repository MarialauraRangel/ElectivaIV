<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeDetail extends Model
{
	protected $table = "income_details_24"; 
	
      protected $fillable = [
						  "income_id",
						  "article_id",
						  "quantity",
						  "sale_price",
						];

	public function producto()
	{
		return $this->belongsto(Article::class);
	}
}
