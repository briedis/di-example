<?php


namespace App;


use App\Interfaces\Logger;

class MailLogger implements Logger{

	public function log($message){
		mail('admin@localhost', 'Log', $message);
	}

}