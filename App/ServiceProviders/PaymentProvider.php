<?php


namespace App\ServiceProviders;


use App\App;
use App\Interfaces\Logger;
use App\Interfaces\Mailer;
use App\Payments;
use App\Repositories\OrderRepository;
use App\User;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PaymentProvider implements ServiceProviderInterface{

	public function register(Container $pimple){
		App::bind(Payments::class, function (){

			return new Payments(
				App::make(User::class), // Logged in user will be fetched
				new OrderRepository,
				App::make(Mailer::class),
				App::make(Logger::class)
			);

		});
	}
}