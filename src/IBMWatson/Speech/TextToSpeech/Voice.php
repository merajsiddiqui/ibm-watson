<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Speech\TextToSpeech;

class Voice extends \IBMWatson\Platform {
	/**
	 * Method to be called
	 * @var string
	 */
	public $api_method = "voices";
	/**
	 * The request handler
	 * @var object
	 */
	protected $voice;
	/**
	 * Json data of available voice
	 * @var string
	 */
	public $available_voices;
	/**
	 * Voice to be used for converting speech to text
	 * @var array
	 */
	public $speech_voice;
	/**
	 * Default voice person name
	 * @var string
	 */
	public $default_voice = "en-US_MichaelVoice";

	public function __construct($configuration_file) {
		$this->configurationProvider($configuration_file);
	}

	/**
	 * This method will get all voice available in IBM watson platform
	 * @return array 	voice available
	 */
	public function getAvailableVoice() {
		$this->available_voices = $this->makeRequest($this->api_method);
		return json_decode($this->available_voices, true);
	}
	/**
	 * This method filters the abailable voices on IBM watson platform
	 * @param  array $filter_options filter options
	 * @return array                 result of this method
	 */
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
	/**
	 * This method will set person voices
	 * @param array $voice_detail The voice to be used
	 */
	public function setPersonVoice($voice_detail) {
		$this->speech_voice = $voice_detail;
	}
	/**
	 * This method returns apropriate error message for this class
	 * @param  string $err_code error code to get the message
	 * @return string           Error message for provided error code
	 */
	protected function errorMessage($err_code) {
		$error_message = [
			"unknown" => "unknown error occured Please create an issue on https://github.com/merajsiddiqui/ibm-watson/issues",
			"no_filter" => "No Filter Options Were Provided",
			"filter_not_found" => "No data found, Modify Your filter Option and try",
		];
		return (isset($error_message[$err_code]))
		? $error_message[$err_code]
		: $error_message["unknown"];
	}
	/**
	 * This method returns the default voice used by IBM Watson
	 * @return array Default voice detail
	 */
	public function getDefaultVoice() {
		$request_uri = $this->api_method . "/" . $this->default_voice;
		$default_voice_detail = $this->makeRequest($request_uri);
		return json_decode($default_voice_detail, true);
	}

	public function createAudio($txt) {
		$synthesizer = new Synthesis();
		$synthesizer->voice = ($this->speech_voice["name"]) ?: $this->default_voice;
		$synthesizer->audio_format = "audio/wav";
		return $synthesizer->textToAudio($txt);
	}
}