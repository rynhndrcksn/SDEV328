<?php
/**
 *  * @author Ryan H.
 * @version https://github.com/rynhndrcksn/dating
 * Class Validation that holds a bunch of validation methods for the web app
 */
class Validation
{
	// fields
	private $_dataLayer;

	function __construct()
	{
		$this->_dataLayer = new DataLayer();
	}

	function validName($name): bool
	{
		return !empty($this->prep_input($name)) && ctype_alpha($this->prep_input($name));
	}

	function validAge($age): bool
	{
		return $age > 17 && $age < 119;
	}

	function validPhone($phone): bool
	{
		$phone = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
		$phone = str_replace("-", "", $phone);
		return $phone < 15 && $phone > 9;
	}

	function validEmail($email)
	{
		return filter_var($email, FILTER_SANITIZE_EMAIL);
	}

	function validOutdoor($outdoor)
	{

	}

	function validIndoor($indoor)
	{

	}

	/**
	 * takes a parameter, strips any white spaces, strips \\'s and //'s, and converts any HTML to it's ASCII code.
	 * is used on its own, but also acts as a helper method
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