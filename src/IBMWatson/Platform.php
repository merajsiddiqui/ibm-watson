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

	public static $version;

	/**
	 * Data to be posted
	 * @var array
	 */
	public $post_data;
	/**
	 * Request headers to be sent along
	 * @var array
	 */
	public $request_headers;
	/**
	 * File to be posted
	 * @var resource/string
	 */
	public $post_file;

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

	public function setRequestHeaders($headers) {
		$this->request_headers = $headers;
	}

	public function requestData($data) {
		$this->post_data = $data;
	}

	public function attachFile($file_data) {
		$name = array_keys($file_data)[0];
		$resource = $file_data[$name];
		$this->post_file = [
			"name" => $name,
			"contents" => file_get_contents($resource),
		];
	}

	public function getRequest($request_uri) {
		$request_params = [
			"auth" => [
				self::$username,
				self::$password,
			],
			'http_errors' => false,
		];
		$http = new Client();
		$response = $http->request(
			"GET",
			self::$url . self::$version . "$request_uri",
			$request_params
		);
		return $this->responseHandler($response);
	}
	public function postRequest($request_uri) {
		$request_params = [
			"auth" => [
				self::$username,
				self::$password,
			],
			'http_errors' => false,
		];
		if ($this->request_headers) {
			$request_params["headers"] = $this->request_headers;
		}
		if ($this->post_data) {
			$request_params["json"] = $this->post_data;
		}
		if ($this->post_file) {
			$request_params["multipart"] = [$this->post_file];
		}
		$http = new Client();
		$response = $http->post(
			self::$url . self::$version . "$request_uri",
			$request_params
		);
		return $response->getBody()->getContents();
	}
}