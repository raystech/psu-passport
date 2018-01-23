<?php

namespace Raystech\PSUPassport;

use App\Http\Controllers\Controller;
use \SoapClient;

class PassportController extends Controller {
	private $soapURL;
	private $soapClient;
	private $user;
	private $objUserDetails, $objStaffDetails;
	private $userDetails;
	private $staffDetails;
	private $auth;
	private $isLogin;
	private $username;
	private $credentials;

	function __construct() {
		$this->soapURL = "https://passport.psu.ac.th/authentication/authentication.asmx?wsdl";
		$this->soapClient = new SoapClient($this->soapURL);
	}

	public function Authenticate($username, $password) {
		$this->credentials = array(
			'username' => $username,
			'password' => $password,
		);

		$user = $this->soapClient->Authenticate($this->credentials);

		if ($user->AuthenticateResult) {
			$this->username = $username;
			$this->objStaffDetails = $this->soapClient->GetStaffDetails($this->credentials);
			$this->staffDetails = $this->objStaffDetails->GetStaffDetailsResult->string;
			$this->isLogin = true;
			return true;
		}

		$this->isLogin = false;
		return false;
	}

	public function index() {
		$this->Authenticate('5535512114', 'schWitz!13Apsu');
		dd($this->staffDetails);
	}

}
