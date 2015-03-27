<?php


namespace App\Loggers;


use App\Interfaces\Logger;

class FileLogger implements Logger{

	public function log($message){
		$message = date('[H:i:s] ') . $message . "\n";
		file_put_contents(__DIR__ . '/../../log.log', $message, FILE_APPEND);
	}

}