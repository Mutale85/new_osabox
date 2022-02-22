/*-------------------------
/* Register.php
/*-------------------------*/

function checkUrlValidity(url){
	if(!url.match(/^(ht|f)tps?:\/\/[a-z0-9-_\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/)){
		$("#url-error").html("Url must start with http:// or https:// and should be in lowercase.").addClass("url-error");
		return false;
	}else{
		$("#url-error").html("");
	}
}


var re = /\S+@\S+\.\S+/;
function validateEmail(argument) {
    return re.test(argument);
}

/*--------- PASSWORD -------------*/
var showpass = document.getElementById('showpass');
var password = document.getElementById('password');
function showHidePass(){
    if(showpass.checked == true) {
        password.type = 'text';
    }else if(showpass.checked == false){
        password.type = 'password';
    }
}
    
function registerForm(){
    event.preventDefault();
    var _username       = document.getElementById('username');
	var _website_link   = document.getElementById('website_link');
	var _email          = document.getElementById('email');
	var _password       = document.getElementById('password');
	var _service        = document.getElementById('service');
    
    var website_link    = _website_link.value;
    var email           = _email.value;
    var password        = _password.value;
    var username        = _username.value;
    var service         = _service.value;

    
    if (website_link == "") {
        alert("Please add your website url");
        _website_link.focus();
        return false;
    }
    if(!website_link.match(/^(ht|f)tps?:\/\/[a-z0-9-_\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/)){
		alert("Url must start with http:// or https:// and should be in lowercase.");
		_website_link.focus();
		return false;
	}
    
    if (service == "") {
        alert("Please select service you wish to try");
        _service.focus();
        return false;
    }

    if (username == "") {
        alert("Your name is required");
        _username.focus();
        return false;
    }

    if (email == "") {
        alert("Email is required");
        _email.focus();
        return false;
    }

    if (!validateEmail(email)) {
        alert("Invalid Email");
        return false;
    }

    if (password == "") {
        alert("Create a secure password");
        _password.focus();
        return false;
    }
    var xhr          = new XMLHttpRequest();
    var url             = 'parsers/registerUser';
    // var data ='website_link='+website_link +'&username='+username + '&email=' + email + '&password='+password;  
    xhr.open("POST", url, true);
    var websiteForm = document.getElementById('websiteForm');
    var data = new FormData(websiteForm);
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            document.getElementById('result').innerHTML = result;
            document.getElementById('submitBtn').innerHTML = "Register";
        }
    }
    xhr.send(data);
    document.getElementById('submitBtn').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Proccessing...';
}



/*--------------------------------
/* APPSUMO REGISTER 
/*-------------------------------*/

var _username               = document.getElementById('username');
var _website_link           = document.getElementById('website_link');
var _email                  = document.getElementById('email');
var _appsumocode            = document.getElementById('appsumocode');
var _password               = document.getElementById('password');

function checkValue(category){
    if (category == "Other") {
        website_category.style.display = "none";
        other_website_category.style.display = "block";
    }else{
        other_website_category.style.display = "none";
        website_category.style.display = "block";
    }
}

var re = /\S+@\S+\.\S+/;
function validateEmail(argument) {
    return re.test(argument);
}

function appsumoSubmitForm(){
    event.preventDefault();
    var xhr             = new XMLHttpRequest();
    var url             = 'parsers/registerAppsumoUser';
    var website_link    = _website_link.value;
    var email           = _email.value;
    var appsumocode     = _appsumocode.value;
    var password        = _password.value;
    var username        = _username.value;

    if (website_link == "") {
        alert("Please add your website url");
        _website_link.focus();
        return false;
    }

    if(!website_link.match(/^(ht|f)tps?:\/\/[a-z0-9-_\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/)){
        alert("Url must start with http:// or https:// and should be in lowercase.");
        _website_link.focus();
        return false;
    }

    if (username == "") {
        alert("Your name is required");
        _username.focus();
        return false;
    }

    if (email == "") {
        alert("Email is required");
        _email.focus();
        return false;
    }
    if (appsumocode == "") {
        alert("Appsumo code is required");
        _appsumocode.focus();
        return false;
    }

    if (!validateEmail(email)) {
        alert("Invalid Email");
        return false;
    }

    if (password == "") {
        alert("Create a secure password");
        _password.focus();
        return false;
    }

    var appsumoForm = document.getElementById('appsumoForm');
    var data = new FormData(appsumoForm);
    xhr.open("POST", url, true);
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            document.getElementById('result').innerHTML = result;
            document.getElementById('btn-submit').innerHTML = "Submit AppSumo Code";
        }
    }
    xhr.send(data);
    document.getElementById('btn-submit').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
}


