<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RelatedProudct extends Model {
	protected $table    = 'related_proudcts';
	protected $fillable = [
		'product_id',
		'related_product',
	];

	public function product() {
		return $this->hasOne('App\Model\Product', 'id', 'related_product');
	}
}
