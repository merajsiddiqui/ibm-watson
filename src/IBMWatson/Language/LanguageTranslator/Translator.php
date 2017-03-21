<?php

/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 */
namespace IBMWatson\Language\LanguageTranslator;

class Translator extends \IBMWatson\Platform {

	/**
	 * API method url to request
	 * @var string
	 */
	public $api_method = "translate";
	/**
	 * API version as in API refrence
	 * @var string
	 */
	public $api_version = "/v2/";
	/**
	 * Language source from the language to be converted
	 * @var string
	 */
	public $source_language;
	/**
	 * Language to Which to translate
	 * @var string
	 */
	public $target_language;
	/**
	 * Content to be translated
	 * @var string
	 */
	public $content;
	/**
	 * Construct to make credentials available for requests
	 * @param string $configuration_file resource containing auth details
	 */
	public function __construct($configuration_file) {
		$this->configurationProvider($configuration_file);
		self::$version = $this->api_version;
	}
	/**
	 * Setting language for translation
	 * @param array $language_code containing source and target language
	 */
	public function setLanguage($language_code) {
		$this->source_language = $language_code["from"];
		$this->target_language = $language_code["to"];
	}
	/**
	 * buildRequest query to make request to translate the content
	 */
	public function buildRequestQuery() {
		//translate?source=en&target=es&text=hello"
		$request_query = $this->api_method;
		$request_query .= "?source=" . $this->source_language;
		$request_query .= "&target=" . $this->target_language;
		$request_query .= "&text=" . $this->content;
		return $request_query;
	}
	/**
	 * This method is responsible to translate the content
	 * @param  string $content Content to be translated
	 * @return string          translated content
	 */
	public function translate($content) {
		$this->content = $content;
		$request_uri = $this->buildRequestQuery();
		$translated_content = $this->getRequest($request_uri);
		return $translated_content;
	}
	/**
	 * Get all supported language by IBM watson
	 * @return string json data
	 */
	public function getSupportedLanguage() {
		$request_uri = "identifiable_languages";
		return $this->getRequest($request_uri);
	}
	/**
	 * List all models supported by IBM watson
	 * @return strong json data of all models
	 */
	public function listModels() {
		$request_uri = "models";
		return $this->getRequest($request_uri);
	}
	/**
	 * Listing All models supporting conversation
	 * @return string json data for all conversational models
	 */
	public function listConversationalModels() {
		$domain = "conversational";
		$all_models_json = $this->listModels();
		$all_models_array = json_decode($all_models_json, true)["models"];
		$conversational_models = [];
		for ($i = 0; $i < count($all_models_array); $i++) {
			if ($all_models_array[$i]["domain"] == $domain) {
				$conversational_models[] = $all_models_array[$i];
			}
		}
		return json_encode($conversational_models, JSON_PRETTY_PRINT);
	}
	/**
	 * Create new model to be used by IBM watson
	 * @param  array $model_detail model parameters
	 * @return string               identifier of the new model
	 */
	public function createModel($model_detail) {
		$glossary = ["forced_glossary" => $model_detail["glossary"]];
		unset($model_detail["glossary"]);
		$this->requestData($model_detail);
		$this->attachFile($glossary);
		$request_uri = "models";
		$response = $this->postRequest($request_uri);
		return $response;
	}
	/**
	 * Get model details by model id
	 * @param  string $model_id model identifier
	 * @return json           model details for give identifier
	 */
	public function getModelDetails($model_id) {
		$request_uri = "models/$model_id";
		$model_detail = $this->getRequest($request_uri);
		return $model_detail;
	}
	/**
	 * Delete a model by providing a model identifier
	 * @param  string $model_id model identifier
	 * @return string           ok else error message
	 */
	public function deleteModel($model_id) {
		$request_uri = "models/$model_id";
		$deleted = $this->deleteRequest($request_uri);
		return $deleted;
	}
}