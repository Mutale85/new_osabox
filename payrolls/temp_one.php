<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Template One Payroll</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<style>
		@media print {

		  html, body {
		    height:100%; 
		    margin: 0 !important; 
		    padding: 0 !important;
		    overflow: hidden;
		  }
		}
	</style>
</head>
<body style="background-color: #ddd;">
	<div class="wrapper">
		<div class="content-wrappers">
			<section class="content">
      			
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));
      			?>
      			
			<div class="container mt-5 mb-5">
			    <div class="row">
			        <div class="col-md-12">
			            <div class="text-center lh-1 mb-2">
			                <h6 class="fw-bold">Payslip</h6> <span class="fw-normal">Payment slip for the month of June 2021</span>
			            </div>
			            <div class="d-flex justify-content-end"> <span>Working Branch:ROHINI</span> </div>
			            <div class="row">
			                <div class="col-md-10">
			                    <div class="row">
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">39124</small> </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">Ashok</small> </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">PF No.</span> <small class="ms-3">101523065714</small> </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">NOD</span> <small class="ms-3">28</small> </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">ESI No.</span> <small class="ms-3"></small> </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">SBI</small> </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">Designation</span> <small class="ms-3">Marketing Staff (MK)</small> </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******0701</small> </div>
			                        </div>
			                    </div>
			                </div>
			                <table class="mt-4 table table-bordered" style="width: 100%;">
			                    <thead>
			                        <tr>
			                            <th scope="col">Earnings</th>
			                            <th scope="col">Amount</th>
			                            <th scope="col">Deductions</th>
			                            <th scope="col">Amount</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        <tr>
			                            <td scope="row">Basic</td>
			                            <td>16250.00</td>
			                            <td>PF</td>
			                            <td>1800.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">DA</td>
			                            <td>550.00</td>
			                            <td>ESI</td>
			                            <td>142.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">HRA</td>
			                            <td>1650.00 </td>
			                            <td>TDS</td>
			                            <td>0.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">WA</td>
			                            <td>120.00 </td>
			                            <td>LOP</td>
			                            <td>0.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">CA</td>
			                            <td>0.00 </td>
			                            <td>PT</td>
			                            <td>0.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">CCA</td>
			                            <td>0.00 </td>
			                            <td>SPL. Deduction</td>
			                            <td>500.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">MA</td>
			                            <td>3000.00</td>
			                            <td>EWF</td>
			                            <td>0.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">Sales Incentive</td>
			                            <td>0.00</td>
			                            <td>CD</td>
			                            <td>0.00</td>
			                        </tr>
			                        <tr>
			                            <td scope="row">Leave Encashment</td>
			                            <td>0.00</td>
			                            <td colspan="2"></td>
			                        </tr>
			                        <tr>
			                            <td scope="row">Holiday Wages</td>
			                            <td>500.00</td>
			                            <td colspan="2"></td>
			                        </tr>
			                        <tr>
			                            <td scope="row">Special Allowance</td>
			                            <td>100.00</td>
			                            <td colspan="2"></td>
			                        </tr>
			                        <tr>
			                            <td scope="row">Bonus</td>
			                            <td>1400.00</td>
			                            <td colspan="2"></td>
			                        </tr>
			                        <tr>
			                            <td scope="row">Individual Incentive</td>
			                            <td>2400.00</td>
			                            <td colspan="2"></td>
			                        </tr>
			                        <tr class="border-top">
			                            <td scope="row">Total Earning</td>
			                            <td>25970.00</td>
			                            <td>Total Deductions</td>
			                            <td>2442.00</td>
			                        </tr>
			                    </tbody>
			                </table>
			            </div>
			            <div class="row">
			                <div class="col-md-4"> <br> <span class="fw-bold">Net Pay : 24528.00</span> </div>
			                <div class="border col-md-8">
			                    <div class="d-flex flex-column"> <span>In Words</span> <span>Twenty Five thousand nine hundred seventy only</span> </div>
			                </div>
			            </div>
			            <div class="d-flex justify-content-end">
			                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For Kalyan Jewellers</span> <span class="mt-4">Authorised Signatory</span> </div>
			                
			            </div>
			        </div>
			    </div>
			</div>
      		</section>
      	</div>
    </div>
    <script>
      window.addEventListener("load", window.print());
  </script>
</body>
</html>