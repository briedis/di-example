<?php

namespace App\ServiceProviders;

use App\App;
use App\Interfaces\Logger;
use App\Loggers\FileLogger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LoggingProvider implements ServiceProviderInterface{

	public function register(Container $pimple){
		App::bind(Logger::class, function (){
			return new FileLogger;
		});
	}
}