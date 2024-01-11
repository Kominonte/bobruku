var loginText = document.getElementById('login');
var loginLabelText = document.getElementById('login-label');

loginText.addEventListener('click', function() {
	loginLabelText.style.top = "56px";
	loginLabelText.style.left = "35px";
	loginLabelText.style.color = "#ffffff";
	loginLabelText.style.fontSize = "20px";
	loginLabelText.style.backgroundColor = "#1c1c1c";


	loginText.style.border = "2px solid #ffffff";
	loginText.style.backgroundColor = "#1c1c1c";
});

var passwordText = document.getElementById('password');
var passwordLabelText = document.getElementById('password-label');

passwordText.addEventListener('click', function() {
	passwordLabelText.style.top = "130px";
	passwordLabelText.style.left = "35px";
	passwordLabelText.style.color = "#ffffff";
	passwordLabelText.style.fontSize = "20px";
	passwordLabelText.style.backgroundColor = "#1c1c1c";


	passwordText.style.border = "2px solid #ffffff";
	passwordText.style.backgroundColor = "#1c1c1c";
});

var secondPasswordText = document.getElementById('second-password');
var secondPasswordLabelText = document.getElementById('second-password-label');

secondPasswordText.addEventListener('click', function() {
	secondPasswordLabelText.style.top = "230px";
	secondPasswordLabelText.style.left = "35px";
	secondPasswordLabelText.style.color = "#ffffff";
	secondPasswordLabelText.style.fontSize = "20px";
	secondPasswordLabelText.style.backgroundColor = "#1c1c1c";


	secondPasswordText.style.border = "2px solid #ffffff";
	secondPasswordText.style.backgroundColor = "#1c1c1c";
});
