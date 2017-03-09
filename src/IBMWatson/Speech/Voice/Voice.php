<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Speech\Voice;
use IBMWatson\Authenticate;

class Voice {

	public $api_version = "v1";

	public $api_method = "voices";

	protected $voice;

	public $available_voices;

	public $speech_voice;

	public function __construct($configuration_file) {
		$this->voice = new Authenticate($configuration_file);

	}

	/**
	 * This method will get all voice available in IBM watson platform
	 * @return array 	voice available
	 */
	public function getAvailableVoice() {
		$this->available_voices = $this->voice->authorize($this->api_version . "/" . $this->api_method)->getContents();
		return json_decode($this->available_voices, true);
	}

	public function filterVoice($filter_options) {
		$err_code = (!$filter_options) ? "no_filter" : "filter_not_found";
		$filtered_voice = ["msg" => $this->errorMessage($err_code)];
		if ($filter_options) {
			$voice_data = json_decode($this->available_voices, true)["voices"];
			for ($i = 0; $i < count($voice_data); $i++) {
				$difference = array_diff_assoc($filter_options, $voice_data[$i]);
				if (!$difference) {
					$filtered_voice[] = $voice_data[$i];
					if (isset($filtered_voice["msg"])) {
						unset($filtered_voice["msg"]);
					}
				}
			}
		}
		return $filtered_voice;
	}

	public function setVoicePerson($voice_detail) {
		$this->speech_voice = $voice_detail;
	}

	protected function errorMessage($err_code) {
		$error_message = [
			"no_filter" => "No Filter Options Were Provided",
			"filter_not_found" => "No data found, Modify Your filter Option and try",
		];
		return $error_message[$err_code];
	}
}