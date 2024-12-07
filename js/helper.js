async function ajax(url = "", data = {}, _method = "POST") {
	// Default options are marked with *
	const response = await fetch(url, {
		method: _method, // *GET, POST, PUT, DELETE, etc.
		mode: "no-cors", // no-cors, *cors, same-origin
		cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
		credentials: "same-origin", // include, *same-origin, omit
		headers: {
			"Content-Type": "application/json",
			//'Content-Type': 'application/x-www-form-urlencoded',
		},
		redirect: "follow", // manual, *follow, error
		referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
		body: JSON.stringify(data), // body data type must match "Content-Type" header
	});
	return response.json(); // parses JSON response into native JavaScript objects
}

// Get days from two dates
function getNumberOfDays(startDate, endDate) {
	const start = new Date(startDate);
	const end = new Date(endDate);

	// Calculate the difference in milliseconds
	const diffInMs = end - start;

	// Convert milliseconds to days
	const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

	return diffInDays;
}

// Get Formatted Date
function formated_date(inputDate = new Date()) {
	const date = new Date(inputDate);

	// Format the date
	const formattedDate = new Intl.DateTimeFormat("en-US", {
		month: "long",
		day: "2-digit",
		year: "numeric",
	}).format(date);

	return formattedDate;
}

function getCurrentDate() {
	const currentDate = new Date();

	const day = currentDate.getDate();
	const month = currentDate.getMonth() + 1;
	const year = currentDate.getFullYear();

	// Format the date as required (MMDDYYYY)
	const res = day.toString().padStart(2, "0") + month.toString().padStart(2, "0") + year.toString();
	return res;
}
