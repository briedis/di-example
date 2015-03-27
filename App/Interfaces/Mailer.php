<?php


namespace App\Interfaces;


interface Mailer{
	/**
	 * Send a message
	 * @param string $to
	 * @param string $message
	 * @return bool
	 */
	public function send($to, $message);
}