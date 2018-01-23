<?php

namespace Raystech\PSUPassport\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Passport Facade
 */
class Passport extends Facade {

	protected static function getFacadeAccessor() {
		return 'psu-passport';
	}
}