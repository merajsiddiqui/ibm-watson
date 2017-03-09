<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";
//Provide jspn file to config
use IBMWatson\Config;
//json file containing url, username and password for the service
$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/text_to_speech.json";
$config = Config::init($api_credintial_json_file);
/**
 * Service To be used
 */

use IBMWatson\Speech\TextToSpeech;
//provide configuration to service
$voice = new TextToSpeech\Voice($config);
//Use method availables in voice
$available_voices = $voice->getAvailableVoice();
//filter_voice
$filter_by = ["gender" => "female", "language" => "en-US"];
//Above options will be used to find the appropriate voice
$filtered_voice = $voice->filterVoice($filter_by);
//get default voice for watson
$default_voice = $voice->getDefaultVoice();
//Setting desired output for voice
$voice->setPersonVoice($filtered_voice[0]);
//Text which will be converted to audio
$text_content = "Hi Meraj, How are you doing today?";
//calling audio function to convert to audio
$audio = $voice->createAudio($text_content);
var_dump($audio);

?>