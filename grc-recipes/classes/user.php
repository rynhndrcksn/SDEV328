<?php
/**
 * @author Patrick Dang & Ryan Hendrickson
 * @file classes/user.php
 * @version https://github.com/rynhndrcksn/grc-recipes
 * user.php creates a User class so we can create objects of it
 */

/**
 * Class User holds the properties and methods for a User object
 */
class User
{
	// properties
	private $_first; // string
	private $_last; // string
	private $_username; // string
	private $_admin; //boolean

	/**
	 * User constructor to create a new User object that gets stored in the $_SESSION when a user logs in
	 *
	 * @param string $_first
	 * @param string $_last
	 * @param string $_username
	 * @param bool $_admin
	 */
	public function __construct(string $_first, string $_last, string $_username, bool $_admin)
	{
		$this->_first = $_first;
		$this->_last = $_last;
		$this->_username = $_username;
		$this->_admin = $_admin;
	}

	/**
	 * getter for first name
	 *
	 * @return string - first name
	 */
	public function getFirst(): string
	{
		return $this->_first;
	}

	/**
	 * setter for first name
	 *
	 * @param string $first - first name
	 */
	public function setFirst(string $first)
	{
		$this->_first = $first;
	}

	/**
	 * getter for last name
	 *
	 * @return string - last name
	 */
	public function getLast(): string
	{
		return $this->_last;
	}

	/**
	 * setter for last name
	 *
	 * @param string $last - last name
	 */
	public function setLast(string $last)
	{
		$this->_last = $last;
	}

	/**
	 * getter for username
	 *
	 * @return string - username
	 */
	public function getUsername(): string
	{
		return $this->_username;
	}

	/**
	 * setter for username
	 *
	 * @param string $username - username
	 */
	public function setUsername(string $username)
	{
		$this->_username = $username;
	}

	/**
	 * getter for admin
	 *
	 * @return bool - true if user is admin, otherwise false
	 */
	public function isAdmin(): bool
	{
		return $this->_admin;
	}

	/**
	 * setter for admin
	 *
	 * @param bool $admin - admin
	 */
	public function setAdmin(bool $admin)
	{
		$this->_admin = $admin;
	}
}