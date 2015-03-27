<?php

use App\App;
use App\ServiceProviders\DraugiemApiProvider;
use App\ServiceProviders\LoggingProvider;
use App\ServiceProviders\MailingProvider;
use App\ServiceProviders\PaymentProvider;
use App\User;

include __DIR__ . '/vendor/autoload.php';

// List all needed providers
$serviceProviders = [
	new LoggingProvider,
	new MailingProvider,
	new DraugiemApiProvider,
	new PaymentProvider,
];

// Register all service providers
foreach($serviceProviders as $v){
	App::registerProvider($v);
}

// Bind logged in user
App::singleton(User::class, function (){
	$user = new User();
	$user->id = 777;
	$user->email = 'mbriedis@gmail.com';
	$user->name = 'Mârtiòð';
	return $user;
});