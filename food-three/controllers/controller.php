<?php

class Controller
{ // 🤮
	// field that contains our F3 object
	private $_f3;

	function __construct($f3)
	{
		$this->_f3 = $f3;
	}

	/**
	 * display home.html
	 */
	public function home()
	{
		// create a new view, then sends it to the client
		$view = new Template();
		echo $view->render('views/home.html');
	}

	/**
	 * display order.html
	 */
	public function order()
	{
		global $validator;
		global $order;
		global $dataLayer;

		// if the form has been submitted
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$userFood = $_POST['food'];
			$userMeal = $_POST['meal'];
			// gather info from order and validate it
			if ($validator->validFood($userFood)) {
				$order->setFood($userFood);
			} else {
				$this->_f3->set('errors["food"]', 'Food cannot be blank');
			}

			if ($validator->validMeal($userMeal)) {
				$order->setMeal($userMeal);
			} else {
				$this->_f3->set('errors["meal"]', 'Not a valid meal!');
			}

			// if there are no errors, redirect to /order2
			if (empty($this->_f3->get('errors'))) {
				$_SESSION['order'] = $order;
				$this->_f3->reroute('/order2');
			}
		}

		$this->_f3->set('meals', $dataLayer->getMeals());
		$this->_f3->set('userFood', isset($userFood) ? $userFood : "");
		$this->_f3->set('userMeal', isset($userMeal) ? $userMeal : "");

		$view = new Template();
		echo $view->render('views/order.html');
	}

	public function order2()
	{
		global $validator;
		global $dataLayer;

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['condiments'])) {
				$userConds = $_POST['condiments'];
				if ($validator->validConds($userConds)) {
					// since our object is stored in $_SESSION, we can just set the condiments with implode
					$_SESSION['order']->setCondiments(implode(', ', $userConds));
				} else {
					$this->_f3->set('errors["conds"]', 'Not a valid condiment!');
				}
			}
			if (empty($this->_f3->get('errors'))) {
				$this->_f3->reroute('/summary');
			}
		}

		$this->_f3->set('condiments', $dataLayer->getCondiments());

		$view = new Template();
		echo $view->render('views/order2.html');
	}

	public function summary()
	{
		global $dataLayer;

		// write to database
		$dataLayer->saveOrder($_SESSION['order']);

		$view = new Template();
		echo $view->render('views/summary.html');

		// clear the SESSION array
		session_destroy();
	}

	public function orderSummary()
	{
		global $dataLayer;

		$this->_f3->set('orders', $dataLayer->getOrders());
		$view = new Template();
		echo $view->render('views/order-summary.html');
	}
}