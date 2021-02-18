<?php
/**
 * @author Ryan H.
 * @version 1
 * represents a Pet object.
 * methods are functions inside a class, otherwise they are just functions
 */

class Pet
{ // gross, I hate inline brackets 🤮
	private $_name;
	private $_color;

	/**
	 * Pet constructor.
	 * @param $_name - name of pet
	 * @param $_color - color of pet
	 */
	public function __construct(string $_name='unknown', string $_color='unknown')
	{
		$this->_name = $_name;
		$this->_color = $_color;
	}

	/**
	 * method that tells us the pet is eating
	 */
	public function eat()
	{
		echo "<p>$this->_name is eating</p>";
	}

	/**
	 * method that tells us the pet is talking
	 */
	public function talk()
	{
		echo "<p>$this->_name is talking</p>";
	}

	/**
	 * method that tells us the pet is sleeping
	 */
	public function sleep()
	{
		echo "<p>$this->_name is sleeping</p>";
	}

	/**
	 * getter for $_name
	 * @return string
	 */
	public function getName(): string
	{
		return $this->_name;
	}

	/**
	 * getter for $_color
	 * @return string
	 */
	public function getColor(): string
	{
		return $this->_color;
	}

	/**
	 * setter for $_name
	 * @param string $name
	 */
	public function setName(string $name)
	{
		$this->_name = $name;
	}

	/**
	 * setter for $_color
	 * @param string $color
	 */
	public function setColor(string $color)
	{
		$this->_color = $color;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return "<p>$this->_name is $this->_color</p>";
	}

}