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

											if (isset($_GET['product_id'])) {
												$queryC = $connect->prepare("SELECT * FROM `collaterals` WHERE id = ? AND loan_number = ? AND borrower_id = ? ");
												$queryC->execute(array($_GET['product_id'], $_GET['loan_number'], $_GET['borrower_id']));
												$r = $queryC->fetch();
												$collateral_type = $branch_id = $parent_id = $loan_number = $borrower_id = $product_name = $register_date = $product_value = $currency = $product_location = $action_date = $address = $serial_number = $model_name = $model_number = $color = $manufature_date = $product_condition = $description = $photo = $files = $vehicle_reg_number = $millage = $vehicle_engine_num = "";
												if($r) {
													$id = $r['id'];
													$collateral_type = $r['collateral_type'];
													$product_name = $r['product_name'];
													$product_value = $r['product_value'];
													$register_date = $r['register_date'];
													$currency = $r['currency'];
													$product_location = $r['product_location'];
													$action_date = $r['action_date'];
													$address = $r['address'];
													$serial_number = $r['serial_number'];
													$model_name = $r['model_name'];
													$model_number = $r['model_number'];
													$color = $r['color'];
													$manufature_date = $r['manufature_date'];
													$product_condition = $r['product_condition'];
													$description = $r['description'];
													$photo = $r['photo'];
													$files = $r['files'];
													$vehicle_reg_number = $r['vehicle_reg_number'];
													$millage = $r['millage'];
													$vehicle_engine_num = $r['vehicle_engine_num'];
													// $collateral_type = $r['collateral_type'];
												}
											}
										?>
										
									</div>
									<div class="card-body mb-5">
		      							<div class="row">
											<div class="form-group col-md-6">
												<label for="collateral_type">Type</label>
												
													<select class="form-control" name="collateral_type" id="collateral_type">
														<option value="<?php echo $collateral_type?>" selected><?php echo $collateral_type?></option>
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
			      								<input type="hidden" name="ID" id="ID" value="<?php echo $_GET['product_id']?>">
			      								<input type="hidden" name="borrower_id" id="borrower_id" value="<?php echo $_GET['borrower_id']?>">
											</div>
											<div class="form-group col-md-6">
												<label for="product_name">Product name</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-product"></i></span>
													<input type="text"  name="product_name" id="product_name" class="form-control" value="<?php echo $product_name?>">
												</div>
											</div>
											
											<div class="form-group col-md-6">
												<label for="form">Register Date</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-calendar"></i></span>
													<input type="text" name="register_date" id="register_date" class="form-control" value="<?php echo $register_date?>">
												</div>
											</div>
											
											<div class="form-group col-md-6">
												<label for="product_value">Value</label>
												<div class="input-group mb-3">
													<span class="input-group-text"><i class="bi bi-wallet"></i></span>
													<input type="number" step="any" name="product_value" id="product_value" class="form-control" placeholder="Amount" value="<?php echo $product_value?>">
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
													<option value="<?php echo $product_location?>" selected><?php echo $product_location ?></option>
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
													<input type="text" name="action_date" id="action_date" class="form-control" value="<?php echo $action_date?>">
												</div>
											</div>
											<div class="form-group col-md-12">
												<label>Address</label>
												<input type="text" name="address" id="address" class="form-control" value="<?php echo $address?>">
												<em>If collateral is with the borrower, add address where it is located</em>
											</div>
											<div class="col-md-12 bg-secondary p-2 mt-5 mb-5 shadow-md">
												<!-- <div class="border-bottom border-primary mb-3 mt-3"></div> -->
												<h4> Product Details</h4>
											</div>
											<div class="form-group col-md-6">
												<label>Serial #</label>
												<input type="text" name="serial_number" id="serial_number" class="form-control" value="<?php echo $serial_number?>">
											</div>
											<div class="form-group col-md-6">
												<label>Model name </label>
												<input type="text" name="model_name" id="model_name" class="form-control" value="<?php echo $model_name?>">
											</div>
											<div class="form-group col-md-6">
												<label>Model #</label>
												<input type="text" name="model_number" id="model_number" class="form-control" value="<?php echo $model_number?>">
											</div>
											<div class="form-group col-md-6">
												<label>Product Color</label>
												<input type="text" name="color" id="color" class="form-control" value="<?php echo $color?>">
											</div>
											<div class="form-group col-md-6">
												<label>Manufature Date</label>
												<input type="text" name="manufature_date" id="manufature_date" class="form-control" value="<?php echo $manufature_date?>">
											</div>
											<div class="form-group col-md-6">
												<label>Product condition</label>
												<select class="form-control" name="product_condition" name="product_condition">
													<option value="<?php echo $product_condition?>" selected><?php echo $product_condition ?></option>
													<option value="Excellent">Excellent</option>
													<option value="Good">Good</option>
													<option value="Fair">Fair</option>
													<option value="Damaged">Damaged</option>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label>Product Description</label>
												<textarea class="form-control" rows="4" name="description" id="description"><?php echo $description ?></textarea>
											</div>
											
											<div class="form-group col-md-4 mb-3">
												<label for="form">Collateral Photo</label>
												<div class=" border p-3">
													<button class="btn btn-warning mb-3" type="button" id="selectImage">Select Image <i class="bi bi-file-person"></i></button><br>
													<input type="file" name="photo" id="photo" class="form-control"  style="display: none;" onchange="preview_image(event)" value="">
													<img src="collaterals/files/<?php echo $photo?>" id="output_image" class="shadow-sm img-fluid img-responsive" alt="<?php echo $photo?>" width="140">
													<input type="hidden" name="col_photo" id="col_photo" value="<?php echo $photo?>">
												</div>
												<em>Add a clear photo of the product</em>
											</div>
											<div class="form-group col-md-4 mb-3">
												<label for="form">Collateral Files</label>
												<div class="border p-3">
													<button class="btn btn-warning" type="button" id="selectFiles">Select Files <i class="bi bi-files"></i></button>
													<input type="file" name="files[]" id="files" class="form-control" style="display: none;" multiple onchange="javascript:updateList()">
													<input type="hidden" name="col_filesID" name="col_filesID" value="<?php echo $files?>">

													<div id="fileList">
														<?php 
															$queryF = $connect->prepare("SELECT * FROM collaterals_files WHERE col_id = ?");
															$queryF->execute(array($_GET['product_id']));
															if ($queryF->rowCount() > 0) {
																foreach ($queryF->fetchAll() as $rows) {
																	echo "<p><a href='collaterals/files/".$rows['filename']."'target='_blank' >".$rows['filename']."</a> <i class='bi bi-trash text-danger removeFile' id='".$rows['id']."' data-fname='".$rows['filename']."' style='cursor:pointer;'></i><p>";
																	?>
																	<!-- <input type="hidden" name="col_files[]" id="col_files" value="<?php echo $rows['filename']?>">
																	<input type="hidden" name="col_filesID[]" id="col_filesID" value="<?php echo $rows['id']?>"> -->
															<?php
																}
															}else{

															}
														?>
													</div>
												</div>
												<em>Add reciepts, and any documents to support ownership</em>
											</div>
											<div class="col-md-12 bg-secondary p-2 mt-5 mb-5 shadow-md">
												<!-- <div class="border-bottom border-primary mb-3 mt-3"></div> -->
												<h4 >For Vehicles only </h4>
											</div>
											<div class="form-group col-md-4">
												<label>Registration Number</label>
												<input type="text" name="vehicle_reg_number" id="vehicle_reg_number" class="form-control" placeholder="Reg Number" value="<?php echo $vehicle_reg_number?>">
											</div>
											<div class="form-group col-md-4">
												<label>Millage</label>
												<input type="text" name="millage" id="millage" class="form-control" placeholder="Millage" value="<?php echo $millage?>">
											</div>
											<div class="form-group col-md-4">
												<label>Engine No.</label>
												<input type="text" name="vehicle_engine_num" id="vehicle_engine_num" class="form-control" placeholder="Engine No." value="<?php echo $vehicle_engine_num?>">
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

				format: 'yyyy-mm-dd'
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
					if (xhr.responseText === 'updated') {
						successNow('collateral for <?php echo getBorrowerFullNamesByCardId($connect, $_GET['borrower_id'])?> Updated Successfully');
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

	    $(document).on("click", ".removeFile", function(){
	    	var fileId = $(this).attr('id');
	    	var fname = $(this).data('fname');
	    	if (!confirm("You wish to delete the file?")) {
	    		return false;
	    	}else{
		    	$.ajax({
		    		url:"collaterals/deleteFile",
		    		method:"post",
		    		data:{fileId:fileId, fname:fname},
		    		success:function(data){
		    			successNow(data);
		    			setTimeout(function(){
		    				location.reload();
		    			}, 2000)
		    		}
		    	})
		    }
	    })
		
	</script>
</body>
</html>