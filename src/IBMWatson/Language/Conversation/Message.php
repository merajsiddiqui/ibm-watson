<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Language\Conversation;

class Message extends \IBMWatson\Platform {

	public $api_method = "workspaces/";

	public $version_date = "2017-02-03";

	public function sendMessage($workspace_id, $message) {
		$this->setRequestHeaders(["Content-Type: application/json"]);
		$this->requestData($message);
		$method = "/message";
		$request_uri = $this->api_method . $workspace_id . $method . "?version=" . $this->version_date;
		$response = $this->postRequest($request_uri);
		return $response;
	}
}