<?php 
	ob_start();
  	require ("../includes/db.php");
  	require ("../includes/tip.php"); 

// Include the main TCPDF library (search for installation path).
	require 'vendor/autoload.php';

	$name = ucwords(getOrganisationName($connect, $_SESSION['parent_id']));
	$address = getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id']);
	$img = getOrganisationLogoDetailsForPDF($connect, $_SESSION['parent_id']);
	$mpdf = new \Mpdf\Mpdf();
	$mpdf->SetHeader('October - Payslip|'.$name.'<br>'.$address.'|{PAGENO}');
	$mpdf->SetFooter('October - Payslip');

	$mpdf->defaultheaderfontsize=10;
	$mpdf->defaultheaderfontstyle='B';
	$mpdf->defaultheaderline=0;
	$mpdf->defaultfooterfontsize=10;
	$mpdf->defaultfooterfontstyle='BI';
	$mpdf->defaultfooterline=0;



// set some text to print
$txt = <<<EOD
	<style media="print">
		div.main_box {
			display: flex;
			color:red;
		}
		div.boxes1 {
			flex:2;
		}
		div.boxes2 {
			flex:1;
		}
		div.justify-content-between {
		  	-webkit-justify-content: space-between !important;
		  	-ms-flex-pack: justify !important;
		  	justify-content: space-between !important;
		}
		table#earningdetails, table.deductiondetails {
			width: 100%;
			border-collapse: collapse;
		}
		table#earningdetails td, table#earningdetails th, table.deductiondetails td, table.deductiondetails th {
			padding: 8px; 
		}
		table#earningdetails thead {
			padding-top: 16px;;
			border-bottom: 0.5px solid gray;
			color: gray;
			border-top: 0.2px solid gray;
		}
		
		table#earningdetails tbody {
			border-bottom: 0.2px solid gray;
		}
	</style>
	<div class="col-md-12 d-flex justify-content-between border-bottom border-secondary">
		<div class="address" style="text-align:center;">
			<br><br>
		</div>
	</div>
	<div class="col-md-12 mt-4">
		<p class="fs-5">Payslip for the month of: <b>October, 2021</b></p>
		<p class="text-primary"><strong>Staff Details:</strong></p>
		<div class="main_box" style="main_box {display: flex;color:red;}">
			<div class="col-md-8 boxes1">
				<table style="width: 100%;">
					<tr>
						<td style="widows: 60%;">Name</td>
						<td style="text-align:right;">: Mutale Mulenga</td>
					</tr>
					<tr>
						<td style="widows: 60%;">Designation</td>
						<td style="text-align:right;">: Software Engineer</td>
					</tr>
					<tr>
						<td style="widows: 60%;">Employee Number</td>
						<td style="text-align:right;">: 0009800</td>
					</tr>
                    <tr style="margin-bottom:10px;">
						<td style="widows: 60%;">Account Number</td>
						<td style="text-align:right;">: XXXX -782</td>
					</tr>
				</table>
			</div>
			
		</div>
		<br><br>
	</div>
	<div class="col-md-12">
		<table id="earningdetails">
			<thead>
				<tr style="color:white; background-color: #1e1e1e;">
					<th style="widows: 50%; text-align: left; color:white;">EARNINGS</th>
					<th style="width: 25%; text-align: left; color:white;">AMOUNT</th>
					<th style="text-align: right; width: 25%; color:white;">Accrued Totals</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Basic Pay</td>
					<td>ZMW 5780.00</td>
					<td style="text-align: right;">ZMW 5780.0 X 3 </td>
				</tr>

				<tr>
					<td>Electricity</td>
					<td>ZMW 450.00</td>
					<td style="text-align: right;">ZMW 450.0 X 3 </td>
				</tr>
				<tr>
					<td>Water</td>
					<td>ZMW 125.00</td>
					<td style="text-align: right;">ZMW 125.0 X 3 </td>
				</tr>
				<tr>
					<th style="text-align: left;">Gross Earning</th>
					<th style="text-align: left;">ZMW 125.00</th>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table class="deductiondetails">
			<thead>
				<tr style="color:white; background-color: #b22222;">
					<th style="widows: 50%; text-align: left; color:white;">DEDUCTIONS</th>
					<th style="width: 25%; text-align: left; color:white;">AMOUNT</th>
					<th style="text-align: right; width: 25%; color:white;">Accrued Totals</th>
				</tr>
			</thead>
			<tbody>
				<tr style="border-bottom: 2px solid gray">
					<td>Pay as you earn</td>
					<td>ZMW 467.00</td>
					<td style="text-align: right;">ZMW 467.00 X 3 </td>
				</tr>
				<tr>
					<td>Stanchart loan</td>
					<td>ZMW 600.00</td>
					<td style="text-align: right;">ZMW 600.00 X 3 </td>
				</tr>
				<tr>
					<td>Personal levy</td>
					<td>ZMW 125.00</td>
					<td style="text-align: right;">ZMW 125.00 X 3 </td>
				</tr>
				<tr>
					<td>Stanchart loan</td>
					<td>ZMW 600.00</td>
					<td style="text-align: right;">ZMW 600.00 X 3 </td>
				</tr>
				<tr>
					<td>Personal levy</td>
					<td>ZMW 125.00</td>
					<td style="text-align: right;">ZMW 125.00 X 3 </td>
				</tr>
				<tr>
					<td>Stanchart loan</td>
					<td>ZMW 600.00</td>
					<td style="text-align: right;">ZMW 600.00 X 3 </td>
				</tr>
				<tr>
					<td>Personal levy</td>
					<td>ZMW 125.00</td>
					<td style="text-align: right;">ZMW 125.00 X 3 </td>
				</tr>
				<tr>
					<th style="text-align: left;">Total Deductions</th>
					<th style="text-align: left;">ZMW 1567.00</th>
					<td></td>
				</tr>
			</tbody>
			<tfoot>
				<tr style="color:white; background-color: #1e1e1e;">
					<th style="color:white; text-align:left;">NET PAY</th>
					<th></th>
					<th style="text-align: right; color:white;">ZMW 5670.00</th>
				</tr>
			</tfoot>
		</table>

	</div>
</div>
EOD;

	$mpdf->WriteHTML($txt);
	ob_end_clean();
	$mpdf->Output();
// echo $txt;
?>
