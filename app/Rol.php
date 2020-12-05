<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rols_24";

	protected $fillable = [
		'name', 
		'slug',
		'description'
	];

	public function user() {
        return $this->belongsTo(User::class);
    }
}
