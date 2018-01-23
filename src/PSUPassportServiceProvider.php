<?php

namespace Raystech\PSUPassport;

use Illuminate\Support\ServiceProvider;

class PSUPassportServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		include __DIR__ . '/routes.php';
		$this->app->make('Raystech\PSUPassport\PassportController');
	}
}
