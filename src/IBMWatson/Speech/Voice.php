<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Speech;
use IBMWatson\Authenticate;

class Voice {

	public $api_version = "v1";

	public $api_method = "voices";

	protected $voice;

	public $available_voices;

	public function __construct($configuration_file) {
		$this->voice = new Authenticate($configuration_file);

	}

	public function getAvailableVoice($filter = false) {
		$this->available_voices = $this->voice->authorize($this->api_version . "/" . $this->api_method)->getContents();
		return $this->available_voices;
	}

	public function filterVoice($filter_options) {
		$filtered_voice = ["msg" => "No data found, try another filter options"];
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
		return $filtered_voice;
	}
}