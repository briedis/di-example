<?php

namespace App\Interfaces;

interface Logger {
	/**
	 * Log something
	 * @param string $message
	 * @return void
	 */
	public function log($message);
}