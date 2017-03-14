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

$text = "This watson library is written By Meraj Ahmad Siddiqui";

$translated = $translator->translate($text);
var_dump($translated);