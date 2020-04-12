<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMallProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('mall_products', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('product_id')->unsigned()->nullable();
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
				$table->integer('mall_id')->unsigned()->nullable();
				$table->foreign('mall_id')->references('id')->on('malls')->onDelete('cascade');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('mall_products');
	}
}
