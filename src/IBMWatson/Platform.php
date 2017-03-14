<?php

namespace IBMWatson;

use GuzzleHttp\Client;

class Platform {

	/**
	 * UserName for the service
	 * @var string
	 */
	private static $username;
	/**
	 * Password for the same
	 * @var string
	 */
	private static $password;
	/**
	 * API endpointt
	 * @var string
	 */
	protected static $url;
	/**
	 * API url to connect
	 * @param object $config Object of configuration
	 */

	public $method;

	public static $version;

	public function configurationProvider($config) {
		$auth_credentials = Config::getCredentials();
		$this->setCredentials($auth_credentials);
		self::$version = Config::$api_version;
	}

	public function setCredentials($credential_file) {
		$credentials = file_get_contents($credential_file);
		$auth_data = json_decode($credentials, true);
		foreach ($auth_data as $auth_param => $auth_value) {
			self::$$auth_param = $auth_value;
		}
	}

	public function makeRequest($method, $request_method = "GET", $other_params = []) {
		$http = new Client();
		$response = $http->request(
			$request_method,
			self::$url . self::$version . "$method",
			["auth" => [
				self::$username,
				self::$password,
			]],
			$other_params
		);
		return $response->getBody()->getContents();
	}
}