<?php


namespace App\ServiceProviders;


use App\App;
use App\Interfaces\Logger;
use App\Interfaces\Mailer;
use App\Mailers\LogMailer;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MailingProvider implements ServiceProviderInterface{

	public function register(Container $pimple){
		App::bind(Mailer::class, function (){
			$logger = App::make(Logger::class);
			return new LogMailer($logger);
		});
	}
}