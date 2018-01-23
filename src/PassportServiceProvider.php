<?php

namespace Raystech\PSUPassport;

use Illuminate\Support\ServiceProvider;

class PassportServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		include __DIR__ . '/routes.php';
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind('psu-passport', function () {
			return new Passport();
		});
		//$this->app->make('Raystech\PSUPassport\PassportController');
	}
}
