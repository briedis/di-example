<?php

class BadPaymentsExample {

	public function createOrder($amount){
		$user = User::getCurrentUser();

		mysql_query('INSERT INTO order ...');
		$orderId = mysql_insert_id();

		mail($user->email, 'New order!', 'New order created ' . $orderId);

		Log::info($user->email . ' created order Nr. ' . $orderId);

		$data = mysql_query('SELECT * FROM orders WHERE id = ' . $orderId);

		return mysql_fetch_assoc($data);
	}
}