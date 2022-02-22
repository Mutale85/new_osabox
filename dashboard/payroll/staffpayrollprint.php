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
    @media print {
      body {
        background: red;
      }
    }
  </style>
</head>
<body>
	<div class="wrapper">
			<section class="invoice">
            <div class="container-fluid">
              <div class="row invoice-info">
                <div class="col-md-12">
                  <div class="table table-responsive">
                <?php
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
                <div class="table table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <th><b><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></b></th>
                      <th><?php echo getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id'])?></th>
                      <th><?php echo $src?></th>
                    </tr>
                  </table>
                  <table class="table table-striped">
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><?php echo date("F", strtotime($pay_date))?> Payslip</th>
                    </tr>
                    <thead>
                      <tr>
                        <td><b> Names:</b></td>
                        <td>
                          <?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?>
                          <td><b>Pay Date:</b></td>
                          <td><?php echo $pay_date ?></td>
                        </td>
                      </tr>
                      <tr>
                        <td><b>Man Number:</b></td>
                        <td>
                          No. 000<?php echo $staff_id ?>
                          <td><b>Branch Name</b></td>
                          <td><?php echo branchName($connect, $parent_id, $branch_id)?></td>
                        </td>
                      </tr>
                    </thead>
                  </table>
                  <div class="row">
                      <div class="col-md-6">
                          <table class="table table-striped">
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
                                  <td><?php echo $the_currency?> <?php echo $grosspay ?></td>
                                </tr>
                              </tfoot>  
                          </table>
                      </div>
                      <div class="col-md-6">
                        <table class="table table-striped">
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
                            <td>Total decutions</td>
                            <td><?php echo $total_deductions ?></td>
                          </tr>
                          <tr>
                            <th>Net Pay</th>
                            <th><?php echo $the_currency?> <?php echo $net_pay ?></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <table class="table table-striped">
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
                        <td><?php echo $the_currency?> <?php echo $paid_amount?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>
      </section>
    </div>
   <script>
      window.addEventListener("load", window.print());
  </script>
</body>
</html>