<?php

namespace App;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class App{

	/**
	 * Register a service provider
	 * @param ServiceProviderInterface $provider
	 */
	public static function registerProvider(ServiceProviderInterface $provider){
		self::container()->register($provider);
	}

	/**
	 * Fetch a bound instance
	 * @param string $key
	 * @return mixed
	 */
	public static function make($key){
		return self::container()[$key];
	}

	/**
	 * Bind an instance
	 * @param string $key
	 * @param string $value
	 */
	public static function bind($key, $value){
		self::container()[$key] = self::container()->factory($value);
	}

	/**
	 * Bind a singleton instance
	 * @param string $name
	 * @param mixed $callable
	 */
	public static function singleton($name, $callable){
		self::container()[$name] = $callable;
	}

	/**
	 * Get or create a container
	 * @return Container
	 */
	private static function container(){
		static $container;
		if($container === null){
			$container = new Container;
		}
		return $container;
	}
}