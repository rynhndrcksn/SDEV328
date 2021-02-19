/*
Create an HTML page that links to a JavaScript file.

In the JavaScript file, write a function that takes an array as a parameter,
and returns the average of the numbers in the array. It should ignore everything that is not a number.

In the HTML file, call your average function using the array shown below. Print the output to the console window.

average( [2, 3.4, ‘x’, false,-1] )   // Expected Output:  1.467
 */

average = (arr) => {
	//let arr = [2, 3.4, 'x', false, -1];
	let sum = 0.00;
	let nums = 0.00;
	for (let item of arr) {
		if (parseFloat(item)) {
			sum += item;
			nums++;
		}
	}
	let average = (sum/nums);
	console.log('Average is ' + average);
}