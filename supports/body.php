<section class="sectionOne">
	<div class="container-md">
		<img src="dist/images/lines.svg" class="lines" alt="lines">
		<div class="front">
			<h1 class="alphaTitle text-center mb-5">Analytics & uptime monitoring <span class="titleSpan"><?php echo number_format(1440) ?></span> times a day</h1>

			<p class="text-center h4 mb-2">24/7 uptime and downtime monitoring</p> 
			<p class="text-center h4 mb-0">Up to the minute Email and SMS Alerts</p>
			<div class="text-center mt-5"><a href="register" title="start" class="buttonMain w-100">Start Monitoring in 30 Seconds</a></div>
		</div>
	</div>
</section>
<section class="numbersSection p-5">
	<div id="displayCounts"></div>
</section>
<!-- section Features -->
<section class="featuresSection py-5">
	<div class="w-100"></div>
	<div class="container">

	 	<div class="row align-items-center">
	 		<div class="col-12">
	 			<div class="featuresIntro">
					<h2 class="featuresHead">Industry standard features and beyond, for a <span class="feature-special-text">fraction</span> of the price</h2>
				</div>
	 		</div>
			<div class="col-sm-4">
			  	<div class="featuresText bg-light p-5 mb-4">
			  		<div class="icon"><img src="dist/images/globeworld.svg" alt="globeworld" class="img mb-3"></div>
			  		<h2 class="feature-title my-4"> Uptime Monitoring</h2>
			  		<p>Get to have a peace of mind, knowing that your website is being monitored for uptime every 1 minutes and you will be notified if it ever goes down.</p>
			  	</div>
			</div>
			<div class="col-sm-4">
			  	<div class="featuresText bg-light p-5 mb-4">
			  		<div class="icon"><img src="dist/images/shield.svg" alt="shield" class="img mb-3"></div>
			  		<h2 class="feature-title my-4">SSL Monitoring</h2>
			  		<p>SSL certificate gives confidence to your clients that your website is credible. Let us send you reminders 15 days, 10 days and 5 days before your SSL expires.</p>
			  	</div>
			</div>
			<div class="col-sm-4">
			  	<div class="featuresText bg-light p-5 mb-4">
			  		<div class="icon"><img src="dist/images/power.svg" alt="power" class="img mb-3"></div>
			  		<h2 class="feature-title my-4">Port Monitoring</h2>
			  		<p>Let us monitor your servers online status 1440 times a day, add your mail server port and we keep track of it. We ping your listed ports every one minute.</p>
			  	</div>
			</div>
			<div class="col-sm-4">
			  	<div class="featuresText bg-light p-5 mb-4">
			  		<div class="icon"><img src="dist/images/lock.svg" alt="lock" class="img mb-3"></div>
			  		<h2 class="feature-title my-4">GDPR Compliant</h2>
			  		<p>We do not use cookies to track your site visitors. We do not collect personal data, hence, you do not need to display the cookie compliance banner.</p>
			  	</div>
			</div>
			<div class="col-sm-4">
			  	<div class="featuresText bg-light p-5 mb-4">
			  		<div class="icon"><img src="dist/images/credit-card.svg" alt="credit-card" class="img mb-3"></div>
			  		<h2 class="feature-title my-4">100% Data Ownership</h2>
			  		<p>While big companies make millions with data collected from your sites. We will never sell your data. All traffic coming through to your site is 100% yours.</p>
			  	</div>
			</div>
			<div class="col-sm-4">
			  	<div class="featuresText bg-light p-5 mb-4">
			  		<div class="icon"><img src="dist/images/users.svg" alt="users" class="img mb-3"></div>
			  		<h2 class="feature-title my-4">Add teams for free</h2>
			  		<p>You have a team? you can add them and and give them roles that will keep them to see the websites data which you give them rights to.</p>
			  	</div>
			</div>
		</div>
		<div class="w-100"></div>
		<div class="col-12 mb-4">
			<div class="callToActDiv">
				<div class="text-center my-5"><a href="features" title="features" class="view-all-features">view all features</a></div>
				<div class="text-center pd-5"><a href="register" title="start" class="buttonMain">Start Monitoring in 30 Seconds</a></div>
			</div>
		</div>
	 </div>
