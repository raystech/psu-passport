<?php

namespace Raystech\PSUPassport;

use App\Http\Controllers\Controller;
use \SoapClient;

class Passport extends Controller {
	private $soapURL;
	private $soapClient;
	private $user;
	protected $objUserDetails, $objStaffDetails;
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

	public function authenticate($credentials) {
		$this->credentials = array(
			'username' => $credentials['username'],
			'password' => $credentials['password'],
		);
		$this->auth = $this->soapClient->Authenticate($this->credentials)->AuthenticateResult;
		if ($this->auth) {
			$this->username = $credentials['username'];
			return $this;
		}
		return null;
	}
	public function getUserDetails() {
		$this->objUserDetails = $this->soapClient->GetUserDetails($this->credentials);
		$this->userDetails = $this->objUserDetails->GetUserDetailsResult->string;
		$userDetails = new \stdClass();
		$userDetails->username = $this->userDetails[0];
		$userDetails->title = $this->userDetails[12];
		$userDetails->firstname = $this->userDetails[1];
		$userDetails->lastname = $this->userDetails[2];

		$userDetails->gender = $this->userDetails[4];
		$userDetails->pid = $this->userDetails[5];
		$userDetails->email = $this->userDetails[13];
		//$userDetails->lastname = $this->userDetails[6];
		//$userDetails->lastname = $this->userDetails[7];
		$userDetails->major = $this->userDetails[8];
		$userDetails->campus = $this->userDetails[10];

		return $userDetails;
	}

	public function getStaffDetails() {
		$this->objStaffDetails = $this->soapClient->GetStaffDetails($this->credentials);
		$this->staffDetails = $this->objStaffDetails->GetStaffDetailsResult->string;
	}

	public function auth() {
		return $this->auth;
	}
}
