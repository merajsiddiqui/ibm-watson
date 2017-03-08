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
		$voice = $this->voice->authorize($this->api_version . "/" . $this->api_method)->getContents();
		$this->voice = $voice;
		if ($filter) {
			return $this->filterVoice($filter);
		} else {
			return $voice;
		}
	}

	protected function filterVoice($options) {
		$filtered_voice = [];
		$voice_data = json_decode($this->voice, true)["voices"];
		for ($i = 0; $i < count($voice_data); $i++) {
			$found = false;
			foreach ($options as $filter_param => $filter_value) {
				$found = ($voice_data[$i][$filter_param] == $filter_value && $found != false) ? true : false;
			}
			if ($found) {
				$filtered_voice[] = $voice_data[$i];
			}
		}
		return $filtered_voice;
	}
}