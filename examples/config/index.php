<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";

use IBMWatson\Authenticate;
use IBMWatson\Config;

$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/text_to_speech.json";
//configuring api with its credentials
$configure_api = new Config\Api($api_credintial_json_file);
//authenticate using credntials
//
$auth = new Authenticate($configure_api);
var_dump($auth->authorize("v1/voices"));
?>