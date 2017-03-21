<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";
//Provide jspn file to config
use IBMWatson\Config;
//json file containing url, username and password for the service
$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/conversation.json";
$config = Config::init($api_credintial_json_file);

use IBMWatson\Language\Natural\Language\Understanding;

$nlu = new Understanding($config);
//See IBM features
$features_to_be_analyzed = [
	"version" => "2017-02-27",
	"features" => "keywords,entities",
	"entities.emotion" => true,
	"entities.sentiment" => true,
	"keywords.emotion" => true,
	"keywords.sentiment" => true,
];
//data to be analyzed
$data_type = "url"; //url, text, html
$data_value = "www.rankwatch.com";
$analyze_data = [$data_type => $data_value];
//analyze this

$analyzed_data = $nlu->analyze($features_to_be_analyzed, $analyze_data);
var_dump($analyzed_data);
