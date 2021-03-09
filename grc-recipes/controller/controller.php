<?php

/**
 * controller is our controller for the dating web app. This file contains methods that are called in our index.php
 * PHP version: 7.3
 * @author Patrick Dang & Ryan Hendrickson
 * @version https://github.com/rynhndrcksn/grc-recipes
 */
class Controller
{
	// fields
	private $_f3;
	private $_validator;
	private $_dataLayer;

	public function __construct($f3)
	{
		$this->_f3 = $f3;
		$this->_dataLayer = new DataLayer();
		$this->_validator = new Validate($this->_dataLayer);
	}

	/**
	 * displays the home.html page
	 */
	function home()
	{
		// create a new view and send the user to home.html
		$view = new Template();
		echo $view->render('views/home.html');
	}

	/**
	 * displays signup.html
	 */
	function signup()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// gather user submitted info
			$userFirst = trim($_POST['fname']);
			$userLast = trim($_POST['lname']);
			$userEmail = trim($_POST['email']);
			$userUsername = trim($_POST['username']);
			$userPassword = trim($_POST['password']);

			// validate first name
			if (!$this->_validator->validName($userFirst)) {
				$this->_f3->set('errors["fname"]', 'Not a valid first name');
			}

			// validate last name
			if (!$this->_validator->validName($userLast)) {
				$this->_f3->set('errors["lname"]', 'Not a valid last name');
			}

			// validate email
			if (!$this->_validator->validEmail($userEmail)) {
				$this->_f3->set('errors["email"]', 'Not a valid email');
			}

			// validate username
			if (!$this->_validator->validUsername($userUsername)) {
				$this->_f3->set('errors["username"]', 'Not a valid username');
			}

			// validate password
			if (!$this->_validator->validPassword($userPassword)) {
				$this->_f3->set('errors["password"]', 'Not a valid password');
			}

			// if there are no errors, create + store our User object in the DB
			if (empty($this->_f3->get('errors'))) {
				// save the user's info into the DB
				//$this->_dataLayer->saveUser($userFirst, $userLast, $userEmail, $userUsername, $userPassword);

				// for now reroute to the home page??
				$this->_f3->reroute('/');
			}
		}

		$this->_f3->set('userFirst', isset($userFirst) ? $userFirst : "");
		$this->_f3->set('userLast', isset($userLast) ? $userLast : "");
		$this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
		$this->_f3->set('userUsername', isset($userUsername) ? $userUsername : "");

		$view = new Template();
		echo $view->render('views/signup.html');
	}

	function login()
	{
		$view = new Template();
		echo $view->render('views/login.html');
	}

}