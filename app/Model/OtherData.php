<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OtherData extends Model {
	protected $table    = 'other_datas';
	protected $fillable = [
		'product_id',
		'data_key',
		'data_value',
	];
}
