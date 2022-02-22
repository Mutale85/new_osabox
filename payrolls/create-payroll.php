<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Payroll</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
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
                        <?php
                        

                          	$query = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
                          	$query->execute(array($_SESSION['parent_id']));
                          	foreach ($query as $row) {
                                extract($row);
                        ?>
                        <div class="col-md-4">
                              <div class="card">
                                    <div class="card-header">
                                          <div class="card-title">
                                                <img src="<?php echo getStaffMemberImage($connect, $id, $parent_id) ?>" class="img-fluid shadow" alt="<?php echo getStaffMemberImage($connect, $id, $parent_id) ?>" style="width: 30px;height: 30px; border-radius: 50%;">
                                          </div>

                                          <h4 class="card-title ml-3">
                                                <?php echo getStaffMemberNames($connect, $id, $parent_id)?>
                                          </h4>
                                          <div class="card-tools">
                                                <!-- <a href="payroll-edit?payroll_id=<?php echo $id?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $id?>">Edit</a>
                                                <a href="">Delete</a> -->
                                          </div>    
                                    </div>
                                    <div class="card-body">
                                        
                                          
                                        <a href="new-payroll?parent_id=<?php echo $parent_id?>&staff-id=<?php echo $id?>" target="_blank" class="btn btn-primary">Create PAY <i class="bi bi-wallet"></i> </a>
                                        
                                    </div>
                              </div>
                        </div>
                        <?php
                              }
                        ?>
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
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>

		// function basicPay(amount){
		// 	// successNow(amount);
		// 	var salaryForm = document.getElementById('salaryForm');
		// 	var data = new FormData(salaryForm);
		// 	var url = 'calculations';
		// 	$.ajax({
		// 		url:url+'?<?php echo time()?>',
		// 		method:"post",
		// 		data:data,
		// 		cache : false,
		// 		processData: false,
		// 		contentType: false,
		// 		beforeSend:function(){
		// 			$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
		// 		},
		// 		success:function(data){
		// 			$("#calculations").html(data);
		// 			$("#Calculate").html("Calculate");
		// 			// document.getElementById('grosspay').value = amount;
		// 		}
		// 	})
		// }

		function calC(amount){
			
			var salaryForm = document.getElementById('salaryForm');
			var data = new FormData(salaryForm);
			var url = 'calculations';
			$.ajax({
				url:url+'?<?php echo time()?>',
				method:"post",
				data:data,
				cache : false,
				processData: false,
				contentType: false,
				beforeSend:function(){
					$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
				},
				success:function(data){
					$("#calculations").html(data);
					$("#Calculate").html("Calculate");
				}
			})
		}

		function calCDeduction(amount){

			var salaryForm = document.getElementById('salaryForm');
			var data = new FormData(salaryForm);
			var url = 'calculations';
			$.ajax({
				url:url+'?<?php echo time()?>',
				method:"post",
				data:data,
				cache : false,
				processData: false,
				contentType: false,
				beforeSend:function(){
					$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
				},
				success:function(data){
					$("#calculations").html(data);
					$("#Calculate").html("Calculate");
				}
			})
		}

		function getStaffId(staff_id){
			if (staff_id === "") {
				document.getElementById('addsDeducs').style.display = "none";
			}else{
				document.getElementById('staff_id').value = staff_id;
				document.getElementById('addsDeducs').style.display = "block";
			}
		}

		$(function() {
		    $('.select').multipleSelect({
		      	filter: true,
		      	customFilter: function (label, text, originalLabel, originalText) {
		        if ($('input').prop('checked')) {
		          	return originalLabel.indexOf(originalText) === 0
		        }
		        	return label.indexOf(text) === 0
		      	}
		    })
		})

		$(function(){
			$("#pay_date").datepicker({
				format:'yyyy-mm-dd',
				startDate: '-1d',
				todayHighlight:true,
				zIndexOffset: 99999,
				autoclose:true
			});


			$("#Calculate").click(function(e){
				e.preventDefault();
				// alert("Hello");
				var salaryForm = document.getElementById('salaryForm');
				var data = new FormData(salaryForm);
				var url = 'calculations';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
					},
					success:function(data){
						$("#calculations").html(data);
						$("#Calculate").html("Calculate");
					}
				})
			})


			// =================== SUBMITE THE data =================================

			$("#salaryForm").submit(function(e){
				e.preventDefault();
				var salaryForm = document.getElementById('salaryForm');
				var pay_date = document.getElementById('pay_date');
				if (pay_date.value === "") {
					alert("Pay Date is requird");
					pay_date.focus();
					return false;
				}
				var data = new FormData(salaryForm);
				var url = 'submitPayroll';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#submitPay").html("<i class='fa fa-spinner fa-spin'></i>");
						$("#calculations").attr("disabled", "disabled");
					},
					success:function(data){

						if (data === 'done') {
							successNow("Payroll Submitted");
							setTimeout(function(){
								window.location = 'check-payroll?allowed_user_id=<?php echo $_SESSION['parent_id']?>';
							}, 2000);
						}else{
							errorNow(data);
						}
					}
				})
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

	    $(document).on("change", "#pay_scale", function(){
	    	var salary_amount = document.getElementById('salary_amount');
	    	var grosspay = document.getElementById('grosspay');
	    	var pay = $(this).find(':selected').data('amount');
	    	salary_amount.value = pay;
	    	// document.getElementById('grosspay').value = pay;
	    	// grosspay.value = pay;

	    	var salaryForm = document.getElementById('salaryForm');
			var data = new FormData(salaryForm);
			var url = 'calculations';
			$.ajax({
				url:url+'?<?php echo time()?>',
				method:"post",
				data:data,
				cache : false,
				processData: false,
				contentType: false,
				beforeSend:function(){
					$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
				},
				success:function(data){
					$("#calculations").html(data);
					$("#Calculate").html("Calculate");
					document.getElementById('grosspay').value = pay;
				}
			})
	    })

	    // add and remove salary advance
	    $(function(){
	    	$(".addAllowance").click(function(e){
	    		e.preventDefault();
	    		$("#modal-warning").modal("show");
	    		document.getElementById('salary_addon').value = 'Allowance';
	    		document.getElementById('modalname').innerHTML = 'Allowance';
	    		document.getElementById('labelname').innerHTML = 'Allowance';

	    	})

	    	$(".addDeduction").click(function(e){
	    		e.preventDefault();
	    		$("#modal-warning").modal("show");
	    		document.getElementById('salary_addon').value = 'Deduction';
	    		document.getElementById('modalname').innerHTML = 'Deduction';
	    		document.getElementById('labelname').innerHTML = 'Deduction';
	    	})

	    	$("#allowancesDeducForm").submit(function(e){
				e.preventDefault();
				// alert("Hello");
				var name = document.getElementById('name');
				var allowancesDeducForm = document.getElementById('allowancesDeducForm');
				var salary_addon = document.getElementById('salary_addon').value;
				var data = new FormData(allowancesDeducForm);
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
						successNow(data);
						$("#allBtn").html('Save Changes');
						$("#allowancesDeducForm")[0].reset();
						getAllowanceType();
						getDeductionType();

					}
				})
			});

			$(document).on("click", ".remove_allowance", function(e){
				e.preventDefault();
				var remove_allowance_id = $(this).attr("href");
				if(confirm("Confirm you wish to remove the allowance")){
					$.ajax({
						url:"editPayroll",
						method:"post",
						data:{remove_allowance_id:remove_allowance_id},
						success:function(data){
							successNow(data);
							getAllowanceType();
						}
					})
				}else{
					return false;
				}
			})
			// REMOVE DEDCUTION
			$(document).on("click", ".remove_deduction", function(e){
				e.preventDefault();
				var remove_deduction_id = $(this).attr("href");
				if(confirm("Confirm you wish to remove the allowance")){
					$.ajax({
						url:"editPayroll",
						method:"post",
						data:{remove_deduction_id:remove_deduction_id},
						success:function(data){
							successNow(data);
							getDeductionType();
						}
					})
				}else{
					return false;
				}
			})
			
	    })

	    function getAllowanceType(){
	    	var getAllowanceType = 'getAllowanceType';
	    	$.ajax({
				url:"getAllowanceType",
				method:"post",
				data:{getAllowanceType:getAllowanceType},
				success:function(data){
					$("#getAllowanceType").html(data);
				}
			})
	    }
	    getAllowanceType();

	    function getDeductionType(){
	    	var getDeductionType = 'getDeductionType';
	    	$.ajax({
				url:"getDeductionType",
				method:"post",
				data:{getDeductionType:getDeductionType},
				success:function(data){
					$(".getDeductionType").html(data);
				}
			})
	    }
	    getDeductionType();
 
	</script>

</body>
</html>