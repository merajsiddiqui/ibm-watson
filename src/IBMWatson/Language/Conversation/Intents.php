<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Language\Conversation;

class Intents extends \IBMWatson\Platform {
	/**
	 * API method to request
	 * @var string
	 */
	public $api_method = "workspaces/";
	/**
	 * API version date
	 * @var string
	 */
	public $version_date = "2017-02-03";
	/**
	 * Local API method uri
	 * @var string
	 */
	public $intent_method = "intents";
	/**
	 * get all intents defined
	 * @param  boolean $export weather export or not
	 * @return json          intent data
	 */
	public function get($workspace_id, $export = false) {
		$request_uri = $this->api_method . $workspace_id . "/" . $this->intent_method . "?version=" . $this->version_date;
		if ($export) {
			$request_uri = $request_uri . "&export=true";
		}
		$intent_response = $this->getRequest($request_uri);
		return $intent_response;
	}
}