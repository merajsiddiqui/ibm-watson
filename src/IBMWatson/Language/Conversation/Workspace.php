<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Language\Conversation;

class Workspace extends \IBMWatson\Platform {

	public $api_method = "workspaces?version=2017-02-03";

	public function list() {
		$workspaces = $this->getRequest($this->api_method);
		return $workspaces;
	}

	public function create($workspace_details) {
		$this->setRequestHeaders(["Content-Type: application/json"]);
		$this->requestData(json_encode($workspace_details));
		$new_workspace_request = $this->postRequest($this->api_method);
		return $new_workspace_request;
	}
}