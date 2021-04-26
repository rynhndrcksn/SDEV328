<?php
/**
 * @author Patrick Dang & Ryan Hendrickson
 * @file model/data-layer.php
 * @version https://github.com/rynhndrcksn/grc-recipes
 * data-layer.php creates a DataLayer object so we can do CRUD with the database
 */

/**
 * Class DataLayer holds all the methods to create, read, update, and delete users and recipes
 */
class DataLayer
{
	// fields
	private $_dbh;

	/**
	 * DataLayer constructor.
	 * @param $dbh - dbh object passed in from controller.php
	 */
	function __construct($dbh) {
		$this->_dbh = $dbh;
	}

	/**
	 * tells us if the user entered a unique email or not
	 *
	 * @param string $email - email to query DB against
	 * @return bool - true if email is unique, otherwise false
	 */
	function uniqueEmail(string $email): bool
	{
		// define query
		$sql = 'SELECT * FROM grc_users WHERE email = :email';

		// prepare query
		$statement = $this->_dbh->prepare($sql);

		// bind parameters
		$statement->bindParam(':email', strtolower($email), PDO::PARAM_STR);

		// execute query
		$statement->execute();

		// return whether the email exist already or not
		return $statement->rowCount() == 0;
	}

	/**
	 * tells us if the user entered a unique username or not
	 *
	 * @param string $username - username to query DB against
	 * @return bool - true if username is unique, otherwise false
	 */
	function uniqueUsername(string $username): bool
	{
		// define query
		$sql = 'SELECT * FROM grc_users WHERE username = :username';

		// prepare query
		$statement = $this->_dbh->prepare($sql);

		// bind parameters
		$statement->bindParam(':username', strtolower($username), PDO::PARAM_STR);

		// execute query
		$statement->execute();

		// return whether the username exist already or not
		return $statement->rowCount() == 0;
	}

	/**
	 * takes the users info and saves it into the DB
	 *
	 * @param $first - user's first name
	 * @param $last - user's last name
	 * @param $email - user's email
	 * @param $username - user's username
	 * @param $password - user's password
	 */
	function saveUser(string $first, string $last, string $email, string $username, string $password)
	{
		// define query
		$sql = 'INSERT INTO grc_users(first, last, email, username, password) VALUES (:first, :last, :email, :username, :password)';

		// prepare query
		$statement = $this->_dbh->prepare($sql);

		// bind parameters
		$statement->bindParam(':first', strtolower($first), PDO::PARAM_STR);
		$statement->bindParam(':last', strtolower($last), PDO::PARAM_STR);
		$statement->bindParam(':email', strtolower($email), PDO::PARAM_STR);
		$statement->bindParam(':username', strtolower($username), PDO::PARAM_STR);
		$statement->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

		// execute query
		$statement->execute();
	}

    /**
     * verifies the user has an account and the username/password combination is right
     *
     * used in tandem with getUser (if this returns true)
     *
     * @param string $username - username to check in DB
     * @param string $password - password to check in DB
     * @return bool - true if username/password combination exist in database, otherwise false
     */
	function isUser(string $username, string $password): bool
	{
		// define query
		$sql = 'SELECT * FROM grc_users WHERE username = :username';

		// prepare query
		$statement = $this->_dbh->prepare($sql);

		// assign variables
        $username = strtolower($username);
        $password = trim($password);

		// bind parameters
		$statement->bindParam(':username', $username, PDO::PARAM_STR);

		// execute query
		$statement->execute();

		// get the results
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // return if the password matches or not
		return password_verify($password, $row['password']);
	}

	/**
	 * checks the username and password combination against the database, if they exist we return their User object
	 *
	 * used in tandem with isUser
	 *
	 * @param string $username - username to retrieve info from
	 * @return User - new User object to store in $_SESSION
	 */
	function getUser(string $username): User
	{
		// define query
		$sql = 'SELECT * FROM grc_users WHERE username = :username';

		// prepare query
		$statement = $this->_dbh->prepare($sql);

		// bind parameters
		$statement->bindParam(':username', strtolower($username), PDO::PARAM_STR);

		// execute query
		$statement->execute();

		// since we call this after isUser then it is safe to assume
        // they exist in the database and credentials are correct
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		return new User($row['first'], $row['last'], $row['username'], $row['admin']);
	}
}