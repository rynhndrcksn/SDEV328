<?php
/**
 * @author Ryan H.
 * @version 1.0
 * basic file to showcase benefits of PDO
 */

// turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . "/../includes/config.php";

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PDO Demo</title>
</head>
<body>
<h1>PDO Demo</h1>

<?php
// ADDING A STATEMENT
// define the query
$sql = 'INSERT INTO pets( type, name, color) VALUES (:type, :name, :color)';

// prepare statement
$statement = $dbh->prepare($sql);

// bind the params
$type = 'kangaroo';
$name = 'joey';
$color = 'brown';
$statement->bindParam(':type', $type, PDO::PARAM_STR);
$statement->bindParam(':name', $name, PDO::PARAM_STR);
$statement->bindParam(':color', $color, PDO::PARAM_STR);

// execute
//$statement->execute();

// this enables us to grab the ID of the last added row in the DB for easy foreign key stuff
$id = $dbh->lastInsertID();
echo "<p>$name the $color $type has been added!";



// UPDATING A QUERY
// define the query
$sql = 'UPDATE pets SET name = :new WHERE name = :old';

// prepare the statement
$statement = $dbh->prepare($sql);

// bind the params
$old = 'joey';
$new = 'troy';
$statement->bindParam(':old', $old, PDO::PARAM_STR);
$statement->bindParam(':new', $new, PDO::PARAM_STR);

// execute statement
//$statement->execute();
echo "<p>$old has been changed to $new</p>";



// DELETING A STATEMENT
// define the query
$sql = 'DELETE FROM pets WHERE id = :id';

// prep the statement
$statement = $dbh->prepare($sql);

// bind the params
$id = 1;
$statement->bindParam(':id', $id, PDO::PARAM_STR);

// execute statement
//$statement->execute();
echo "<p>Pet with id $id has been deleted</p>";



// A SELECT QUERY
// define the query
$sql = 'SELECT * FROM pets WHERE id = :id';

// prep the statement
$statement = $dbh->prepare($sql);

// bind the params
$id = 3;
$statement->bindParam(':id', $id, PDO::PARAM_INT);

// execute statement
$statement->execute();

// process the results
$row = $statement->fetch(PDO::FETCH_ASSOC);
echo '<p>' . ucfirst($row['name']) . ', the ' . $row['color'] . ' ' . $row['type'] . ' has been retrieved</p>';



// SELECT ALL QUERY
// define the query
$sql = 'SELECT * FROM pets';

// prep the statement
$statement = $dbh->prepare($sql);

// execute statement
$statement->execute();

// process the results
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	echo '<p>' . ucfirst($row['name']) . ', the ' . $row['color'] . ' ' . $row['type'] . ' has been retrieved</p>';
}
?>

</body>
</html>