<?php


namespace App\Loggers;


use App\Interfaces\Logger;

class FakeLogger implements Logger{

	public function log($message){
		// I don't feel like logging today...
	}

}