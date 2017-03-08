<?php

namespace IBMWatson\Config;

class Api {

	protected $config_file;

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