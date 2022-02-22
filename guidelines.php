<!-- <base href="http://localhost/2remote.com/"> -->
<!DOCTYPE html>
<html>
<head>
	<?php include("../support/header.php")?>
</head>
<body>
	<?php include ("../support/nav.php"); ?>
	<div class="container mt-5">
		<div class="main_section">
			<div class="row">
				<div class="col-md-5">
					<h1 class="mb-4">Guide lines for Listing</h1>
					<p>This refers to the listing guideline set by Osabox Limited Company</p>
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="<?php echo  basename($_SERVER['REQUEST_URI'])?>"><?php echo ucwords(basename($_SERVER['REQUEST_URI']))?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="terms-of-use">Terms of use</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="privacy">Privacy</a>
						</li>
					</ul>
				</div>
				<div class="col-md-7 mt-5">

					<div class="accordion" id="accordionExample">
					  	<div class="accordion-item">
						    <h2 class="accordion-header" id="headingOne">
						      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						        <h4> When to list a client</h4>
						      </button>
						    </h2>
						    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parents="#accordionExample">
						      <div class="accordion-body">
						        <p>Money Lenders - You can list a client after you have borrowed them your money, they have signed for it. Car Hiring -  You also can list a client after you have leased them your vehicle, they have singed all the agreement forms and have driven away.</p>
						        <p>Listing a client is also a way to keep records of how many clients have come through to your business and done business with you and also you get to understand how they behaved towards your business.</p>
						      </div>
						    </div>
					  	</div>
					  	<div class="accordion-item">
						    <h2 class="accordion-header" id="headingTwo">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						        <h4>False Information</h4>
						      </button>
						    </h2>
						    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parents="#accordionExample">
						      <div class="accordion-body">
						        <p>Here, you are not be allowed to list a person or company that you have not traded with or done business with, you need to be sure that the information you are providing is not falsified. We will ask you to provide evidence in-terms of documentations, such as invoice, receipts and proof or payments or lease.</p>
						      </div>
						    </div>
					  	</div>
					  	<div class="accordion-item">
						    <h2 class="accordion-header" id="headingThree">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						        <h4>Edit or delete the listing</h4>
						      </button>
						    </h2>
						    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parents="#accordionExample">
						      <div class="accordion-body">
						        <p>You own the rights to the information you have submitted, you can edit the listing and rating given to your client, you can also delete the listing, (We will serve the information for 30 days after you delete it before completely removing it from our database). </p>
						      </div>
						    </div>
					  	</div>
					  	<div class="accordion-item">
						    <h2 class="accordion-header" id="headingFour">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						        <h4>More Information</h4>
						      </button>
						    </h2>
						    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parents="#accordionExample">
						      <div class="accordion-body">
						        <p>We will keep updating these guidelines without giving you notice. Please understand that we have the final say concerning the way you list a client and if we deem your information to be false, we will delete it.</p>
						      </div>
						    </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include("../support/footer.php")?>
</body>
</html>