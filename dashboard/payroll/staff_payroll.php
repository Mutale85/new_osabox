<?php 
    require ("../../includes/db.php");
    require ("../../includes/tip.php"); 
     
  	if (isset($_GET['payroll_id']) AND isset($_GET['parent_id'])) {
    	$payroll_id = preg_replace("#[^0-9]#", "", $_GET['payroll_id']);
    	$parent_id = preg_replace("#[^0-9]#", "", $_GET['parent_id']);
    	$staff_id = preg_replace("#[^0-9]#", "", $_GET['staff_id']);
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> - Pay Roll</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">


	<style>
		.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
		    border-color: #ff80ac;
		    height: 40px !important;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline {
		    width: 100%;
		    margin-left: .375rem;
		    height: 40px;
		}
		.select2-container--default .select2-selection--single {
		    background-color: #f8f9fa;
		    border: 1px solid #aaa;
		    border-radius: 4px;
		    height: 40px;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__rendered {
		    box-sizing: border-box;
		    list-style: none;
		    margin: 0;
		    padding: .4em;
		    width: 100%;
		}
    /*PAYSLIP DEMO*/
      /*Payslip table*/
    .tableDiv {
      margin: 2em auto;
      /*width: 70%;*/
    }
    .tableDiv h2 {
      margin-bottom: 1em;
    }
    .intro_table {
      width: 100%;
      border: 1px solid #ddd;
      padding: 1em;
    }
    .anotherTable {
      width: 100%;
      border: 1px solid #ddd;
      padding: 1em;
      border-top: none;
    }
    td, th {
      text-align: left;
      padding: 8px;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      margin-left:-5px;
      margin-right:-5px;
    }

    .column {
      float: left;
      width: 50%;
      padding: 5px;
    }

    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    th, td {
      text-align: left;
      padding: 16px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    /**/
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							
  						  </div>
      				</div>
      			</div>
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-5">
      						<div class="card card-danger">
                      <div class="card-header">
                          <h3 class="card-title"><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> - Payroll Chart</h3>

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
                          <canvas id="donutChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                      </div>
                  </div>
      					</div>
      					<!-- end of Chart -->
      					<div class="col-md-7">
      						<div class="card card-info">
      							<div class="card-header">
      								<h3 class="card-title"><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> - Payroll</h3>
      							</div>
      							<div class="card-body">
      								<div class="table table-responsive">
      									<table class="cell-table table-sm" id="payrollTable" style="width: 100%">
      										<thead>
      											<tr>
      												<th>Pay Day</th>
      												<th>Gross Pay</th>
      												<th>Deductions</th>
      												<th>Net Pay</th>
      												<th>Payslip</th>
      												<th>Edit</th>
      												<th>Remove</th>
      											</tr>
      										</thead>
      										<tbody>
      											<?php
      												$data = "";
      												$query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND parent_id = ? ");
      												$query->execute(array($payroll_id, $parent_id));
      												foreach ($query as $row) {
      													extract($row);
      													$data = $grosspay.','.$total_deductions.','.$net_pay;
      											?>
      											<tr>
      												<td><?php echo $pay_date ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($grosspay, 2) ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($total_deductions, 2) ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($net_pay, 2) ?></td>
      												<td><a href="payroll/staffpayrollprint?payroll_id=<?php echo $id?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>" target="_blank"><small>Print Payslip <i class="bi bi-printer"></i></small> </a></td>
      												<td>
      													<a href="payroll/edit_payroll?payroll_id=<?php echo $id;?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>"><small><i class="bi bi-pencil-square"></i></small> </a>
      												</td>
      												<td>
      													<a href="payroll/staff_payroll?payroll_id=<?php echo $id?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>" data-payroll_id="<?php echo $id?>" class="deletePayroll"><small><i class="bi bi-trash text-danger"></i></small> </a>
      												</td>
      											</tr>
      											<?php
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
            <!-- Payroll Sample -->
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4 class="card-title">Latest PaySlip</h4>
                    </div>
                    <div class="card-body">


                <?php
                  // require ("../../includes/db.php");

                  function getAllowanceName($connect, $allowance_id, $parent_id) {
                    $output = '';
                    $query = $connect->prepare("SELECT * FROM `salary_allowances` WHERE id = ? AND parent_id = ? ");
                    $query->execute(array($allowance_id, $parent_id));
                    $row = $query->fetch();
                    if($row){
                      $output = $row['name'];
                    }
                    return $output;
                  }

                  function getDeductionName($connect, $deduction_id, $parent_id) {
                    $output = '';
                    $query = $connect->prepare("SELECT * FROM `salary_deductions` WHERE id = ? AND parent_id = ? ");
                    $query->execute(array($deduction_id, $parent_id));
                    $row = $query->fetch();
                    if($row){
                      $output = $row['name'];
                    }
                    return $output;
                  }

                  if (isset($_GET['payroll_id']) AND isset($_GET['parent_id'])) {
                      $payroll_id = preg_replace("#[^0-9]#", "", $_GET['payroll_id']);
                      $parent_id = preg_replace("#[^0-9]#", "", $_GET['parent_id']);
                      $staff_id = preg_replace("#[^0-9]#", "", $_GET['staff_id']);

                      $data = "";
                      $query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND parent_id = ? ");
                      $query->execute(array($payroll_id, $parent_id));
                      foreach ($query as $row) {
                        extract($row);
                        $data = $grosspay.','.$total_deductions.','.$net_pay;
                        $the_currency;
                        $salary_amount;
                        $payment_method;
                        $bank_name;
                        $account_number;
                        $paid_amount;
                      }
                    }

                    $query = $connect->prepare("SELECT * FROM organisations WHERE parent_id = ? ");
                    $query->execute(array($parent_id));
                    if($query->rowCount() > 0){
                      $row = $query->fetch();
                      if ($row) {
                        $src = '
                          <img src="members/adminphotos/'.$row['org_logo'].'" width="60" />
                        ';
                      }
                    }else{
                      $src = "https://weblister.co/images/icon_new.png";
                    }

                ?>
                <div class="tableDiv">
                  <table>
                    <tr>
                      
                      <th><h1><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></h1></th>
                      <th><?php echo getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id'])?></th>
                      <th><?php echo $src?></th>
                    </tr>
                  </table>
                  <table class="intro_table">
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><?php echo date("F", strtotime($pay_date))?> Payslip</th>
                    </tr>
                    <thead>
                      <tr>
                        <th> Names:</th>
                        <td>
                          <?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?>
                          <th>Pay Date</th>
                          <td><?php echo $pay_date ?></td>
                        </td>
                      </tr>
                      <tr>
                        <th>Man Number:</th>
                        <td>
                          No. 000<?php echo $staff_id ?>
                          <th>Branch Name</th>
                          <td><?php echo branchName($connect, $parent_id, $branch_id)?></td>
                        </td>
                      </tr>
                    </thead>
                  </table>
                  <div class="row">
                      <div class="column">
                        <table>
                            <thead>
                          <tr>
                            <th>Description</th>
                            <th>Amount <small>(<?php echo $the_currency?>)</small></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $output = '';
                            $sql = $connect->prepare("SELECT * FROM `payroll_allowances` WHERE payroll_id = ? AND employee_id = ? AND parent_id = ?");
                            $sql->execute(array($payroll_id, $staff_id, $parent_id));
                            $sum = 0;
                            $output = '<td>Basic Pay </td><td>'. $salary_amount.'</td>';
                            foreach ($sql as $rs) {
                              extract($rs);
                              $aname = getAllowanceName($connect, $allowance_id, $parent_id);
                              $output .=  
                              ' <tr>
                                  <td>'.$aname.'</td>
                                  <td>'.$allowance_amount.'</td>
                                </tr>
                              ';
                            }
                            echo $output;
                          ?>
                        </tbody>
                        <tfoot style="border-top: 1px solid mediumseagreen;">
                          <tr>
                            <th>Gross Pay</th>
                            <td><?php echo $grosspay ?></td>
                          </tr>
                        </tfoot>  
                        </table>
                      </div>
                      <div class="column">
                        <table>
                            <thead>
                          <tr>
                            <th>Deductions</th>
                            <th>Amount <small>(<?php echo $the_currency?>)</small></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = $connect->prepare("SELECT * FROM `payroll_deductions` WHERE payroll_id = ? AND employee_id = ? AND parent_id = ?");
                            $sql->execute(array($payroll_id, $staff_id, $parent_id));
                            foreach ($sql as $rs) {
                              extract($rs);
                              $dname = getDeductionName($connect, $deduction_id, $parent_id);
                            ?>
                              <tr>
                                <td><?php echo $dname?></td>
                                <td><?php echo $deduction_amount?></td>

                              </tr>

                          <?php
                            }

                          ?>
                        </tbody>
                        <tfoot style="border-top: 1px solid red;">
                          <tr>
                            <th>Deductions</th>
                            <td><?php echo $total_deductions ?></td>
                          </tr>
                          <tr>
                            <th>Net Pay</th>
                            <th><?php echo $net_pay ?></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <table>
                    <thead>
                      <tr>
                        <th>Payment Method</th>
                        <th>Bank Name</th>
                        <th>Account No</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody style="background-color: #f2f2f2;">
                      <tr>
                        <td><?php echo $payment_method ?></td>
                        <td><?php echo $bank_name ?></td>
                        <td><?php echo $account_number?></td>
                        <td><?php echo $paid_amount?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="payroll/staffpayrollprint?payroll_id=<?php echo $payroll_id?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $staff_id?>" class="btn btn-outline-primary mt-5" target="_blank"> Print Payslip <i class="bi bi-printer"></i></a>
                </div>
                </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Payroll Sample-->
      			
      		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>

    </div>
    <?php include("../footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>

		var donutChartCanvas = $('#donutChart').get(0).getContext('2d');

	    var donutData        = {
	        labels: [
	          'Total Gross',
	          'Total Deductions',
	          'Total Net Pay',
	        ],
	        datasets: [{
	            data: [<?php echo $data?>],
	            backgroundColor : ['#00a65a','#f56954', '#6499cd'],
	        }]
	    }
	    var donutOptions     = {
	        maintainAspectRatio : false,
	        responsive : true,
	    }
	    //Create pie or douhnut chart
	    // You can switch between pie and douhnut using the method below.
	    new Chart(donutChartCanvas, {
	        type: 'pie',
	        data: donutData,
	        options: donutOptions
	    })
		// ================================= DISPLAYS ======================================
		$("#payrollTable").DataTable();
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

      $(document).on("click", ".deletePayroll", function(e){
        e.preventDefault();
        var payroll_id = $(this).data("payroll_id");
        // errorNow(payroll_id);
        if (confirm("confirm you are deleting the payroll?")) {
            $.ajax({
              url:"payroll/editPayroll",
              method:"post",
              data:{payroll_id:payroll_id},
              success:function(data){
                if (data === 'done') {
                  successNow("Payroll Removed, redirecting you");
                  setTimeout(function(){
                    window.location = 'payroll/check-payroll';
                  }, 1500);
                }else{
                  errorNow(data);
                }
              }
            })
        }else{
          return false;
        }
      })
	</script>

</body>
</html>