<?php
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// print to site
echo 'hello';
print 'Hello';

// assign variables
$name = 'Ryan H.';
$age = 26;

// assign constant
const TAX_RATE = 0.08;

// embed variables in string
echo "<p>My name is $name and I am $age years old</p>";

// arithmetic
$a = 5;
$b = 2;
echo 'sum: '. ($a+$b) . '<br>';
echo 'difference: '. ($a-$b) . '<br>';
echo 'product: '. ($a*$b) . '<br>';
echo 'quotient: '. ($a/$b) . '<br>';
echo 'remainder: '. ($a%$b) . '<br>';

// if statement
if ($a > $b) {
	echo 'a is greater than b';
} else {
	echo 'b is greater than a';
}

// ternary statement
$result =  $a > $b ? 'a is greater than b' : 'b is greater than a';
echo "<p>$result</p>";

// "complicated" if statement
if ($a != $b && $b < 11) {
	echo '<p>a is greater!</p>';
}

// for loop
for ($i = 0; $i < 10; $i++) {
	echo "<p>$i</p>";
}
echo '<p>Blastoff!</p>';

// while loop
$count = 0;
while ($count < 10) {
	echo "<p>$count</p>";
	$count++;
}
echo '<p>Blastoff!</p>';

// indexed array of names you var_dump
$names = array('Ryan', 'Bob', 'Alice');
echo '<pre>';
var_dump($names);
echo '</pre>';
echo "$names[0]";

// add name to array
$names[] = 'Khan';

// print each object in array
foreach ($names as $name) {
	echo "<p>$name</p>";
}

// associative array
$produce = array(
	'potatoes' => 0.49,
	'onions' => 0.99,
	'spinach' => 2.99
);

// add item to associative array
$produce['avocado'] = 0.99;

// print everything in our associative array
foreach ($produce as $item => $price) {
	echo "<p>$item: $price</p>";
}

// how to do includes/requires
// include ('header.htm');

// redirect user to another page
// header('location: redirect.php');

// define a function that uses a parameter ($name=null makes $name null by default, so if there's no name passed in,
// it still works.
function hello($name=null) {
	echo $name=null ? 'Hello' : "Hello $name";
}

hello('Ryan');

function combine($first, $last): string {
	return "<p>$first $last</p>";
}

echo combine('Ryan', 'Hendrickson');

// useful functions | string length, to upper case, to lower case, see if string contains a '
$ryan = 'Ryan';
echo '<p>Length of name: ' . strlen($ryan) . '</p>';
echo strtoupper("<p>$ryan</p>");
echo strtolower("<p>$ryan</p>");
echo strpos($name, "'") == 0 ? '<p>no \' in name</p>' : '<p>yes \' in name</p>';