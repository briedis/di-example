<?php


namespace App;


use App\Interfaces\Logger;
use App\Interfaces\Mailer;
use App\Repositories\OrderRepository;

class Payments{

	/** @var User */
	private $user;

	/** @var Mailer */
	private $mailer;

	/** @var Logger */
	private $logger;

	/** @var OrderRepository */
	private $orders;

	public function __construct(
		User $user,
		OrderRepository $orders,
		Mailer $mailer,
		Logger $logger
	){
		$this->user = $user;
		$this->mailer = $mailer;
		$this->logger = $logger;
		$this->orders = $orders;
	}

	/**
	 * Create an order, notify user
	 * @param int $amount
	 * @return \stdClass
	 */
	public function createOrder($amount){
		$orderId = $this->orders->createOrder($this->user->id, $amount);

		$this->mailer->send($this->user->email, "Order Nr. $orderId created with amount $amount");
		$this->logger->log("{$this->user->email} created order Nr $orderId");

		return $this->orders->fetchOrder($orderId);
	}

	/**
	 * Check if order is completed
	 * @param int $orderId
	 * @return bool
	 */
	public function checkOrder($orderId){
		$order = $this->orders->fetchOrder($orderId);
		return $order->status === 'completed';
	}

	/**
	 * Cancel an order
	 * @param int $orderId
	 */
	public function cancelOrder($orderId){
		$this->orders->markAsCanceled($orderId);
		$this->mailer->send($this->user->email, "Order Nr. $orderId was canceled");
	}
}