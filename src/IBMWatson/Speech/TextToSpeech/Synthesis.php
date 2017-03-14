<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Speech\TextToSpeech;

class Synthesis extends \IBMWatson\Platform {
	/**
	 * Requset method uri
	 * @var string
	 */
	protected $api_method = "synthesize";
	/**
	 * Speaker name to convert text to
	 * @var string
	 */
	public $voice;
	/**
	 * Accepted Audio formats
	 * @var string
	 */
	public $audio_format;
	/**
	 * Audio Output
	 * @var bytes
	 */
	public $output_file_name;
	/**
	 * This method will convert text into audio
	 * @param  string $text Text to be synthesized
	 * @return [type]       [description]
	 */
	public function textToAudio($text) {
		$requset_uri = $this->buildGetSynthesisUri($text);
		$output = ($this->output_file_name) ?: time();
		$audio_data = $this->getRequest($requset_uri, $output . ".wav");
		return $audio_data;
	}
	/**
	 * Convert the text of a file to audio
	 * @param  string /resource $text_file Path name of the file
	 * @return audio            Converted audio of the text
	 */
	public function textFileToAudio($text_file) {
		$text_data = file_get_contents($text_file);
		$this->textToAudio($text_data);
	}
	/**
	 * This method will set the option to be used by synthesizer
	 * @param array $options parameters to set
	 */
	public function setSynthesisOptions($options) {
		foreach ($options as $param => $value) {
			$this->param = $value;
		}
	}
	/**
	 * Build complete uri for the request for get method
	 * @param  string $text_content Text to synthesize
	 * @return string               A complete uri
	 */
	protected function buildGetSynthesisUri($text_content) {
		$uri = $this->api_method;
		$uri .= "?accept=" . $this->audio_format;
		$uri .= "&text=" . urlencode($text_content);
		$uri .= "&voice=" . $this->voice;
		return $uri;

	}
	/**
	 * Build complete uri for the request for get method
	 * @param  string $text_content Text to synthesize
	 * @return array              A complete uri dataset
	 */
	protected function buildPostSynthesisUri($text_content) {

	}
}