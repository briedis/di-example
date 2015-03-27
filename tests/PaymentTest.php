<?php


use App\Interfaces\Logger;
use App\Interfaces\Mailer;
use App\Payments;
use App\Repositories\OrderRepository;
use App\User;
use Mockery\MockInterface;

class PaymentTest extends PHPUnit_Framework_TestCase{
	/** @var  User */
	private $user;

	/** @var Payments */
	private $payments;

	/** @var OrderRepository|MockInterface */
	private $mockOrders;

	/** @var Logger|MockInterface */
	private $mockLogger;

	/** @var Mailer|MockInterface */
	private $mockMailer;

	protected function setUp(){
		$this->user = new User;
		$this->user->name = 'Martin';
		$this->user->id = 666;
		$this->user->email = 'martin@test';

		$this->mockOrders = Mockery::mock(OrderRepository::class);
		$this->mockLogger = Mockery::mock(Logger::class);
		$this->mockMailer = Mockery::mock(Mailer::class);

		$this->payments = new Payments(
			$this->user,
			$this->mockOrders,
			$this->mockMailer,
			$this->mockLogger
		);
	}

	public function testCreateOrder(){
		$amount = 1234;
		$orderId = 999;
		$order = new stdClass();

		$this->mockOrders->shouldReceive('createOrder')->once()
			->with($this->user->id, $amount)
			->andReturn($orderId);

		$this->mockMailer->shouldReceive('send')->once();
		$this->mockLogger->shouldReceive('log')->once();
		$this->mockOrders->shouldReceive('fetchOrder')->with($orderId)->andReturn($order);

		$result = $this->payments->createOrder($amount);

		$this->assertEquals($order, $result, 'Order was created');
	}

	public function testCheckIsNotCompletedOrder(){
		$orderId = 222;
		$order = new stdClass();
		$order->status = 'other';

		$this->mockOrders->shouldReceive('fetchOrder')->once()->with($orderId)
			->andReturn($order);

		$this->assertFalse($this->payments->checkOrder($orderId), 'Order is not complete');
	}

	public function testCheckIsCompletedOrder(){
		$orderId = 222;
		$order = new stdClass();
		$order->status = 'completed';

		$this->mockOrders->shouldReceive('fetchOrder')->once()->with($orderId)
			->andReturn($order);

		$this->assertTrue($this->payments->checkOrder($orderId), 'Order is complete');
	}

	public function testCancelOrder(){
		$orderId = 12345;

		$this->mockOrders->shouldReceive('markAsCanceled')->once()->with($orderId);
		$this->mockMailer->shouldReceive('send')->once();

		$this->payments->cancelOrder($orderId);
	}
}