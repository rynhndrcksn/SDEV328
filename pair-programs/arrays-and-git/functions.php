<?php
/*
 * author: Ryan Hendrickson
 * date: January 15th, 2020.
 * filename: functions.php
 * url: https://rhendrickson.greenriverdev.com/328/pair-programs/arrays-and-git/index.php
 * description: php file that contains all of our php functions for index.php
 */

/**
 * prints a 1-d array using a foreach loop
 * @param $array - an array that gets passed in to be printed
 */
function printArr($array) {
	foreach ($array as $item) {
		echo "<p>$item</p>";
	}
}

/**
 * finds the largest number in an array and prints it
 * @param $array - an array that gets passed in so we can find the largest number in it
 * @return int - largest number in the array
 */
function largest($array): int {
	$max = PHP_INT_MIN;
	foreach ($array as $item) {
		if ($item > $max) {
			$max = $item;
		}
	}
	return $max;
}

/**
 * removes all duplicates from the array that's passed in using array_unique()
 * @param $array - array that gets passed in so we can remove the duplicates from it
 * @return array - the array without any duplicates in it
 */
function removeDups($array): array {
	return array_unique($array, SORT_NUMERIC);
}

/**
 * takes an array as a parameter and returns an associative array with each value from the original array, and the
 * number of times that value occurs in the original array
 * @param $array - array that gets passed in
 * @return array - associate array
 */
function distribution($array): array {
	$array = array_count_values($array);
	ksort($array, SORT_NUMERIC);
	return $array;
}