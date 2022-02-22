<!DOCTYPE html>
<html>
<head>
	<?php
		include 'supports/header.php';
	?>
	<title>Account Activation Successful</title>
	<style type="text/css">
		.message {
			margin: 10em auto;
			padding: 3em;
			border-radius:5px;
	    	
		}
		.boxes {
			width:50%;
	    	margin:2em auto;
	    	
		}
		i.icons {
			font-size: 2.5em;
			color: mediumseagreen;
		}
		@media(max-width:767px) {
	    	.boxes {
	    		width:100%;
	    	}
		}
	</style>
</head>
<body>

<?php
include 'supports/nav.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="message">
				<?php
					if (isset($_GET['message'])) {
						$msg = $_GET['message'];
						if($msg == "Activated"){?>
            				<div class="boxes">
						    	<h1 class="mb-3 text-success">You Account is Activated</h1>
                            	<p class="mb-3 fs-4">Thank you for registering with us. Incase of anything, reach me at: info@osabox.net or mutamuls@gmail.com</p>
                            	<div class="d-flex justify-content-between">
                            		<div class="">
						    			<i class="icons bi bi-check2-all"></i> <i class="icons bi bi-check2-circle"></i> <i class="icons bi bi-check2-square"></i>
						    		</div>
						    		<div>
                            			<p class="text-center mt-2"><a href="https://login.osabox.co" title="login" class="btn btn-secondary text-center"> Login </a></p>
                            		</div>
                            	</div>
            				</div>
					    <?php
						    
						}else{
						  echo $msg;  
						}
					}else{
						header("location:./");
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
include 'supports/footer.php';
?>
</body>
</html>
