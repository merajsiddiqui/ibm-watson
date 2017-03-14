<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";
//Provide jspn file to config
use IBMWatson\Config;
//json file containing url, username and password for the service
$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/conversation.json";
$config = Config::init($api_credintial_json_file);
/**
 * Setting Conversation Authentication
 */
use IBMWatson\Language\Conversation\Authenticate;
new Authenticate($config);
/**
 * Using Workspace
 */
use IBMWatson\Language\Conversation\Workspace;

$workspaces = new Workspace();

$new_workspace_config = [
	"name" => "API Test",
	"intents" => [],
	"entities" => [],
	"language" => "en",
	"description" => "Workspace Created By Library written By Meraj Ahmad Siddiqui",
	"dialog_nodes" => [],
];
$r = $workspaces->create($new_workspace_config);
var_dump($r);
//
// $all_workspace = $workspaces->list();
// var_dump($all_workspace);