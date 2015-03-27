<?php


namespace App\Mailers;


use App\Interfaces\Logger;
use App\Interfaces\Mailer;

class LogMailer implements Mailer{
	/** @var Logger */
	private $logger;

	public function __construct(Logger $logger){
		$this->logger = $logger;
	}

	public function send($to, $message){
		$this->logger->log('[E-mail] TO: ' . $to . ' BODY: ' . $message);
	}
}