<?php

namespace IBMWatson;

class Config {

	protected static $config_file;

	public static $api_version = "/v1/";

	/**
	 * [__construct description]
	 * @param string $file resource a json file containing username, password, url
	 */
	public static function init($file) {
		self::$config_file = $file;
	}

	public static function getCredentials() {
		return self::$config_file;
	}
}