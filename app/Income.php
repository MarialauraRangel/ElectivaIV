<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Income extends Model
{
	protected $table = "incomes_24";

     protected $fillable = [
						  "vaucher",
						  "tax",
						  "total",
						  "provider_id",
						  "saler_id"
						];


	public function vendedor()
	{
		return $this->belongsTo(User::class, 'saler_id', 'id');
	}

	public function provider()
	{
		return $this->belongsTo(User::class, 'provider_id', 'id');
	}

	public function productos()
	{
		return $this->hasMany(IncomeDetail::class);
	}




	public static function codigo()
    {
        $lastId = self::latest()->first();

        if (!$lastId) {
            $codigo = (str_pad((int) 1, 4, '0', STR_PAD_LEFT));
        } else {
            $codigo = (str_pad((int) $lastId->id + 1, 4, '0', STR_PAD_LEFT));
        }

        return $codigo;
    }

   
}
