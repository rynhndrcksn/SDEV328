<?php

/**
 * PremiumMember class takes ALL of the user's information that's submitted and stores it as an object
 * PHP version: 7.3
 * @author Ryan Hendrickson
 * @version https://github.com/rynhndrcksn/dating
 */
class PremiumMember extends Member
{
	private $_indoorInterests;
	private $_outdoorInterests;

	/**
	 * @return string - user's indoor interests
	 */
	public function getIndoorInterests(): string
	{
		return $this->_indoorInterests;
	}

	/**
	 * @param string $indoorInterests - user's indoor interests
	 */
	public function setIndoorInterests(string $indoorInterests)
	{
		$this->_indoorInterests = $indoorInterests;
	}

	/**
	 * @return string - user's outdoor interests
	 */
	public function getOutdoorInterests(): string
	{
		return $this->_outdoorInterests;
	}

	/**
	 * @param string $outdoorInterests - user's outdoor interests
	 */
	public function setOutdoorInterests(string $outdoorInterests)
	{
		$this->_outdoorInterests = $outdoorInterests;
	}


}