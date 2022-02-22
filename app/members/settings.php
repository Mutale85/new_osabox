<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php"); 
	
	$option = $countries = '';
	$query = $connect->prepare("SELECT * FROM currencies");
	$query->execute();
	foreach ($query->fetchAll() as $row) {
		$option .= '<option value="'.$row['code'].'">'.$row['code'].'</option>';
		$countries .= '<option value="'.$row['id'].'">'.$row['country'].'</option>';
	}
	$branch_options = "";
	$sql = $connect->prepare("SELECT * FROM branches WHERE member_id = ?");
	$sql->execute(array($_SESSION['parent_id']));
	foreach ($sql->fetchAll() as $row) {
		$branch_options .= '<option value="'.$row['id'].'">'.$row['branch_name'].'</option>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Settings</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
</head>
<?php
	
?>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h1 class="h3">Settings </h1>
  							<?php if($_SESSION['user_role'] == 'Admin'):?>
  								
  							<?php endif;?>
  						</div>
      				</div>
      			</div>
      			
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-warning mb-5">
      							<div class="card-header">
      								<h4 class="card-title">All Branches</h4>
      								<div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
      							</div>
      							<div class="card-body box-profile">
      								<div class="table table-responsive mb-5 mt-5">
										<table id="branchesTable" class="cell-table" style="width:100%">
									        <thead>
									            <tr>
									            	<th>UserEmail</th>
									                <th>Password</th>
									                <th>Landline</th>
									                <th>Mobile</th>
									            </tr>
									        </thead>
									        <tbody class="text-dark">
									        	<?php
									        		$query = $connect->prepare("SELECT * FROM branches WHERE member_id = ? ");
													$query->execute(array($_SESSION['parent_id']));
													if ($query->rowCount() > 0) {
														foreach ($query->fetchAll() as $row) {?>
															<tr>
																<td><?php echo $row['branch_name']?></td>
																<td><?php echo $row['address']?>, <?php echo $row['city']?>, <?php echo getCountryName($connect, $row['country'])?></td>
																<td><?php echo $row['phone_landline']?></td>
																<td><?php echo $row['phone_mobile']?></td>
															</tr>
													<?php		
														}
														
													}else{
														echo "";
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
      			<!-- Loan Schedule -->
      			<div class="container-fluid">
      				<?php
      					$today = date("Y-m-d");
						$parent_id = $_SESSION['parent_id'];
						$query = $connect->prepare("SELECT * FROM loan_schedules WHERE parent_id = ? AND date_due = ? ");
						$query->execute(array($parent_id, $today));
      				?>
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-warning mb-5">
      							<div class="card-header">
      								<h4 class="card-title">Today's Due Loans</h4>
	      							<div class="card-tools">
					                  	<button type="button" class="btn btn-tool" data-card-widget="collapse">
					                    	<i class="fas fa-minus"></i>
					                  	</button>
					                  	<button type="button" class="btn btn-tool" data-card-widget="remove">
					                    	<i class="fas fa-times"></i>
					                  	</button>
					                </div>
				                </div>
      							<div class="card-body box-profile">
      								<div class="table table-responsive">
      									<table id="loanTypes" class="cell-table" style="width:100%">
									        <thead>
									            <tr>
									            	<th>#</th>
									                <th>Loan ID</th>
									                
									                <th>Description</th>
									            </tr>
									        </thead>
									        <tbody class="text-dark">
									        	<?php
									        		
													$numRows = $query->rowCount();
													$i = 1;
													if ($numRows > 0 ) {
														$loanData = array();
														$i = 1;
														foreach ($query->fetchAll() as $row) {?>
															<tr>
																<td><?php echo $i++?></td>
																<td><b><?php echo $row['loan_id']?></b></td>
																<td>
																	<?php echo ucfirst($row['date_due'])?>
																</td>
															</tr>
													<?php
														}
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
      			<!-- End of loan Schedule -->
      			<!-- Loans -->
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-primary">
      							<div class="card-header">
      								<h4 class="card-title">Loans</h4>
	      							<div class="card-tools">
					                  	<button type="button" class="btn btn-tool" data-card-widget="collapse">
					                    	<i class="fas fa-minus"></i>
					                  	</button>
					                  	<button type="button" class="btn btn-tool" data-card-widget="remove">
					                    	<i class="fas fa-times"></i>
					                  	</button>
					                </div>
				                </div>
      							<div class="card-body">
      								<div class="table table-reponsive">
      									<table id="loansTable" class="cell-table table-sm">
      										<thead>
      											<th>Loan#</th>
      											<th>Borrower</th>
      											<th>Principal</th>
      											<th>Interest</th>
      											<th>Due</th>
      											<th>Paid</th>
      											<th>Last Payment</th>
      											<th>Status</th>
      											<th>Apply Date</th>
      											<th>View</th>
      										</thead>
      										<tbody class="text-dark">
			      								<?php
			      									// 
			      									function getPaidAmount($connect, $this_loan_number, $borrower_id){
			      										$output = '';
			      										$sql = $connect->prepare("SELECT *, SUM(amount) AS total FROM `loan_payments` WHERE loan_number = ? AND borrower_id = ? ");
				                     					$sql->execute(array($this_loan_number, $borrower_id));
				                     					if ($sql->rowCount() > 0) {
				                     						foreach ($sql->fetchAll() as $rows) {
				                     							
				                     							if ($rows['total'] == '') {
				                     								$output .= 0.00;
				                     							}else{
				                     								$output .= $rows['total']; 
				                     							}
				                     						}
				                     					}else{
				                     						$output .= 0.00;
				                     					}
				                     					return $output;
			      									}

			      									function getlastPaidDate($connect, $loan_number, $borrower_id){
			      										$output = '';
			      										$sql = $connect->prepare("SELECT *  FROM `loan_payments` WHERE loan_number = ? AND borrower_id = ? ");
				                     					$sql->execute(array($loan_number, $borrower_id));
				                     					if ($sql->rowCount() > 0) {
				                     						foreach ($sql->fetchAll() as $rows) {
				                     							$output .= $rows['paid_date']; 
				                     						}
				                     					}else{
				                     						$output .= 'N/A';
				                     					}
				                     					return $output;
			      									}

			      									function getGroupLeaderID($connect, $parent_id, $group_id) {
			      										$output = '';
			      										$sql = $connect->prepare("SELECT * FROM `group_borrowers` WHERE parent_id = ? AND group_id = ? ");
			      										$sql->execute(array($parent_id, $group_id));
			      										$row = $sql->fetch();
			      										if ($row) {
			      											$output = $row['group_leader_id'];
			      										}
			      										return $output;
			      									}
			      									$query = $connect->prepare("SELECT * FROM loans WHERE branch_id = ? AND parent_id = ? ");
													$query->execute(array($BRANCHID,  $_SESSION['parent_id']));

													if ($query->rowCount() > 0) {

														foreach ($query->fetchAll() as $row) {
															extract($row);

															$sql = $connect->prepare("SELECT * FROM `loanStatus` WHERE loan_id = ? AND branch_id = ? AND parent_id = ? ");
															$sql->execute(array($id, $branch_id, $parent_id));
															if ($sql->rowCount() > 0) {
																$rows = $sql->fetch();
																if ($rows) {
																	extract($rows);
																	$action_date = $action_date;
																}
															}else{
																$action_date = '<span class="text-warning">Pending</span>';
															}

														?>
														<tr>
															<td><?php echo $loan_number ?></td>
															<td>
																<?php

																	if(!getBorrowerFullNamesByCardId($connect, $borrower_id)){
																		echo getBorrowerGroupNamesByCardId($connect, $loan_number) .' Group';
																	}else{
																		echo getBorrowerFullNamesByCardId($connect, $borrower_id);
																	}
																?>
															</td>

															<td><small><?php echo $currency ?></small> <?php echo number_format($principle_amount, 2)?></td>
															<td><?php echo $loan_interest ?>%</td>
															<td><small><?php echo $currency ?></small> <?php echo number_format($total_payable_amount, 2) ?></td>
															<td><small><?php echo $currency ?></small> <?php echo  getPaidAmount($connect, $loan_number, $borrower_id)?></td>
															<td><?php echo getlastPaidDate($connect, $loan_number, $borrower_id)?></td>
															<td><?php echo preg_replace("#[^a-zA-Z]#", " ", $loan_status)?></td>
															<td class="text-primary"><?php echo date("Y-m-d", strtotime($date_added)) ?></td>
															<?php

																if(!getBorrowerFullNamesByCardId($connect, $borrower_id)){?>
															<td>
																<a href="borrowers/view_group_borrowers?group_id=<?php echo $loan_number?>&parent_id=<?php echo $parent_id?>&group_leader_id=<?php echo getGroupLeaderID($connect, $parent_id, $borrower_id)?>" class="text-primary"><i class="bi bi-arrow-right-square"></i></a>
															</td>
															<?php		
																}else{?>
															<td>
																<a href="loans/view_loan_details?loan_number=<?php echo $loan_number?>&borrower_id=<?php echo $borrower_id?>" class="text-primary"><i class="bi bi-arrow-right-square"></i></a>
															</td>
															<?php		
																}
															?>
															
														</tr>

													<?php
														}
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
      			<!-- end of loans -->

      			<!-- Loan Charts -->

      			<?php
      				

                    $sql = $connect->prepare("SELECT * FROM `loans` WHERE parent_id = ? AND loan_status = 'Rejected' ");
                    $sql->execute(array( $_SESSION['parent_id']));
                    $Rejected = $sql->rowCount();
                    // echo $Rejected;

                    $sql = $connect->prepare("SELECT * FROM `loans` WHERE parent_id = ? AND loan_status = 'Released' ");
                    $sql->execute(array( $_SESSION['parent_id']));
                    $Released = $sql->rowCount();
                    // echo $Released;

                    $sql = $connect->prepare("SELECT * FROM `loans` WHERE parent_id = ? AND loan_status = 'For_Approval' ");
                    $sql->execute(array( $_SESSION['parent_id']));
                    $For_Approval = $sql->rowCount();
                    // echo $For_Approval;

                    $sql = $connect->prepare("SELECT * FROM `loans` WHERE parent_id = ? AND loan_status = 'Approved' ");
                    $sql->execute(array( $_SESSION['parent_id']));
                    $Approved = $sql->rowCount();
                    // echo $Approved;

                    $sql = $connect->prepare("SELECT * FROM `loans` WHERE parent_id = ? AND loan_status = 'Completed' ");
                    $sql->execute(array( $_SESSION['parent_id']));
                    $Completed = $sql->rowCount();
                    // echo $Completed;
                    $data = $Rejected.','.$Released.','.$For_Approval.','.$Completed;

                    $query_sql = $connect->prepare("SELECT * FROM `loans` WHERE MONTH(release_date) AND parent_id = ?  ");
                    $query_sql->execute(array( $_SESSION['parent_id']));
                    $i = 1;
                    $q = 1;
                    $month_from_date =  $collected_payments = $paid_out_loans = "";
                    $row = $query_sql->fetch();
                    extract($row);

                    foreach ($query_sql->fetchAll() as $row) {
                     	extract($row);
                     	$date_added;
                     	$month_from_date .= '\''.date("M-Y", strtotime($date_added)).'\', ';
                        $date_as_digit = date("n", strtotime($date_added));

                        #========================== COLLECTED PAYMENTS FROM CLIENTS ==========
                        $query = $connect->prepare("SELECT * FROM `loan_payments` WHERE MONTH(`paid_date`) = ? AND parent_id = ?  GROUP BY  ");
                        $query->execute(array($date_as_digit,  $_SESSION['parent_id']));
                        $numbers = $query->rowCount();
                        $collected_payments .= $numbers.', ';

                        // =================== PAYMENTS MADE TO CLIENTS =======
                        $sql = $connect->prepare("SELECT * FROM `loans` WHERE MONTH(release_date) = ? AND parent_id = ? AND loan_status = 'Released' GROUP BY  ");
                        $sql->execute(array($date_as_digit,  $_SESSION['parent_id']));
                        $paid_out_loans .= $sql->rowCount().', ';
                    } 

                    // $months = 12;
                    // $i = 1;
                    // $q = 1;
                    // $month_from_date =  $collected_payments = $paid_out_loans ="";
                    // for($x = 1; $x <= $months; $x++ ){
                    //     $month_from_date .= '\''.date("M", strtotime("+".$i++." month", strtotime("-1 month"))).'\', ';
                    //     $date_as_digit = date("n", strtotime("+".$q++ ."month", strtotime("-2 month")));

                    //     #========================== COLLECTED PAYMENTS FROM CLIENTS ==========
                    //     $query = $connect->prepare("SELECT * FROM `loan_payments` WHERE MONTH(`paid_date`) = ? AND parent_id = ?  ");
                    //     $query->execute(array($date_as_digit,  $_SESSION['parent_id']));
                    //     $numbers = $query->rowCount();
                    //     $collected_payments .= $numbers.', ';

                    //     // =================== PAYMENTS MADE TO CLIENTS =======
                    //     $sql = $connect->prepare("SELECT * FROM `loans` WHERE MONTH(release_date) = ? AND parent_id = ? AND loan_status = 'Released' ");
                    //     $sql->execute(array($date_as_digit,  $_SESSION['parent_id']));
                    //     $paid_out_loans .= $sql->rowCount().', ';


                    // }
                    echo $collected_payments_data = rtrim($collected_payments, ', ');
                    $paid_out_loans_data = rtrim( $paid_out_loans, ', ');
                    
                   
                    $thisMonth = '\''.date("M").'\'';
                    $fullMonths = $date_as_digit.', '.$month_from_date;
                    $fullMonths = rtrim($month_from_date, ', ');

                
                ?>
      			<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 mb-5 mt-5">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Loan Applications</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- <canvas id="donutChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas> -->
                                    <div class="row">
	                                    <div class="col-md-8">
	                    					<div class="chart-responsive">
	                      						<canvas id="donutChart" height="250"></canvas>
	                      					</div>
	                      				</div>
	                                    <div class="col-md-4">
											<ul class="chart-legend clearfix">
												<li><i class="bi bi-circle-fill text-danger"></i> Rejected </li>
												<li><i class="bi bi-circle-fill text-success"></i> Paid Out </li>
												<li><i class="bi bi-circle-fill text-warning"></i> Pending Approval </li>
												<li><i class="bi bi-circle-fill text-info"></i> Completed </li>
											</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5 mt-5">
                            <!-- BAR CHART -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Issued and Collection</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      			<!-- End of Loan Charts -->
      		</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<?php include("../footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#adminsTable').DataTable();
		    $("#branchesTable").DataTable();
		    $('#loanTypes').DataTable();
		    $("#loansTable").DataTable();
		    // select
		    $('.select2').select2();
		    //datepicker
		    $("#open_date").datepicker({

				format: 'yyyy-mm-dd'
			});

			$(".listView").click(function(e){
				e.preventDefault();
				$(".gridViewDiv").hide();
				$(".listViewDiv").show();
			})

			$(".gridView").click(function(e){
				e.preventDefault();
				$(".gridViewDiv").show();
				$(".listViewDiv").hide();
			})
		});

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
	    function manageBranches(){
			var xhr = new XMLHttpRequest();
			var url = 'members/fetchBranches';
			
			xhr.open("POST", url, true);
			var data = 'member_id=<?php echo $_SESSION['parent_id']?>';
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					document.getElementById('fetchBranches').innerHTML = xhr.responseText
				}
			}
			xhr.send(data);
		}
		// manageBranches();

		//=========================== DELETING ===========================
		$(document).on("click", ".deleteBranch", function(e){
			e.preventDefault();
			var delete_branch_id = $(this).data("id");
			if (confirm("This will delete everything associated with the branch")) {
				$.ajax({
					url:"members/edit",
					method:"post",
					data:{delete_branch_id:delete_branch_id},
					beforeSend:function(){

					},
					success:function(data){
						if (data === 'done') {
							successNow("Branch removed with all its members and loans");
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							errorNow(data);
						}
					}
				})
			}else{
				return false;
			}
			// this will delete everything about the branch.
		})

	</script>

	 <script>
         //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');

    var donutData        = {
        // labels: [
        //   'Rejected',
        //   'Paid Out',
        //   'Pending Approval',
        //   'Completed',
        // ],
        datasets: [{
            data: [<?php echo $data?>],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#3c8dbc'],
        }]
    }
    var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

// BAR CHART
    
    var areaChartData = {
      labels  : [<?php echo $fullMonths?>],
      datasets: [
        {
          label               : 'Payments Collected',
          backgroundColor     : 'rgba(6, 186, 87, 1)',
          borderColor         : 'rgba(6, 186, 87, 1)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $collected_payments?>] // data will come from loan_payments,
        },
        {
          label               : 'Loans Issued Out',
          backgroundColor     : 'rgba(250, 0, 0, 1)',
          borderColor         : 'rgba(250, 0, 0, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(6, 186, 87, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $paid_out_loans_data?>] // data will come  with status released
        },
      ]
    }

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    </script>
</body>
</html>