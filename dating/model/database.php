<?php
/*
 * Database query:
	CREATE TABLE member (
		member_id int unsigned AUTO_INCREMENT PRIMARY KEY,
    fname varchar(20) NOT NULL,
    lname varchar(30) NOT NULL,
    age tinyint(3) unsigned NOT NULL,
    gender varchar(10) DEFAULT NULL,
    phone varchar(13) NOT NULL,
    email varchar(50) NOT NULL,
    state varchar(15) DEFAULT NULL,
    seeking varchar(10) DEFAULT NULL,
    bio text,
    premium tinyint(1) NOT NULL,
    interests varchar(140) DEFAULT NULL, // NOTE: All interests combined with their spaces equals 140 characters
    image varchar(100) DEFAULT NULL
	);
 */


/**
 * @author Ryan H.
 * @version https://github.com/rynhndrcksn/dating
 * Class: Database - allows us to save members to database and retrieve them!
 */
class Database
{
	// fields
	private $_dbh;

	/**
	 * Database constructor.
	 * @param $dbh - dbh object passed in from controller.php
	 */
	function __construct($dbh) {
		$this->_dbh = $dbh;
	}

	/**
	 * method to add a Member/PremiumMember object to database
	 * @param $member - Member or PremiumMember object
	 */
	function insertMember($member)
	{
		// define query
		$sql = 'INSERT INTO member (fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests, image)
            VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests, :image)';

		// define statement statement
		$statement = $this->_dbh->prepare($sql);

		// assign variables for regular members
		$premium = false;
		$interests = '';
		$imagePath = ''; // we aren't saving any images, so we can ignore this path and make it empty

		// if PremiumMember, get interests
		if ($member instanceof PremiumMember) {
			$premium = true;
			$interests = $member->getIndoorInterests();
			$interests .=', ' . $member->getOutdoorInterests();
		}

		// bind the parameters
		$statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
		$statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
		$statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
		$statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
		$statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
		$statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
		$statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
		$statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
		$statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
		$statement->bindParam(':premium', $premium, PDO::PARAM_INT);
		$statement->bindParam(':interests', $interests, PDO::PARAM_STR);
		$statement->bindParam(':image', $imagePath, PDO::PARAM_STR);
		// string

		// execute results
		$statement->execute();
	}

	function getMembers()
	{
		// define query
		$sql = 'SELECT * FROM member ORDER BY lname, fname';

		// define statement
		$statement = $this->_dbh->prepare($sql);

		// execute results
		$statement->execute();

		// return results
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * finds a specific member and display their information NOT USED!
	 * @param $member_id - member id to search for
	 */
	function getMember($member_id)
	{

	}

	/**
	 * retrieves specified users interests? NOT USED
	 * @param $member_id - member id to search for
	 */
	function getInterest($member_id)
	{

	}

}