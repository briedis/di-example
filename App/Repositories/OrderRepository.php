<?php


namespace App\Repositories;

class OrderRepository{

	public function createOrder($userId, $amount){
		return 666;
	}

	public function fetchOrder($orderId){
		return new \stdClass();
	}

	public function markAsCanceled($orderId){
		return true;
	}
}