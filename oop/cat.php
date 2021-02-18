<?php
/**
 * @author Ryan H.
 * @version 1
 * @copyright 2021
 */

class Cat extends Pet
{
	public function scratch() {
		echo '<p>'.$this->getName().' has scratched you</p>';
	}
}