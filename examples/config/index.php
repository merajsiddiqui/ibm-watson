<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";
use IBMWatson\Config;
use IBMWatson\Speech\Voice;
$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/text_to_speech.json";
//configuring api with its credentials
$configure_api = new Config\Api($api_credintial_json_file);
//authenticate using credntials

$filter = ["gender" => "male", "language" => "en-US"];

$voice = new Voice($configure_api);
$available_voices = $voice->getAvailableVoice($filter);
var_dump($available_voices);
?>