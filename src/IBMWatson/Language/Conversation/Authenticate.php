<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */

namespace IBMWatson\Language\Conversation;

class Authenticate extends \IBMWatson\Platform {

	public function __construct($config) {
		$this->configurationProvider($config);
	}
}