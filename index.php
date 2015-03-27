<?php

use App\App;
use App\Interfaces\Logger;
use App\ServiceProviders\DraugiemApiProvider;
use App\ServiceProviders\LoggingProvider;
use App\ServiceProviders\MailingProvider;

include __DIR__ . '/vendor/autoload.php';

// List all needed providers
$serviceProviders = [
	new LoggingProvider,
	new MailingProvider,
	new DraugiemApiProvider,
];

// Register all service providers
foreach($serviceProviders as $v){
	App::registerProvider($v);
}

$logger = App::make(Logger::class);

var_dump($logger);


var_dump(App::make(DraugiemApi::class));
var_dump(App::make(DraugiemApi::class));
var_dump(App::make(DraugiemApi::class));
