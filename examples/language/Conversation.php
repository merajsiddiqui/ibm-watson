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
use IBMWatson\Language\Conversation\Message;
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
// $r = $workspaces->create($new_workspace_config);
// var_dump($r);
//
$all_workspace = $workspaces->list();

$workspace_id = "13f9d056-97e9-4fb6-b467-c3fc27e55da8";

$workspace_details = $workspaces->get($workspace_id);

$messanger = new Message();
$message = [
	"input" => ["text" => "Turn on the lights"],
	"context" => ["conversation_id" => ""],
	"system" => [
		"dialog_stack" => [
			"dialog_node" => "root",
			"dialog_turn_counter" => 1,
			"dialog_request_counter" => 1,
		],
	],
];

$new_message = $messanger->sendMessage($workspace_id, $message);
var_dump($new_message);