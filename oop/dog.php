<?php
/**
 * @author Ryan H.
 * @version 1
 * @copyright 2021
 */

class Dog extends Pet
{
	public function fetch()
	{
		echo "<p>{$this->getName()} is fetching</p>";
	}

	public function talk()
	{
		echo "<p>{$this->getName()} says woof!</p>";
	}
}