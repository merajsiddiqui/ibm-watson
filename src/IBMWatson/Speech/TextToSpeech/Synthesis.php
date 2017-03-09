<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Speech\TextToSpeech;

class Synthesis {
	/**
	 * Requset method uri
	 * @var string
	 */
	protected $api_method = "synthesize";

	protected $synthesizer;
	/**
	 * Voice Class Object
	 * @var object
	 */
	protected $voice;
	/**
	 * Audio formats to accept
	 * @var string
	 */
	public $audio_formats;
	/**
	 * Default voice for the text to be converted
	 * @var string
	 */
	private $default_voice = "en-US_MichaelVoice";

	public function __construct($voiceobject){
		$this->voice = $voiceobject;
	}

	public function 
}