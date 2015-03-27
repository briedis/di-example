<?php


namespace App\Mailers;


use App\Interfaces\Mailer;

class SmtpMailer implements Mailer{

	public function send($to, $message){
		// Connect to SMTP
		// Send the mail out
	}
}