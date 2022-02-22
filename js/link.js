var fullnames 	= document.getElementById('fullnames');
var email 		= document.getElementById('email');
var password 	= document.getElementById('password');
var password2 	= document.getElementById('retype_password');

var submitMember = document.getElementById('submitMember');
var membershipForm = document.getElementById('membershipForm');
var xhr 	= new XMLHttpRequest();
var url 	= '../processing/addMember';

var agreeTerms = document.getElementById('agreeTerms');
submitMember.addEventListener("click", (e) => {
	e.preventDefault();
	if (fullnames.value == "") {
		alert("Your names are required");
		fullnames.focus();
		return false;
	}

	if (email.value == "") {
		alert("Your email is required");
		email.focus();
		return false;
	}

	if (password.value == "") {
		alert("Create password ");
		password.focus();
		return false;
	}
	if (password2.value == "") {
		alert("Retype password");
		password2.focus();
		return false;
	}

	if (password.value !== password2.value) {
		alert("Passwords not Marching");
		return false;
		password1.focus();
		password2.focus();
	}

	if (agreeTerms.checked != true) {
		alert("Please agree to terms");
		agreeTerms.focus();
		return false;
	}
	xhr.open("POST", url, true);
	var data 	= new FormData(membershipForm);
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200) {
			alert(xhr.responseText);
		}
	}
	xhr.send(data);
})
