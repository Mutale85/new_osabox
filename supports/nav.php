<nav class="navbar navbar-expand-lg navbar-light bg-whites fixed-top">
	<div class="container">
		<a class="navbar-brand" href="./"><img src="images/logo.png" class="img-fluid" alt="logo" width="140"></a>
		<div class="navbar-toggler three cols" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		    <div class="hamburger" id="hamburger-8">
		      	<span class="line"></span>
		      	<span class="line"></span>
		      	<span class="line"></span>
		    </div>
		</div>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
	  		<ul class="navbar-nav mx-auto">
			    <li class="nav-item">
			      	<a class="nav-link text-darks fs-5" href="prices" title="pricing">Pricing</a>
			    </li>
			    <li class="nav-item">
			      	<a class="nav-link text-darks fs-5" href="contact" title="contact">Contact</a>
			    </li>
			
			    <li class="nav-item">
			      	<a class="nav-link text-darks fs-5 ml-5" aria-current="page" href="app/login" title="login">Login</a>
			    </li>
	    		<li class="nav-item">
	      			<a class="nav-link text-darks fs-5 ml-5" href="register" title="register">Start Doing <i class="bi bi-arrow-right"></i></a>
	    		</li>
	    		<!-- <li class="nav-item">
	      			<a class="nav-link text-darks ml-5 darkMode" href="darkMode" title="darkMode"> <i class="bi bi-moon-fill"></i></a>
	    		</li> -->
	  		</ul>
		</div>
	</div>
</nav>

<script>
	$(function(){
		$(document).on("click", ".darkMode", function(e){
			e.preventDefault();
			$(".navbar").addClass("navbar_");
			$(".navbar-light .navbar-nav .nav-link").css("color", "#fff");
			$("body").addClass("body_");
		})
	})
</script>