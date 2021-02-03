/*
	@author: Ryan H.
	@version:
	json-search.js holds people in JSON format and allows json-search.html to search for them
 */

// create people object containing all 5 people
let people = [
	{"fname": "jane", "lname": "doe", "sex": "f", "born": "1996", "died": "n/a",
		"father": {"fname": "john", "lname": "doe"}, "mother": {"fname": "janice", "lname": "doe"}},

	{"fname": "jane", "lname": "ramirez", "sex": "f", "born": "1998", "died": "n/a",
		"father": {"fname": "john", "lname": "doe"}, "mother": {"fname": "janice", "lname": "doe"}},

	{"fname": "jesse", "lname": "pearce", "sex": "m", "born": "1946", "died": "n/a",
		"father": {"fname": "john", "lname": "pearce"}, "mother": {"fname": "janice", "lname": "pearce"}},

	{"fname": "jamie", "lname": "thompson", "sex": "f", "born": "1976", "died": "n/a",
		"father": {"fname": "john", "lname": "thompson"}, "mother": {"fname": "janice", "lname": "thompson"}},

	{"fname": "alex", "lname": "rogers", "sex": "f", "born": "1990", "died": "n/a",
		"father": {"fname": "john", "lname": "rogers"}, "mother": {"fname": "janice", "lname": "rogers"}}
]

/**
 * when the user clicks the button to search for a name, it will execute an anonymous function that will query the
 * people object and see if the name exist in the database
 */
document.getElementById('button-search').onclick = () => {
	// grab the name the user wants to search for, trim it, make it lowercase, and make sure it's a string
	let name = document.getElementById('name-search').value.toString().toLowerCase().trim();

	// create a result variable so we can test if a result is found
	let result = '';

	// see if we have any matches! we check first name, then last name, then both to see if there's any matches
	for (let search of people) {
		if(search.fname.toLowerCase().includes(name) ||
			search.lname.toLowerCase().includes(name) ||
			search.fname.toLowerCase().concat(' ', search.lname.toLowerCase()).includes(name)) {
			result +=
				'Name: ' + capitalize(search.fname) + ' ' + capitalize(search.lname) + '<br>' +
				'Sex: ' + search.sex.toUpperCase() + '<br>' +
				'Born: ' + search.born + '<br>' +
				'Died: ' + search.died + '<br>' +
				'Father: ' + capitalize(search.father.fname) + ' ' + capitalize(search.father.lname) + '<br>' +
				'Mother: ' + capitalize(search.mother.fname) + ' ' + capitalize(search.mother.lname) + '<br><br>';
		}
	}

	// print either the name wasn't found, or the result
	let output = document.getElementById('result');
	return result === '' ? output.innerHTML = 'No match found' : output.innerHTML = result ;
};

/**
 * helper function that capitalizes names for us since JS doesn't have one built in -_-
 * @param data - string to capitalize
 */
const capitalize = (data) => {
	data.toLowerCase();
	let first = data.charAt(0).toUpperCase();
	return first + data.slice(1);
};