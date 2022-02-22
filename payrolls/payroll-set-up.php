<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Basic Pay Settings</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h4> <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> BRANCH </h4>
  							
  						</div>
      				</div>
      			</div>

      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-6">
      						<div class="card card-warning">
      							<div class="card-header">
      								<h3 class="card-title">BASIC PAY SCALE SET UP</h3>
      							</div>
      							<form method="post" id="basicPaySetUpForm" enctype="multipart/form-data">
  									
  									<div class="card-body">
										<div class="form-group">
											<label>Basic Pay Scale Name</label>
											<div class="input-group">
												<span class="input-group-text"><i class="bi bi-wallet"></i></span>
												<input type="text" name="salary_scale_name" id="salary_scale_name" class="form-control" placeholder="e.g Grade A" required>
											</div>
										</div>
										<div class="form-group">
											<label for="">Amount</label>
											<div class="input-group">
												<span class="input-group-text" id=""><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
												<input type="number" name="amount" id="amount" class="form-control" step="any" required placeholder="">
												<input type="hidden" name="currency" id="currency" value="<?php echo getCurrency($connect, $_SESSION['parent_id'])?>">
											</div>
										</div>
										<em>Set basic pay scale according to the Level of the organization. Example can be. Grade A, Amount 6700.00</em>
										<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
										<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
										<input type="hidden" name="salary_id" id="salary_id">
									</div>
									<div class="card-footer justify-content-between">
										<button class="btn btn-secondary w-100 " type="submit" id="allBtn">Submit</button>
									</div>
  								</form>
      						</div>
      					</div>
      					<div class="col-md-6">
      						<div class="card card-info">
      							<div class="card-header">
      								<h3 class="card-title">BASIC PAY SCALE</h3>
      							</div>
      							<div class="card-body">
      								<div class="table table-responsive">
      									<table class="cell-table table table-sm" id="basicPayTable" style="width: 100%">
      										<thead>
      											<tr>
      												<th>Salary Scale</th>
      												<th>Amount</th>
      												<th>Actions</th>
      											</tr>
      										</thead>
      										<tbody>
			      								<?php
			      									$sql = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ?");
			      									$sql->execute(array($_SESSION['parent_id']));
			      									if ($sql->rowCount() > 0) {
			      										foreach ($sql->fetchAll() as $row) {
			      											extract($row);
			      								?>
			      											<tr class="text-dark">
			      												<td><?php echo ucwords($salary_scale_name)?></td>
			      												<td><small><?php echo $currency?></small> <?php echo number_format($amount, 2)?> </td>
			      												<td>
			      													<a href="" data-id="<?php echo $p_id?>" class="editBasicPay text-info"><i class="bi bi-pencil-square"></i></a>
			      													<a href="" data-id="<?php echo $p_id?>" class="deleteBasicPay text-danger"><i class="bi bi-trash"></i></a>
			      												</td>
			      											</tr>
			      								<?php
			      										}
			      									}else{

			      									}
			      								?>
			      							</tbody>
			      						</table>
			      					</div>
      							</div>
      						</div>
      					</div>

      				</div>
      			</div>

      		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>


    </div>
    <?php include("footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	<script>
		//========== GET CURRENCY
		
		$(function(){
			$("#basicPayTable").DataTable();
			// x================== ADD SLASRY SCALE ================
			$("#basicPaySetUpForm").submit(function(e){
				e.preventDefault();
				// alert("Hello");
				var salary_scale_name = document.getElementById('salary_scale_name');
				var basicPaySetUpForm = document.getElementById('basicPaySetUpForm');
				var amount = document.getElementById('amount');
				var data = new FormData(basicPaySetUpForm);
				var url = 'submitSalaryType';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#allBtn").html("<i class='fa fa-spinner fa-spin'></i>");
					},
					success:function(data){
						if (data === 'done') {
							successNow(salary_scale_name.value +" of  "+ amount.value +' Added');
							setTimeout(function(){
								location.reload();
							}, 2000);
							$("#allBtn").html("Submit");
						}else if(data === 'update'){
							successNow(salary_scale_name.value +" of  "+ amount.value +' updated');
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							errorNow(data);
							$("#allBtn").html("Submit");
							return false;
						}
					}
				})
			})

			//================== editBasicPay================

			$(document).on("click",".editBasicPay", function(e){
				e.preventDefault();
				var salary_scale_id = $(this).data("id");
				// alert(id);
				$.ajax({
					url:"editPayroll",
					method:"post",
					data:{salary_scale_id:salary_scale_id},
					dataType:"JSON",
					success:function(data){
						$('#salary_id').val(data.p_id);
						$('#amount').val(data.amount);
						$('#salary_scale_name').val(data.salary_scale_name);
					}
				})
			})
			//================ DELETE PAY ===========
			
			$(document).on("click", ".deleteBasicPay", function(e){
				e.preventDefault();
				var deleteBasicPay_id = $(this).data("id");
				
				if(confirm("Deleted data cannot be restored, Confirm delete")){
					$.ajax({
						url:"editPayroll",
						method:"post",
						data:{deleteBasicPay_id:deleteBasicPay_id},
						success:function(data){
							successNow(data);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}
					})
				}else{
					return false;
				}
			})
		})
		// ================================= DISPLAYS ======================================
		function successNow(msg){
			toastr.success(msg);
	      	toastr.options.progressBar = true;
	      	toastr.options.positionClass = "toast-top-center";
	      	toastr.options.showDuration = 1000;
	    }

		function errorNow(msg){
			toastr.error(msg);
	      	toastr.options.progressBar = true;
	      	toastr.options.positionClass = "toast-top-center";
	      	toastr.options.showDuration = 1000;
	    }
	</script>

</body>
</html>