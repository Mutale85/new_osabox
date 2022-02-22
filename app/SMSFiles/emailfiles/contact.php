<!DOCTYPE html>
<html lang="en">
<?php include("supports/header.php");?>
<title>Get in Touch with weblister.co | Uptime Monitoring and Traffic Analytics</title>
<style>
.intro-section {
	
}
.contactform {
	margin:8em auto;
	padding: 0.625em;
}
#success-message {
  	opacity: 0;
}

.margin-top-25 {
  	margin-top: 1.5625em;
}

.form-title {
  	padding: 1.5625em;
  	font-size: 1.875em;
  	font-weight: 300;
  	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}

.contactform .form-group .form-control {
  	-webkit-box-shadow: none;
  	border-bottom: 1px;
  	border-style: none none solid none;
  	border-radius:0; 
  	border-color: #d1d1d1;
}

.contactform .form-group .form-control:focus {
	box-shadow: none;
  	border-width: 0 0 0.125em 0;
  	border-color: #d1d1d1;
}

textarea {
  	resize: none;
}

.btn-mod.btn-large {
    height: auto;
    padding: 0.8125em 3.25em;
    font-size: 0.9375em;
}
.btn-mod.btn-border {
    color: #d1d1d1
    border: 0.0625em solid #d1d1d1
    background: transparent;
}

.btn-mod, a.btn-mod {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 4px .8125em;
    color: #fff;
    background: rgba(34,34,34, .9);
    border: 0.0625em solid transparent;
    font-size: 0.6875em;
    font-weight: 400;
    text-transform: uppercase;
    text-decoration: none;
    letter-spacing: 2px;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-transition: all 0.2s cubic-bezier(0.000, 0.000, 0.580, 1.000);
    -moz-transition: all 0.2s cubic-bezier(0.000, 0.000, 0.580, 1.000);
    -o-transition: all 0.2s cubic-bezier(0.000, 0.000, 0.580, 1.000);
    -ms-transition: all 0.2s cubic-bezier(0.000, 0.000, 0.580, 1.000);
    transition: all 0.2s cubic-bezier(0.000, 0.000, 0.580, 1.000);
}

.btn-mod.btn-border:hover, .btn-mod.btn-border:active, .btn-mod.btn-border:focus, .btn-mod.btn-border:active:focus {
    color: #fff;
    border-color: #000;
    background: #000;
    outline: none;
}
.commentsDiv {
    margin:5em;
}


@media screen and (max-width: 767px) {
    .btn-mod.btn-large {
       padding: 0.375em 1em;
       font-size: 0.6875em;
    }
  
    .form-title {
        font-size: 1.25em;
  	}
}
</style>
<body>

<?php include("supports/nav.php");?>

	<!-- Header section end -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">
				<br><br><br><br><br><br><br><br><br><br><br><br>
				
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<div class="contactform">
						<h2 class="form-title text-center">Get in Touch</h2>
						<form id="contact-form" method="POST" enctype="multipart/form-encode">
							<div class="form-group">
								<label class="form-label" id="nameLabel" for="name"></label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Your name" tabindex="1">
							</div>
							<div class="form-group">
								<label class="form-label" id="emailLabel" for="email"></label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Your Email" tabindex="2">
							</div>
							<div class="form-group">
								<label class="form-label" id="subjectLabel" for="sublect"></label>
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" tabindex="3">
							</div>
							<div class="form-group">
								<label class="form-label" id="messageLabel" for="message"></label>
								<textarea rows="6" cols="60" name="message" class="form-control" id="message" placeholder="Your message" tabindex="4"></textarea>                                 
							</div>
							<div class="text-center margin-top-25">
								<button type="submit" class="btn btn-mod btn-border btn-large" id="sendBtn">Send Message</button>
							</div>

							<div class="result"></div>
						</form>
					</div>
				</div>
			</div>
		</div> 
	</section>
<?php include("supports/footer.php");?>
<script>
	$(function(){
		$(document).on("submit", "#contact-form", function(event){
			event.preventDefault();
		    var name = document.getElementById('name').value;
		    var email = document.getElementById('email').value;
		    var subject = document.getElementById('subject').value;
		    var message = document.getElementById('message').value;
		    var onlyLetters =/^[a-zA-Z\s]*$/; 
		    var onlyEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		    
		    
		    if(name == "" || name == null){
		        document.getElementById('nameLabel').innerHTML = ('Please enter your name');
		        document.getElementById('name').style.borderColor = "red";
		        return false;
		    }
		       
		  
		    if (!name.match(onlyLetters)) {
		        document.getElementById('nameLabel').innerHTML = ('Please enter only letters');
		        document.getElementById('name').style.borderColor = "red";
		        return false;
		    }
		  
		    if(email == "" || email == null ){
		          document.getElementById('emailLabel').innerHTML = ('Please enter your email');
		          document.getElementById('email').style.borderColor = "red";
		          return false;
		      }
		  
		    if (!email.match(onlyEmail)) {
		        document.getElementById('emailLabel').innerHTML = ('Please enter a valid email address');
		        document.getElementById('email').style.borderColor = "red";
		        return false;
		    }
		  
		    if(subject == "" || subject == null ){
		          document.getElementById('subjectLabel').innerHTML = ('Please enter your subject');
		          document.getElementById('subject').style.borderColor = "red";
		          return false;
		      }
		  
		    if (!subject.match(onlyLetters)) {
		        document.getElementById('subjectLabel').innerHTML = ('Please enter only letters');
		        document.getElementById('subject').style.borderColor = "red";
		        return false;
		    }
		  
		    if(message == "" || message == null){
		        document.getElementById('messageLabel').innerHTML = ('Please enter your message');
		        document.getElementById('message').style.borderColor = "red";
		        return false;
		    }

	    	// var contactform = document.getElementById("contact-form");
	    	var contactformData = $(this).serialize("#contact-form");
	        $.ajax({
	        	url:"processing/contact",
	        	method:"post",
	        	data:contactformData,
	        	beforeSend:function(){
	        		$("#sendBtn").html('<i class="fa fa-spinner fa-spin"></i>').attr("disabled", "disabled");
	        	},
	        	success:function(data){
	        		// $("#contact-form")[0].reset();
	        		$(".result").html(data).removeAttr("disabled");
	        		$("#sendBtn").html("Send Message");
	        	}
	        })
    	}) 
	})
</script>
</body>
</html>