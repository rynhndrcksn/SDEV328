/*
Author: Ryan Hendrickson
Date: January 13, 2020.
Filename: hee-haw.js
Purpose:
Hee Haw! Write a JavaScript program that prints the numbers from 1 to 100 to the web page. (You can use document.write)
- For any number evenly divisible by 3, print "Hee!" instead of the number.
- For any number evenly divisible by 5, print "Haw!" instead of the number.
- For any number evenly divisible by both 3 and 5, print "Hee Haw!" instead of the number.
*/

// get out div element for our output | uncomment if we ever come back to this program
// let output = document.getElementById("hee-haw");

// let the hee haw's begin
for (let i = 1; i < 101; i++) {
	if (i % 5 === 0 && i % 3 === 0) {
		document.write('Hee Haw!');
		document.write('<br>');
	} else if (i % 5 === 0) {
		document.write('Haw!');
		document.write('<br>');
	} else if (i % 3 === 0) {
		document.write('Hee!');
		document.write('<br>');
	} else {
		document.write(i);
		document.write('<br>');
	}
}