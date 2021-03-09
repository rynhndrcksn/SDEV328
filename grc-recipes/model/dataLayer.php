<?php

/**
 * @author Patrick Dang & Ryan Hendrickson
 * @file model/data-layer.php
 * @version https://github.com/rynhndrcksn/grc-recipes
 * data-layer.php is just our model class that does all the heavy lifting for us, it will eventually reach our to our
 * DB but for now it kinda does nothing.
 */

class DataLayer
{
	// fields
	private $_dbh;

	function __construct($dbh=null) {
		$this->_dbh = $dbh;
	}

	/**
	 * takes the users info and saves it into the DB
	 * @param $first - user's first name
	 * @param $last - user's last name
	 * @param $email - user's email
	 * @param $username - user's username
	 * @param $password - user's password
	 */
	function saveUser($first, $last, $email, $username, $password)
	{
		// define the query
		$sql = 'INSERT INTO users(first, last, email, username, password) VALUES (:first, :last, :email, :username, :password)';

		// prepare the statement
		$statement = $this->_dbh->prepare($sql);

		// bind the parameters
		$statement->bindParam(':first', strtolower($first), PDO::PARAM_STR);
		$statement->bindParam(':last', strtolower($last), PDO::PARAM_STR);
		$statement->bindParam(':email', strtolower($email), PDO::PARAM_STR);
		$statement->bindParam(':username', strtolower($username), PDO::PARAM_STR);
		$statement->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

		// execute
		$statement->execute();
	}

}