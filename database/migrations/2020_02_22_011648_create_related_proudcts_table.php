<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedProudctsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('related_proudcts', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('product_id')->unsigned()->nullable();
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

				$table->integer('related_product')->unsigned()->nullable();
				$table->foreign('related_product')->references('id')->on('products')->onDelete('cascade');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('related_proudcts');
	}
}
