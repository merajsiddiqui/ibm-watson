<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Language\Natural\Language;

class Understanding extends \IBMWatson\Platform {

	protected $request_api;

	protected $version_date = "2017-02-27";

	public function __construct($configuration_file) {
		$this->configurationProvider($configuration_file);
	}
	/**
	 * Method to analyze the provided data
	 * @param  array $data_to_be_analyzed Data which will be analyzed
	 * @return json                      Analyzed result
	 */
	public function analyze($features, $data) {
		$request_uri = "analyze";
		$features["version"] = (isset($features["version"]) && !empty($features["version"])) ? $features["version"] : $this->version_date;
		$data_type = array_keys($data)[0];
		$data_val = $data[$data_type];
		$features[$data_type] = $data_val;

		$this->requestData($features);
		$analyzed_response = $this->getRequest($request_uri);
		return $analyzed_response;
	}

}