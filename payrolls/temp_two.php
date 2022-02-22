<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Template Two Payroll</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
	
	<script type="text/javascript">
		function generatePDF() {
			 var doc = new jsPDF({
			 	orientation: "landscape",
			 });  //create jsPDF object
			  doc.fromHTML(document.getElementById("element-to-print"), 15, 15, {
			     //set width
			  },
			  function(a) {
			    doc.save("HTML2PDF.pdf"); // save file name as HTML2PDF.pdf
			 });
		}
	</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<div class="content-wrapper">
			<section class="content">
      			
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));
      			?>
      			<div class="container-fluid">
  					<div class="container mt-5 mb-5">
					    <div class="row">
					        <div class="col-md-12"  id="element-to-print">
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
					                    <thead class="bg-dark text-white" style="background-color: black; color: white;">
					                        <tr>
					                            <th scope="col">Earnings</th>
					                            <th scope="col">Amount</th>
					                            <th scope="col">Deductions</th>
					                            <th scope="col">Amount</th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                        <tr>
					                            <th scope="row">Basic</th>
					                            <td>16250.00</td>
					                            <td>PF</td>
					                            <td>1800.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">DA</th>
					                            <td>550.00</td>
					                            <td>ESI</td>
					                            <td>142.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">HRA</th>
					                            <td>1650.00 </td>
					                            <td>TDS</td>
					                            <td>0.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">WA</th>
					                            <td>120.00 </td>
					                            <td>LOP</td>
					                            <td>0.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">CA</th>
					                            <td>0.00 </td>
					                            <td>PT</td>
					                            <td>0.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">CCA</th>
					                            <td>0.00 </td>
					                            <td>SPL. Deduction</td>
					                            <td>500.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">MA</th>
					                            <td>3000.00</td>
					                            <td>EWF</td>
					                            <td>0.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">Sales Incentive</th>
					                            <td>0.00</td>
					                            <td>CD</td>
					                            <td>0.00</td>
					                        </tr>
					                        <tr>
					                            <th scope="row">Leave Encashment</th>
					                            <td>0.00</td>
					                            <td colspan="2"></td>
					                        </tr>
					                        <tr>
					                            <th scope="row">Holiday Wages</th>
					                            <td>500.00</td>
					                            <td colspan="2"></td>
					                        </tr>
					                        <tr>
					                            <th scope="row">Special Allowance</th>
					                            <td>100.00</td>
					                            <td colspan="2"></td>
					                        </tr>
					                        <tr>
					                            <th scope="row">Bonus</th>
					                            <td>1400.00</td>
					                            <td colspan="2"></td>
					                        </tr>
					                        <tr>
					                            <th scope="row">Individual Incentive</th>
					                            <td>2400.00</td>
					                            <td colspan="2"></td>
					                        </tr>
					                        <tr class="border-top">
					                            <th scope="row">Total Earning</th>
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
			      				
			    </div>
      			<!-- END OF ALLOWANCES SETUP -->
      		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <script>
      window.addEventListener("load", window.print());
  </script>
</body>
</html>