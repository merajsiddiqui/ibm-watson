<?php

include dirname(dirname(__DIR__)) . "/vendor/autoload.php";
//Provide jspn file to config
use IBMWatson\Config;
//json file containing url, username and password for the service
$api_credintial_json_file = dirname(dirname(__DIR__)) . "/config/language_translator.json";
$config = Config::init($api_credintial_json_file);

use IBMWatson\Language\LanguageTranslator\Translator;
/**
 * Providing config to Translator
 * @var Translator
 */
$translator = new Translator($config);

$language_supported = $translator->getSupportedLanguage();

$language_set = [
	"from" => "en",
	"to" => "es",
];
$translator->setLanguage($language_set);

$text = "PHP Developer, I code to change the world's work flow";

$translated = $translator->translate($text);
//all models
$models = $translator->listModels();
//conversationa Models
$conver_models = $translator->listConversationalModels();

//Creating new model
/**
 * Creating a new model requires a glossary to used by watson
 * a tmx file (Translation Memory Echange ) by which the translation will work
 * a sample tms file is provided
 */

$glossary_tmx = "custom_model.tmx";
$new_model_details = [
	"name" => "custom-englis-to-bhojpuri",
	"base_model_id" => "en-es",
	"glossary" => $glossary_tmx,
];

$new_model = $translator->createModel($new_model_details);
var_dump($new_model);