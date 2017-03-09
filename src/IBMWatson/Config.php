<?php

namespace IBMWatson;

class Config {

	protected $config_file;

	public $api_version = "/v1/";

	/**
	 * [__construct description]
	 * @param string $file resource a json file containing username, password, url
	 */
	public function __construct($file) {
		$this->config_file = $file;
	}

	public function getCredentials() {
		return $this->config_file;
	}
}