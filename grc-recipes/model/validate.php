<?php
/**
 * @author Patrick Dang & Ryan Hendrickson
 * @file model/validate.php
 * @version https://github.com/rynhndrcksn/grc-recipes
 * handles all of our validation functions for recipes app
 */

/**
 * Class Validate handles all the validation for the webapp (minus unique emails and passwords)
 */
class Validate
{

	/**
	 * returns true if not empty and contains only letters
	 * @param string $name - name being passed into the first name/last name inputs on the signup page
	 * @return bool - true if it's a valid name, false otherwise
	 */
	function validName(string $name): bool
	{
		return !empty($this->prep_input($name)) && ctype_alpha($this->prep_input($name)) &&
			strlen($this->prep_input($name)) < 21;
	}

	/**
	 * returns true if we get a valid email
	 * @param string $email - email to validate
	 * @return bool - true if valid email, false otherwise
	 */
	function validEmail(string $email): bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($this->prep_input($email)) < 51;
	}

	/**
	 * returns true if we have a valid username
	 * @param string $username - username to be validated
	 * @return bool - true if username is valid, false otherwise
	 */
	function validUsername(string $username): bool
	{
		return ctype_alnum($this->prep_input($username)) && strlen($this->prep_input($username)) < 21;
	}

	/**
	 * validates the password to ensure there's at least 1 capital, 1 lower, 1 number, and 1 special character
	 * @param string $password - password to be validated
	 * @return bool - true if password meets requirements, false otherwise
	 */
	function validPassword(string $password): bool
	{
		return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{10,64}$/', $password);
	}

	/**
	 * takes a parameter, strips any white spaces, strips \\'s and //'s, and converts any HTML to it's ASCII code.
	 * is used on its own, but also acts as a helper function
	 * @param $data
	 * @return string
	 */
	function prep_input($data): string
	{
		$data = strtolower($data);
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}