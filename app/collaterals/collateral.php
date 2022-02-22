<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php");

	$sqlC = $connect->prepare("SELECT * FROM `collaterals` WHERE loan_number = ? AND borrower_id = ? ");
	$sqlC->execute(array($_GET['loan_number'], $_GET['borrower_id']));
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Borrowers of <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], base64_decode($_COOKIE['SelectedBranch'])))?></title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<!-- <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<!-- <link rel="stylesheet" href="plugins/select2/css/select2.min.css"> -->
	<style>
		
		.cursor-pointer {
			cursor: pointer;
			font-size: 1em;
		}
		.cursor-pointer {
			cursor: pointer;
			font-size: 1em;
		}
		
	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content bg-light">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 border-bottom pb-2 mb-5 ">
      						<div class="d-flex justify-content-between">
      						<h1 class="h3"><?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], base64_decode($_COOKIE['SelectedBranch'])))?> Collateral</h1>
      							
      						</div>
      					</div>

      				</div>
      			</div>
      			<!-- borrower form -->
      			<div class="container">
      				<div class="row">
      					<!-- <div class="col-md-2"></div> -->
      					<div class="col-md-">
      						<div class="card card-primary card-outline ">
      							<form class="" method="post" id="collateralForm" enctype="multipart/form-data">
									<div class="card-header">
										<?php
											if($sqlC->rowCount() > 0){?>
												<h4><?php echo getBorrowerFullNamesByCardId($connect, $_GET['borrower_id'])?> has <?php echo $sqlC->rowCount()?> Collateral(s)</h4>
											<?php
											}else{
												echo '<h4 class="mb-3">Add Collateral</h4>';
											}

										?>
									</div>
									<div class="card-body mb-5">
		      							<div class="row">
											<div class="form-group col-md-6">
												<label for="collateral_type">Type</label>
												
													<select class="form-control" name="collateral_type" id="collateral_type">
														<option value="Automobiles">
														Automobiles
														</option>
														<option value="Electronic Items">
														Electronic Items
														</option>
														<option value="Insurance policies">
														Insurance policies
														</option>
														<option value="Investments">
														Investments
														</option>
														<option value="Machinery and equipment">
														Machinery and equipment
														</option>
														<option value="Real estate">
														Real estate
														</option>
														<option value="Valuables and collectibles">
														Valuables and collectibles
														</option>
													</select>
												<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID ?>">
			      								<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
			      								<input type="hidden" name="loan_number" id="loan_number" value="<?php echo $_GET['loan_number']?>">
			      								<input type="hidden" name="ID" id="ID" value="">
			      								<input type="hidden" name="borrower_id" id="borrower_id" value="<?php echo $_GET['borrower_id']?>">
											</div>
											<div class="form-group col-md-6">
												<label for="product_name">Product name</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-product"></i></span>
													<input type="text"  name="product_name" id="product_name" class="form-control">
												</div>
											</div>
											
											<div class="form-group col-md-6">
												<label for="form">Register Date</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-calendar"></i></span>
													<input type="text" name="register_date" id="register_date" class="form-control">
												</div>
											</div>
											
											<div class="form-group col-md-6">
												<label for="product_value">Value</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-wallet"></i></span>
													<input type="number" step="any" name="product_value" id="product_value" class="form-control" placeholder="Amount">
													<input type="hidden" name="currency" value="ZMW">
													<span class="input-group-text"><i class="bi bi-dollar"></i></span>
												</div>
											</div>
											<div class="col-md-12 bg-secondary p-2 mt-5 mb-5 shadow-md">
												<!-- <div class="border-bottom border-primary mb-3 mt-3"></div> -->
												<h4 >Collateral Status</h4>
											</div>
											<div class="form-group col-md-6">
												<label for="status">Where is the Collateral ?</label>
												<select class="form-control" name="product_location" name="product_location">
													<option value="Deposited into Branch">Deposited into Branch</option>
													<option value="Collateral with Borrower">Collateral with Borrower</option>
													<option value="Returned to Borrower">Returned to Borrower</option>
													<option value="Repossession Initiated">Repossession Initiated</option>
													<option value="Repossesed">Repossesed</option>
													<option value="Under Auction">Under Auction</option>
													<option value="Sold">Sold</option>
													<option value="Lost">Lost</option>
												</select>
											</div>
											
											<div class="form-groups col-md-6">
												<label for="form">When?</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-calendar"></i></span>
													<input type="text" name="action_date" id="action_date" class="form-control">
												</div>
											</div>
											<div class="form-group col-md-12">
												<label>Address</label>
												<input type="text" name="address" id="address" class="form-control">
												<em>If collateral is with the borrower, add address where it is located</em>
											</div>
											<div class="col-md-12 bg-secondary p-2 mt-5 mb-5 shadow-md">
												<!-- <div class="border-bottom border-primary mb-3 mt-3"></div> -->
												<h4> Product Details</h4>
											</div>
											<div class="form-group col-md-6">
												<label>Serial #</label>
												<input type="text" name="serial_number" id="serial_number" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Model name </label>
												<input type="text" name="model_name" id="model_name" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Model #</label>
												<input type="text" name="model_number" id="model_number" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Product Color</label>
												<input type="text" name="color" id="color" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Manufature Date</label>
												<input type="text" name="manufature_date" id="manufature_date" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Product condition</label>
												<select class="form-control" name="product_condition" name="product_condition">
													<option value=""></option>
													<option value="Excellent">Excellent</option>
													<option value="Good">Good</option>
													<option value="Fair">Fair</option>
													<option value="Damaged">Damaged</option>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label>Product Description</label>
												<textarea class="form-control" rows="4" name="description" id="description"></textarea>
											</div>
											
											<div class="form-group col-md-4 mb-3">
												<label for="form">Collateral Photo</label>
												<div class=" border p-3">
													<button class="btn btn-warning mb-3" type="button" id="selectImage">Select Image <i class="bi bi-file-person"></i></button><br>
													<input type="file" name="photo" id="photo" class="form-control"  style="display: none;" onchange="preview_image(event)">
													<img src="dist/img/avatar2.png" id="output_image" class="shadow-sm img-fluid img-responsive" alt="pic" width="140">
												</div>
												<em>Add a clear photo of the product</em>
											</div>
											<div class="form-group col-md-4 mb-3">
												<label for="form">Collateral Files</label>
												<div class="border p-3">
													<button class="btn btn-warning" type="button" id="selectFiles">Select Files <i class="bi bi-files"></i></button>
													<input type="file" name="files[]" id="files" class="form-control" style="display: none;" multiple onchange="javascript:updateList()">

													<div id="fileList"></div>
												</div>
												<em>Add reciepts, and any documents to support ownership</em>
											</div>
											<div class="col-md-12 bg-secondary p-2 mt-5 mb-5 shadow-md">
												<!-- <div class="border-bottom border-primary mb-3 mt-3"></div> -->
												<h4 >For Vehicles only </h4>
											</div>
											<div class="form-group col-md-4">
												<label>Registration Number</label>
												<input type="text" name="vehicle_reg_number" id="vehicle_reg_number" class="form-control" placeholder="Reg Number">
											</div>
											<div class="form-group col-md-4">
												<label>Millage</label>
												<input type="text" name="millage" id="millage" class="form-control" placeholder="Millage">
											</div>
											<div class="form-group col-md-4">
												<label>Engine No.</label>
												<input type="text" name="vehicle_engine_num" id="vehicle_engine_num" class="form-control" placeholder="Engine No.">
											</div>

										</div>
									</div>
									<div class="card-footer mb-0">
										<!-- <button class="btn btn-outline-light" type="button" onclick="_reset()"> Cancel</button> -->
										<button class="btn btn-primary w-100" type="submit" id="cBtn" onclick="addCollateral(event)">Submit</button>
									</div>
								</form>
      						</div>
      					</div>
      					<!-- <div class="col-md-2"></div> -->
      				</div>
      			</div>
      		</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<?php include("../footer_links.php")?>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<!-- <script src="plugins/select2/js/select2.full.min.js"></script> -->
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		$(document).ready( function () {
		    // $('#myTable').DataTable();
		    // $('.select2').select2();
		
			$("#borrower_dateofbirth, #register_date, #action_date, #manufature_date").datepicker({

				format: 'yyyy-mm-dd',
				autoclose:true
			});
		})
		
	</script>
	<script>

		// =========================== find loan officers -==============
		

		

	  	var input = document.getElementById('collateral_type');
	  	input.onchange = function () {
	    	localStorage['collateral_type'] = this.value;
	    	alert(this.value);
	  	}
	  	document.addEventListener('DOMContentLoaded', function () {
	     	var input = document.getElementById('collateral_type');
	     	if (localStorage['collateral_type']) { 
	         	input.value = localStorage['collateral_type'];
	     	}
	     	input.onchange = function () {
	          	localStorage['collateral_type'] = this.value;
	      	}
	  	});
	   
	   // images ------ 
	   	
		var selectImage = document.getElementById('selectImage');
  		var fileInput = document.getElementById('photo');
  		selectImage.addEventListener("click", (e) => {
  			$('#photo').click();
  		});

		function preview_image(event) {
			var reader = new FileReader();
			reader.onload = function(){
				var output = document.getElementById('output_image');
				output.src = reader.result;
			}
			reader.readAsDataURL(event.target.files[0]);
		}

		document.getElementById('selectFiles').addEventListener("click", (e)=> {
			document.getElementById('files').click();
		})

	    updateList = function() {
			var input = document.getElementById('files');
			var output = document.getElementById('fileList');

			output.innerHTML = '<ul>';
			for (var i = 0; i < input.files.length; ++i) {
			output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
			}
			output.innerHTML += '</ul>';
		}
		
		addCollateral = function() {
			event.preventDefault();
			var xhr = new XMLHttpRequest();
			var url = 'collaterals/submitCollateral?<?php echo time()?>';
			var collateralForm = document.getElementById('collateralForm');
			var collateral_type = document.getElementById('collateral_type');
			var product_value = document.getElementById('product_value');
			var product_name = document.getElementById('product_name');
			xhr.open("POST", url, true);
			var data = new FormData(collateralForm);
			if (collateral_type.value === "") {
				errorNow("Collateral type is required");
				collateral_type.focus();
				return false;
			}
			if (product_name.value === "") {
				errorNow("Product name is required");
				product_name.focus();
				return false;
			}
			if (product_value.value === "") {
				errorNow("Product Value is required");
				product_value.focus();
				return false;
			}
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					if (xhr.responseText === 'done') {
						successNow(product_name.value + ' added as collateral for <?php echo getBorrowerFullNamesByCardId($connect, $_GET['borrower_id'])?>');
						setTimeout(function(){
							location.reload();
						}, 2000)
						document.getElementById("cBtn").innerHTML = 'Submit';

					}else{
						// alert(xhr.responseText);
						errorNow(xhr.responseText);
						// $("#collateralForm")[0].reset();
						document.getElementById("cBtn").innerHTML = 'Submit';
						return false;
					}
					
				}
			}
			xhr.send(data);
			document.getElementById("cBtn").innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
		}

		function successNow(msg){
			toastr.success(msg);
	      	toastr.options.progressBar = true;
	      	toastr.options.positionClass = "toast-top-center";
	    }

		function errorNow(msg){
			toastr.error(msg);
	      	toastr.options.progressBar = true;
	      	toastr.options.positionClass = "toast-top-center";
	    }
		
	</script>
</body>
</html>