<?php
	require ("../../includes/db.php");

	// require_once 'dompdf/autoload.inc.php';
	require_once __DIR__ . '/../vendor/autoload.php';
	use Dompdf\Dompdf;
	use Dompdf\Options;

	// instantiate and use the dompdf class
	// $dompdf = new Dompdf();
	// $options = $dompdf->getOptions();
	// $options->setIsHtml5ParserEnabled(true);
	$options = new Options();
	$options->setIsRemoteEnabled(true);
	$dompdf = new Dompdf($options);
	$options->set('defaultFont', 'Courier');
	$options->setIsHtml5ParserEnabled(true);

	
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

	$outp = $out = $output = "";
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
			$pay_date;
			$branch_id;
		}
	$query = $connect->prepare("SELECT * FROM organisations WHERE parent_id = ? ");
	$query->execute(array($parent_id));
	if($query->rowCount() > 0){
		$row = $query->fetch();
		if ($row) {
			$src = '
                <img src="/Applications/XAMPP/xamppfiles/htdocs/osabox.net/k/members/adminphotos/'.$row['org_logo'].'" width="60" />
			';
		}
	}else{
		$src = "https://weblister.co/images/icon_new.png";
	}


// <img src="/Applications/XAMPP/xamppfiles/htdocs/osabox.net/k/members/adminphotos/fire.jpeg" width="60" />
$outp .= '
<style>
	.tableDiv {
		border:1px solid #ccc;
	}
	.tableDiv h2 {
		margin-bottom: .3em;
	}
	.intro_table {
		width: 100%;
		border: none;
		
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
		margin-left:-1px;
		margin-right:-1px;
	}

	.column {
		float: left;
		width: 50%;
		padding: 0px;
	}

	.row::after {
		content: "";
		clear: both;
		display: table;
	}

	table {
		border-spacing: 0;
		width: 100%;
	}

	th, td {
		text-align: left;
		padding: 16px;
	}


</style>
<div class="tableDiv">
	<table>
		<tr>
			
			<th><h1>'.ucwords(getOrganisationName($connect, $_SESSION['parent_id'])).'</h1></th>
			<th>'.getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id']).'</th>
			<th>'.$src.'</th>
		</tr>
	</table>
	<table class="intro_table">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th>'.date("F", strtotime($pay_date)).' Payslip</th>
		</tr>
		<hr>
		<thead>
			<tr>
				<th> Names:</th>
				<td>
					'.getStaffMemberNames($connect, $staff_id, $parent_id).'
					<th>Pay Date</th>
					<td>'.$pay_date.'</td>
				</td>
			</tr>
			<tr>
				<th>Man Number:</th>
				<td>
					No. 000'.$staff_id.'
					<th>Branch Name</th>
					<td>'.branchName($connect, $parent_id, $branch_id).'</td>
				</td>
			</tr>
		</thead>
	</table>
	<div class="row">
	  	<div class="column">
	    	<table>
	      		<thead>
					<tr style="background-color: #f2f2f2;">
						<th>Description</th>
						<th>Amount <small>('.$the_currency.')</small></th>
					</tr>
				</thead>

				<tbody>
		';
			$sql = $connect->prepare("SELECT * FROM `payroll_allowances` WHERE payroll_id = ? AND employee_id = ? AND parent_id = ?");
			$sql->execute(array($payroll_id, $staff_id, $parent_id));
			$sum = 0;
			$d = '<td><b>Basic Pay </b></td><td><b>'. $salary_amount.'</b></td>';
			foreach ($sql as $rs) {
				extract($rs);
				$aname = getAllowanceName($connect, $allowance_id, $parent_id);
				$d .=  
				'	<tr>
						<td>'.$aname.'</td>
						<td>'.$allowance_amount.'</td>
					</tr>
				';
			}
			$out .= '
				'.$d.'
				</tbody>
				<tfoot>
					<tr style="background-color: #f2f2f2;">
						<th>Gross Pay</th>
						<th>'. $grosspay .'</th>
					</tr>
				</tfoot>	
	    	</table>
	  	</div>
	  	<div class="column">
	    	<table>
	      		<thead>
					<tr style="background-color: #f2f2f2;">
						<th>Deductions</th>
						<th>Amount <small>('.$the_currency.')</small></th>
					</tr>
				</thead>
				<tbody>
				';
				$dd = "";
				$sql = $connect->prepare("SELECT * FROM `payroll_deductions` WHERE payroll_id = ? AND employee_id = ? AND parent_id = ?");
				$sql->execute(array($payroll_id, $staff_id, $parent_id));
				foreach ($sql as $rs) {
					extract($rs);
					$dname = getDeductionName($connect, $deduction_id, $parent_id);
					$dd .= '
					<tr>
						<td>'.$dname.'</td>
						<td>'.$deduction_amount.'</td>

					</tr>
					';
				}

				$output .= '
				'.$dd.'
				</tbody>
				<tfoot>
					<tr style="background-color: #f2f2f2;">
						<th>Total Deductions</th>
						<td>'.$total_deductions.'</td>
					</tr>
					<tr style="background-color: #f2f2f2;">
						<th>Net Pay</th>
						<th>'.$net_pay.'</th>
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
				<td>'. $payment_method.'</td>
				<td>'. $bank_name.'</td>
				<td>'. $account_number.'</td>
				<td>'.$the_currency.' '. $paid_amount.'</td>
			</tr>
		</tbody>
	</table>
</div>
';
}	
// echo $outp.$out.$output;
	$data = $outp.$out.$output;
	$dompdf->loadHtml($outp.$out.$output);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream("Payslip", array("Attachment" => 0));
