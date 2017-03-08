<?php

namespace IBMWatson;

use GuzzleHttp\Client;

class Authenticate {

	/**
	 * UserName for the service
	 * @var string
	 */
	private $username;
	/**
	 * Password for the same
	 * @var string
	 */
	private $password;
	/**
	 * API endpointt
	 * @var string
	 */
	protected $url;
	/**
	 * [__construct description]
	 * @param object $config Object of configuration
	 */
	public function __construct($config) {
		$auth_credentials = $config->getCredentials();
		$this->setCredentials($auth_credentials);
	}

	public function setCredentials($credential_file) {
		$credentials = file_get_contents($credential_file);
		$auth_data = json_decode($credentials, true);
		foreach ($auth_data as $auth_param => $auth_value) {
			$this->$auth_param = $auth_value;
		}
	}

	public function authorize($method) {

		$http = new Client();
		$response = $http->request(
			"GET",
			$this->url . "/$method",
			["auth" => [
				$this->username,
				$this->password,
			]]
		);
		return $response->getBody();
	}
}