<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";
use IBMWatson\Config;
use IBMWatson\Speech\Voice;
$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/text_to_speech.json";
//configuring api with its credentials
$configure_api = new Config($api_credintial_json_file);
//authenticate using credntials

$filter = ["gender" => "femele"];

$voice = new Voice\Voice($configure_api);
$available_voices = $voice->getAvailableVoice();
$filtered_voice = $voice->filterVoice($filter);
var_dump($filtered_voice);
?>