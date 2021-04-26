<?php

/**
 * controller is our controller for GRC Recipes. This file contains methods that are called in our index.php
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
		$this->_validator = new Validate();
		require $_SERVER['DOCUMENT_ROOT'] . '/../includes/config.php';
		$this->_dataLayer = new DataLayer($dbh);
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
     * displays admin page
     */
	function admin()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin()) {
            $this->_f3->reroute('/login');
        }
        // create a new view and send the user to admin.html
        $view = new Template();
        echo $view->render('views/admin.html');
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

			// unique email?
			if (!$this->_dataLayer->uniqueEmail($userEmail)) {
				$this->_f3->set('errors["uniqueEmail"]', 'That email has already been registered 😢');
			}

			// validate username
			if (!$this->_validator->validUsername($userUsername)) {
				$this->_f3->set('errors["username"]', 'Not a valid username');
			}

			// unique username?
			if (!$this->_dataLayer->uniqueUsername($userUsername)) {
				$this->_f3->set('errors["uniqueUsername"]', 'That username has already been registered 😢');
			}

			// validate password
			if (!$this->_validator->validPassword($userPassword)) {
				$this->_f3->set('errors["password"]', 'Not a valid password');
			}

			// if there are no errors, create + store our User object in the DB
			if (empty($this->_f3->get('errors'))) {
				// save the user's info into the DB
				$this->_dataLayer->saveUser($userFirst, $userLast, $userEmail, $userUsername, $userPassword);

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

    /**
     * displays login.html and verifies user login credentials
     */
	function login()
	{
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // gather user submitted info
            $userUsername = trim($_POST['username']);
            $userPassword = trim($_POST['password']);

            // validate user credentials
            if (!$this->_dataLayer->isUser($userUsername, $userPassword)) {
                $this->_f3->set('errors["login"]', 'Invalid username and/or password');
            }

            // if there are no errors, create + store our User object in the $_SESSION
            if (empty($this->_f3->get('errors'))) {
                // save the user's info into the $_SESSION
                $_SESSION['user'] = $this->_dataLayer->getUser($userUsername);

                // for now reroute to the home page??
                $this->_f3->reroute('/admin');
            }
        }

        $this->_f3->set('userUsername', isset($userUsername) ? $userUsername : "");

        $view = new Template();
		echo $view->render('views/login.html');
	}

    /**
     * logs the user out of website
     */
	function logout()
    {
        // start sessions
        session_start();
        // free up session variables
        session_unset();
        // destroy session data
        session_destroy();
        // assign $_SESSION as an empty array for extra measure
        $_SESSION = array();

        // reroute to home page
        $this->_f3->reroute('/');
    }

    /**
     * displays privacy policy
     */
	function privacy()
	{
		$view = new Template();
		echo $view->render('views/privacy-policy.html');
	}

    /**
     * displays the recipe they use chose | todo: add parameter of recipe id to grab the recipe from DB
     */
    function recipes()
    {
        $view = new Template();
        echo $view->render('views/recipes.html');
    }
}