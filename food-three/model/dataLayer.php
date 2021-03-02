<?php

/**
 * @author Ryan H.
 * @file model/data-layer.php
 * @version https://github.com/rynhndrcksn/food-three
 * data-layer.php is just our model class that does all the heavy lifting for us
 */

class DataLayer
{
	// fields
	private $_dbh;

	function __construct($dbh) {
		$this->_dbh = $dbh;
	}

	/**
	 * returns all of our orders in the database
	 * @return array
	 */
	function getOrders(): array
	{
		// define query
		$sql = 'SELECT * FROM orders';

		// prepare statement
		$statement = $this->_dbh->prepare($sql);

		// execute
		$statement->execute();

		// return results
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * takes an Order object and saves the order to the database
	 * @param $order - Order object
	 */
	function saveOrder($order)
	{
		// define the query
		$sql = 'INSERT INTO orders(food, meal, condiments) VALUES (:food, :meal, :condiments)';

		// prepare the statement
		$statement = $this->_dbh->prepare($sql);

		// bind the parameters
		$statement->bindParam(':food', strtolower($order->getFood()), PDO::PARAM_STR);
		$statement->bindParam(':meal', strtolower($order->getMeal()), PDO::PARAM_STR);
		$statement->bindParam(':condiments', strtolower($order->getCondiments()), PDO::PARAM_STR);

		// execute
		$statement->execute();
		$id = $this->_dbh->lastInsertId();
	}

	/**
	 * returns an array of meals
	 * @return string[]
	 */
	function getMeals(): array
	{
		return array('breakfast', 'lunch', 'dinner');
	}

	/**
	 * returns an array of condiments
	 * @return string[]
	 */
	function getCondiments(): array
	{
		return array('ketchup', 'mayonnaise', 'mustard', 'sriracha');
	}
}