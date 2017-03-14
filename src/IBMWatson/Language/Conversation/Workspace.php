<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Language\Conversation;

class Workspace extends \IBMWatson\Platform {

	public $api_method = "workspaces";

	public $version_date = "2017-02-03";

	public function list() {
		$request_uri = $this->api_method . "?version=" . $this->version_date;
		$workspaces = $this->getRequest($request_uri);
		return $workspaces;
	}

	public function create($workspace_details) {
		$this->setRequestHeaders(["Content-Type: application/json"]);
		$this->requestData($workspace_details);
		$request_uri = $this->api_method . "?version=" . $this->version_date;
		$new_workspace_request = $this->postRequest($request_uri);
		return $new_workspace_request;
	}

	public function get($workspace_id) {
		$request_uri = $this->api_method . "/" . $workspace_id . "?version=" . $this->version_date;
		$workspace_details = $this->getRequest($request_uri);
		return $workspace_details;
	}

	public function delete() {

	}
}