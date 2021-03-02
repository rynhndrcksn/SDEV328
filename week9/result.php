<?php
$name = $_POST['name'];

// connect o DB
require $_SERVER['DOCUMENT_ROOT'].'/../includes/config.php';

// define query
$sql = 'SELECT * FROM pets WHERE name = :name';

// prepare statement
$statement = $dbh->prepare($sql);

// bind params
$statement->bindParam(':name', $name, PDO::PARAM_STR);

// process result
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// output result
if ($statement->rowCount() == 0) {
	echo '<h2>No results found!</h2>';
} else {
	echo "<h2>Results</h2>";
	foreach ($result as $row) {
		$name = ucfirst($row['name']);
		$type = $row['type'];
		$color = $row['color'];
		echo "<p>$name is a $color $type</p>";
	}
}
