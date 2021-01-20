// make all error messages invisible again
function clearErrors() {
	// create node list of all elements with text-danger class
	let errors = document.getElementsByClassName("text-danger");
	for (let i = 0; i < errors.length; i++) {
		errors[i].classList.add("d-none");
	}
}

function validate() {
	clearErrors();

	// success flag
	let isValid = true;

	// validate number entered
	let num = document.getElementById("hee-haw-num").value;
	if (num < 1 || isNaN(num)) {
		let errNum = document.getElementById("err-num");
		errNum.classList.remove("d-none");
		isValid = false;
	}

	if (isValid) {
		heeHaw(num);
	}

}

function heeHaw(num) {
	let output = document.getElementById("output");
	for (let i = 1; i < num; i++) {
		if (i % 5 === 0 && i % 3 === 0) {
			output.innerHTML += "<p>Hee Haw!</p>";
		} else if (i % 5 === 0) {
			output.innerHTML += "<p>Haw!</p>";
		} else if (i % 3 === 0) {
			output.innerHTML += "<p>Hee!</p>";
		} else {
			output.innerHTML += "<p>" + i + "</p>";
		}
	}
}