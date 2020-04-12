<?php

namespace App\Jobs;

use App\File;
use App\Model\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stroage;

class ClearEmptyProduct implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Execute the job.
	 *\\App\Jobs\ClearEmptyProduct
	 * @return void
	 */
	public function handle() {
		$products = Product::where('title', '')
			->where('content', '')
			->where('title', '')
			->orWhere('content', null)
			->where('department_id', null)
			->whereDate('created_at', '<', date('Y-m-d'))
			->get();

		foreach ($products as $product) {
			foreach (File::where('file_type', 'product')
					->where('relation_id', $product->id)
					->get() as $file) {
				up()	->delete($file->id);
			}
			Stroage::delete($product->photo);
			Product::find($product->id)->delete();
		}
	}
}
