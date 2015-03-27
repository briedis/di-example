<?php


namespace App\Loggers;


use App\Interfaces\Logger;

class FileLogger implements Logger{

	public function log($message){
		file_put_contents(__DIR__ . '/../../log.log', FILE_APPEND);
	}

}