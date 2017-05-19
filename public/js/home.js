var email = document.querySelector('#signup-email');
var login = document.querySelector('#signup-login');
var password = document.querySelector('#signup-passwd');
var passwordCheck = document.querySelector('#signup-check-password');

function validateEmail(email) {
	var regex = 	/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return regex.test(email);
}