</section>
<!-- testimonials -->
<section class="testimonials py-5" id="reviews">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="testimonialsDiv">
					<h2 class="featuresHead">Our customers <span class="feature-special-text">love</span> our service</h2>
				</div>
			</div>
			<?php
			function clickAble($string){
				$find = array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si', '`((?<!//)(www\.\S+[[:alnum:]]/?))`si');
				$replace = array('<a href="$1" target="_blank">$1</a>', '<a href="http://$1" target="_blank">$1</a>');
				return preg_replace($find, $replace, $string);
			}
			$query = $connect->prepare("SELECT * FROM reviews WHERE rating = 5 OR rating = 4 ORDER BY RAND()");
    		$query->execute();
    		$count = $query->rowCount();
    		$results = $query->fetchAll();
            $output = "";
    		foreach($results as $row):
    			if($row):
        		$id 	= $row['id'];
                	$name 	= $row['name'];
                	$url 	= $row['url'];
                	$rating = "";
                	$review = $row['review'];
                
                	if($row['rating'] == '5') {
                    	$rating = '
                        			<img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img"> 
                        			<img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    <img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    <img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    <img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    ';
                    }else if($row['rating'] == 4){
                    	$rating = '
                        			<img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img"> 
                        			<img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    <img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    <img src="bootstrap-icons/icons/star-fill.svg" alt="star-fill" class="img">
                                    <img src="bootstrap-icons/icons/star-half.svg" alt="start-fill" class="img">
                                    ';
                    }
                ?>
	            <div class="col-sm-6">
					<div class="bg-lights testimonialsBox mb-4">
						<div class="sideIcon"><img src="dist/images/Groupuser.svg" alt="aspect-ratio" class="img mb-2" width="40" height="40"> <?php echo $rating ?></div>
						<p class="review text-muted"><?php echo $review ?></p>
						<h5><?php echo $name?> </h5>
						<a href="<?php echo $url?>" target="_blank" title="<?php echo rtrim(remove_http($url), '/')?>"><?php echo clickAble(rtrim(remove_http($url), '/'))?></a>
						<div class="mb-3"></div>
					</div>
				</div>

	            <?php

                    endif;
                endforeach;
				?>
		</div>
	</div>

</section>
<!-- graph -->
<section class="graphSection py-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="featuresHead">Start analyzing and monitoring your website today.</h2>
			</div>
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<div class="callToStart">
					<p class="callToStart-para text-center">Sign up for a 14 days free trial</p>
					<form method="post" class="websiteForm mb-4 p-4" id="websiteForm" autocomplete="off">
		           		<div class="form-floating mb-3">
							<input type="url" name="website_link" onkeyup="checkUrlPattern(this.value)" id="website_link" class="form-control form-control-lg" placeholder="https://" required="required">
							<label for="website_link">Your Website</label>
                        	<div id="url-error" class="mt-2 text-danger"></div>
						</div>
		           		<div class="form-floating mb-3">
							<input type="text" name="username" id="username" class="form-control form-control-lg" required="required" placeholder="John Doe">
							<label for="username">Your Names</label>
	               		</div>
                    	<div class="form-floating mb-3">
                            	
							<input type="text" name="phonenumber" id="phonenumber" class="form-control form-control-lg" required="required"  placeholder="John Doe">
							<label for="phonenumber">Your Phone e.g +123487739</label>
		               	</div>
		           		<div class="form-floating mb-3">
	           				<input type="email" name="email" id="email" class="form-control form-control-lg" required="required" placeholder="Email">
	           				<label for="email">Your Email</label>
	           				<input type="hidden" name="plan" id="plan" value="Trial">
	           				<input type="hidden" name="allowed_sites" id="allowed_sites" value="10">
	           				<input type="hidden" name="start_date" id="start_date">
	           				<input type="hidden" name="price" id="price" value="0.00">
	           				<input type="hidden" name="end_date" id="end_date" value="">
		           		</div>
		           		<div class="form-floating mb-3">
		           			<input type="password" name="password" id="password" class="form-control form-control-lg" required="required" placeholder="Create Password">
		           			<label for="password">Password</label>
		           			<input type="hidden" class="form-control" name="service" id="service" value="WM">
		           		</div>
		           		<label class="mt-1 mb-2"><input type="checkbox" id="showpass" onclick="showHidePass()"> Show Password</label>			           		
		           		<button id="submitBtn" type="submit" class="submitBtn w-100 my-2" onclick="registerForm()">Start Monitoring</button>
					</form>
		       		<div class="error-msg" class="text-danger"></div>
		       		<div id="emailHelp" class="form-text text-center"><h4>No Credit Card Required</h4></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="callToStart">
                	<a href="analytics-demo" title="analyticsImg"><img src="bg/newDash.png" class="img mb-3" alt="demo-analytics" height="500" width="100%"></a>
<!-- 					<iframe src="https://weblister.co/analytics-demo" name="iframe_a" height="500" width="100%" title="weblister.demo"></iframe> -->
					<div class="text-center"><a href="analytics-demo" class="analyzing" title="analyzing">Analytics Demo</a> | <a href="uptime-demo" class="uptime" title="uptime">Uptime Demo</a></div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	async function displayMonitors(){
		var xhr = new XMLHttpRequest();
		var url = "process/fetchCounts";
		var data = "fetchCounts=fetchCounts";
		xhr.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		       	document.getElementById("displayCounts").innerHTML = xhr.responseText;
		    }
		};
		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(data);
	}
	displayMonitors();
	// setInterval(displayMonitors, 1000);


function checkUrlPattern(url){
	if(!url.match(/^(ht|f)tps?:\/\/[a-z0-9-_\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/)){
		$("#url-error").html("Url must start with http:// or https:// and should be in lowercase.").addClass("url-error");
		return false;
	}else{
		$("#url-error").html(url);
	}
}

</script>