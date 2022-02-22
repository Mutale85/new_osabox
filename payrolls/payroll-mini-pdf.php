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
	$mpdf->SetTitle($name . ' Payslip');
	$mpdf->SetHeader('October - Payslip|'.$name.'<br>'.$address.'|{PAGENO}');
	$mpdf->SetFooter('October - Payslip');

	$mpdf->defaultheaderfontsize=10;
	$mpdf->defaultheaderfontstyle='B';
	$mpdf->defaultheaderline=0;
	$mpdf->defaultfooterfontsize=10;
	$mpdf->defaultfooterfontstyle='BI';
	$mpdf->defaultfooterline=0;

	$payroll_id = $_GET['payroll-id'];
    $staff_id = $_GET['staff-id'];
    $parent_id = $_SESSION['parent_id'];

    $query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND parent_id = ? AND staff_id = ? ");
    $query->execute(array($payroll_id, $parent_id, $staff_id));
    $count_rows = $query->rowCount();
    $row = $query->fetch();
    $pay_date = $row['pay_date'];
    $man_number = $row['man_number'];
    $payment_method = $row['payment_method'];
    $account_number = substr($row['account_number'], 0, 3);
    $net_pay = $row['net_pay'];
    $the_currency = $row['the_currency'];
    $salary_amount = $row['salary_amount'];
    $grosspay = $row['grosspay'];
    $total_deductions = $row['total_deductions'];
    $bank_name = $row['bank_name'];
    $period = 1;
    $names = getStaffMemberNames($connect, $staff_id, $parent_id);
    $position = getStaffMemberRole($connect, $staff_id, $parent_id);
    $accrued_basic = $salary_amount * $count_rows;

    function getAddedAllowances($connect, $payroll_id, $staff_id, $parent_id, $currency, $rows){
    	$output = ''; 
		$sql = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND employee_id = ? and parent_id = ?");
		$sql->execute(array($payroll_id, $staff_id,  $parent_id));
		$result = $sql->fetchAll();
		foreach ($result as $roq) {
			$output .=' 
				<tr>
					<td>'.$roq['allowance_name'].'</td>
					<td>'.$currency.' '.$roq['allowance_amount'].'</td>
					<td style="text-align: right;">'.$currency.' '.$roq['allowance_amount']*$rows.'</td>
				</tr>
				';
		}

		return $output;
    }

    $allowances = getAddedAllowances($connect, $payroll_id, $staff_id, $parent_id, $the_currency, $count_rows);


    function getAddedDeductions($connect, $payroll_id, $staff_id, $parent_id, $currency, $rows){
    	$d_outputs = '';
		$sql_deduc = $connect->prepare("SELECT * FROM payroll_deductions WHERE payroll_id = ? AND employee_id = ? and parent_id = ?");
		$sql_deduc->execute(array($payroll_id, $staff_id, $parent_id));
		$result = $sql_deduc->fetchAll();
		foreach ($result as $row) { 
			$d_outputs .=' 
				<tr>
					<td>'.$row['deduction_name'].'</td>
					<td>'.$currency.' '.$row['deduction_amount'].'</td>
					<td style="text-align: right;">'.$currency.' '.$row['deduction_amount']*$rows.'</td>
				</tr>
				';
		}
		return $d_outputs;
    }

    $deductions = getAddedDeductions($connect, $payroll_id, $staff_id, $parent_id, $the_currency, $count_rows);

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
						<td style="text-align:right;"> {$names}</td>
					</tr>
					<tr>
						<td style="widows: 60%;">Designation</td>
						<td style="text-align:right;"> {$position}</td>
					</tr>
					<tr>
						<td style="widows: 60%;">Employee Number</td>
						<td style="text-align:right;"> {$man_number}</td>
					</tr>
					<tr style="margin-bottom:10px;">
						<td style="widows: 60%;">Bank Name</td>
						<td style="text-align:right;"> {$bank_name}</td>
					</tr>
                    <tr style="margin-bottom:10px;">
						<td style="widows: 60%;">Account Number</td>
						<td style="text-align:right;"> ****** {$account_number}</td>
					</tr>
				</table>
			</div>
			
		</div>
		<br><br>
	</div>
	<div class="col-md-12">
		<table id="earningdetails">
			<thead>
				<tr style="color:white; background-color: gray;">
					<th style="widows: 50%; text-align: left; color:white;">EARNINGS</th>
					<th style="width: 25%; text-align: left; color:white;">AMOUNT</th>
					<th style="text-align: right; width: 25%; color:white;">ACCRUED TOTALS</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th style="text-align: left;">Basic Pay</th>
					<td>{$the_currency} {$salary_amount}</td>
					<td style="text-align: right;">{$the_currency} {$accrued_basic} </td>
				</tr>
				{$allowances}
				
				<tr>
					<th></th>
					<th style="text-align: left;">Gross Earning</th>
					<th style="text-align: right;">{$the_currency} {$grosspay}</th>
					
				</tr>
			</tbody>
		</table>
		<table class="deductiondetails">
			<thead>
				<tr style="color:white; background-color: #b22222;">
					<th style="widows: 50%; text-align: left; color:white;">DEDUCTIONS</th>
					<th style="width: 25%; text-align: left; color:white;">AMOUNT</th>
					<th style="text-align: right; width: 25%; color:white;">ACCRUED TOTALS</th>
				</tr>
			</thead>
			<tbody>
				{$deductions}
				<tr>
					<th></th>
					<th style="text-align: left;">Total Deductions</th>
					<th style="text-align: right;">{$the_currency} {$total_deductions}</th>
					
				</tr>
			</tbody>
			<tfoot>
				<tr style="color:white; background-color: ;">
					<th></th>
					<th style="color:green; text-align:left;">NET PAY</th>
					<th style="text-align: right; color:green;">{$the_currency} {$net_pay}</th>
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
