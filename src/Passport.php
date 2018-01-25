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
		}
		return $this;
	}
	public function getUserDetails() {
		if(!$this->auth) return false;
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
		$userDetails->affiliation = $this->userDetails[8];
		$userDetails->campus = $this->userDetails[10];

		$details_tmp = explode(',', $this->userDetails[14]);
		$userDetails->status = explode('=', $details_tmp[4])[1];
		$userDetails->details = $details_tmp;

		return $userDetails;
	}

	public function getStaffDetails() {
		$this->objStaffDetails = $this->soapClient->GetStaffDetails($this->credentials);
		$this->staffDetails = $this->objStaffDetails->GetStaffDetailsResult->string;
		return $this->staffDetails;
	}

	public function auth() {
		return $this->auth;
	}

	public function status() {
		if(!$this->auth) {
			return false;
		} else {
			return $this->getUserDetails()->status;
		}
	}
}
