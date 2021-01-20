<?php

/*
 * Names: Joanna Folk & Ryan Hendrickson
 * Date: January 8th, 2021.
 * File: index.php
 * Purpose: Practice/review php concepts from SDEV 305 by making a cupcake fundraiser site. Users can enter their
 * name and select which cupcakes they want, then their total is displayed at the bottom.
 */

// error reporting
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$cupcakes = array(
	'grasshopper' => 'The Grasshopper',
	'maple' => 'Whiskey Maple Bacon',
	'carrot' => 'Carrot Walnut',
	'caramel' => 'Salted Caramel Cupcake',
	'velvet' => 'Red Velvet',
	'lemon' => 'Lemon Drop',
	'tiramisu' => 'Tiramisu'
);
?>

<label for="name">Your name:</label>
<input type="text" id="name" name="name">

<p>Cupcake flavors:</p>

<?php
foreach ($cupcakes as $cupcake => $label) {
	echo "<input type='checkbox' id=\"$cupcake\" name='order[]'>";
	echo "<label for=\"$cupcake\">$label</label><br>";
}
?>
<button type="submit" id="submitOrder">Order</button>

<div id="summary">

</div>

<!-- import jquery library -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- our scripts using jquery-->
<script>
	// beginning of AJAX request
	$('#submitOrder').on('click', function () {

		// get the name and set up empty order array
		let name = $('#name').val();
		let order = [];

		// loop through our checkboxes and add the checked ones to our order array
		$("input[name='order[]']:checked").each(function(){
			order.push(this.id);
		});

		// make the AJAX call
		$.post('validation.php', {name:name, order:order}, function (result) {
			$('#summary').html(result);
		});
	});
</script>