function dayFunction() {
    var d = new Date();
    var n = d.getDay()
    var day = "";
    if(n == 0){
       day = "Sunday"; 
    }
    else if (n == 1) {
        day = "Monday";
    }
    else if (n == 2) {
        day = "Tuesday";
    }
    else if (n == 3) {
        day = "Wednesday";
    }
    else if (n == 4) {
        day = "Thursday";
    }
    else if (n == 5) {
        day = "Friday";
    }
    else if (n == 6) {
        day = "Saturday";
    }

    var xhr = new XMLHttpRequest();
    var data = "setday="+day;
    xhr.open("POST", "cronjob/weeklyreport");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            var print = xhr.responseText;
        }
    }
    xhr.send(data);
    
}
setInterval(function(){

}, 1000*60*60*24);


jQuery('.copy-btn').on('click', function() {
    $(".code-text").removeAttr("disabled").select();
    if(document.execCommand('copy')){
        alert("Copied");
        $(".code-text").attr("disabled", "disabled");
    }else{
        alert("errors");
    }
})
// get website links
var x = document.querySelectorAll("a");
var myarray = []
for (var i=0; i<x.length; i++){
    var nametext = x[i].textContent;
    var cleantext = nametext.replace(/\s+/g, ' ').trim();
    var cleanlink = x[i].href;
    links = myarray.push([cleantext,cleanlink]);
};


/* ---------------------------------------*/
/* LOGIN SCRIPT 
/*-----------------------------------------*/ 

var _email 		= document.getElementById('email');
var _password 	= document.getElementById('password');
var em_error	= document.getElementById('em_error');
var pass_msg	= document.getElementById('pass_msg');


var reg = /\S+@\S+\.\S+/;
function validateEmail(argument) {
	return reg.test(argument);
}

function showPass(){
	if (_password.type == "password") {
		_password.type = "text";
		$(".fa-eye").addClass("fa-eye-slash");
	}else{
		_password.type = 'password';
		$(".fa-eye").removeClass("fa-eye-slash");
	}
}

function loginVanilla(){
	event.preventDefault();
	var email 		= _email.value;
	var	password 	= _password.value;
	if (email == "") {
		em_error.innerHTML = "Email is required";
		_email.focus();
		return false;
	}else{
		em_error.innerHTML = "";
	}

	if (!validateEmail(email)) {
		em_error.innerHTML = "Invalid Email";
		_email.focus();
		return false;
	}else{
		em_error.innerHTML = "";
	}

	if (password == "") {
		pass_msg.innerHTML = "Password is required";
		_password.focus();
		return false;
	}else{
		pass_msg.innerHTML = "";
	}

	var xhr 	= new XMLHttpRequest();
	var url 	= "parsers/loginUser";
	var data 	= "email="+email+"&password="+password;
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			var result = xhr.responseText;
			if(result == "Success"){
				// window.location = "web-profile";
            	window.location = "dashboard/monitors";
			}else{
				alert(result);
				window.location = 'login';
				document.getElementById('result').innerHTML = xhr.responseText;
				document.getElementById('LoginForm').reset();
			}
		}else{
			return false;
		}
	}
	
	document.getElementById('loginBtn').innerHTML = "Processing...";
	xhr.send(data);
}





