<?php
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo '<h1>My Pets</h1>';
// require out pet class file
require ('pet.php');
require ('dog.php');
require ('cat.php');

// instantiate a new pet
$pet1 = new Pet('Paul', 'black');

// tell pet1 to eat
$pet1->eat();
$pet1->talk();
$pet1->sleep();
echo $pet1;
$pet1->setColor('blue');
echo $pet1->getColor();

echo '<pre>';
var_dump($pet1);
echo '</pre>';

$fido = new Dog('Fido', 'black');
$fido->eat();
$fido->fetch();
$fido->talk();

$nelly = new Cat('Nelly', 'gray');
$nelly->eat();
$nelly->scratch();