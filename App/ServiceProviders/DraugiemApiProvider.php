<?php


namespace App\ServiceProviders;


use App\App;
use DraugiemApi;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DraugiemApiProvider implements ServiceProviderInterface{

	public function register(Container $pimple){
		App::singleton(DraugiemApi::class, function (){
			return new DraugiemApi(time(), uniqid('', true));
		});
	}
}