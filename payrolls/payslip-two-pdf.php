<?php 
	ob_start();
  	require ("includes/db.php");
  	require ("includes/tip.php"); 

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
    $payment_method = strtoupper($row['payment_method']);
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
    // new data ----
    $orgname = ucwords(getOrganisationName($connect, $_SESSION['parent_id']));
    $pay_date = date("d/m/Y", strtotime($pay_date));
    $address =getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id']);
    $staff_names = strtoupper(getStaffMemberNames($connect, $staff_id, $parent_id));
    $currency = getCurrency($connect, $parent_id);
    function getAddedAllowances($connect, $payroll_id, $staff_id, $parent_id, $currency){
    	$output = ""; 
		$sql = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND employee_id = ? and parent_id = ?  ");
		$sql->execute(array($payroll_id, $staff_id,  $parent_id));
		$result = $sql->fetchAll();
		$i = 1;
		foreach ($result as $roq) {
			$output .=' 
				<tr>
					<td>'.$i++.'</td>
					<td>'.$roq['allowance_name'].'</td>
					<td>'.$currency.' '.$roq['allowance_amount'].'</td>
				</tr>
				';
		}
		return $output;
    }

    $allowances = getAddedAllowances($connect, $payroll_id, $staff_id, $parent_id, $currency);


    function getAddedDeductions($connect, $payroll_id, $staff_id, $parent_id, $currency){
    	$d_outputs = '';
		$sql = $connect->prepare("SELECT * FROM  payroll_deductions WHERE payroll_id = ? AND employee_id = ? and parent_id = ? ");
		$sql->execute(array($payroll_id, $staff_id,  $parent_id));
		$result = $sql->fetchAll();
		$i = 1;
		foreach ($result as $roq) {
			$d_outputs .='
				<tr> 
					<td>'.$i++.'</td>
					<td>'.$roq['deduction_name'].'</td>
					<td>'.$currency.' '.$roq['deduction_amount'].'</td>
				</tr>
				';
		}

		return $d_outputs;
    }

    $deductions = getAddedDeductions($connect, $payroll_id, $staff_id, $parent_id, $currency);
    
	$stylesheet = file_get_contents('dist/css/bootstrap.min.css');
 	$stylesheet .= file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'); 
	$mpdf->WriteHTML($stylesheet, 1); // CSS Script goes here.
// set some text to print
$txt = <<<EOD
	<div class="container mb-5">
      <br><br>
        <div class="invoice p-3 mb-3">
          
          <div class="row invoice-info">
            
            <div class="col-sm-4 invoice-col">
              
              <address>
                <b>{$staff_names}</b><br>
                <b>Man Number:</b> {$man_number}<br>
              </address>
            </div>
            <div class="col-sm-4 invoice-colData">
              <b>Payslip No: {$count_rows}</b><br>
              <br>
              <b>Bank Name:</b> {$bank_name}<br>
              <b>Account:</b> *******{$account_number}
            </div>
            <br><br>
          </div>
          
            <div class="col12 table-responsive mb-5">
              
            	<div class="row_table">
                	<div class="col6">
                		<table class="column_table">
                			<tr>
	                      	<th>S/N</th>
	                      	<th>Allowances</th>
	                      	<th>Amount</th>
	                    </tr>
	                    {$allowances}
						      </table>
					     </div>
					     <div class="col6">
						      <table class="column_table2">
      							<tr>
      		            <th>S/N</th>
      		            <th>Deduction</th>
      		            <th>Amount</th>
      		          </tr>
							      {$deductions}
	               </table>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <p class="lead">Payment Methods:</p>
              	{$payment_method}
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">Pay Date {$pay_date}</p>
            </div>
            <div class="col-12">
              <div class="table-responsive">
                <table class="table" style="width:100%;">
                  <tr>
                    <th>GROSS PAY:</th>
                    <th style="text-align: right;">{$currency} <strong>{$grosspay}</strong></th>
                  </tr>
                  <tr>
                    <th>Total Deductions</th>
                    <th style="text-align: right;">{$currency} <strong>{$total_deductions}</strong></th>
                  </tr>
                  <tr>
                    <th></th>
                    <td></td>
                  </tr>
                  <tr style="border-top: 2px solid black;border-bottom: 2px solid black;">
                    <th>NET PAY:</th>
                    <th style="text-align: right;">{$currency} <strong>{$net_pay}</strong></th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
EOD;
	$mpdf->AddPage('L');
	$mpdf->WriteHTML($txt, 2);
	ob_end_clean();
	$mpdf->Output();
// echo $txt;
?>
