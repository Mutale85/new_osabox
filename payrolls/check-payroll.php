<?php 
      require ("includes/db.php");
      require ("includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Check Payroll</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
      <?php include ("dash_data.php"); ?>
			<section class="content mt-5">
      	<div class="container-fluid">
          <div class="row">
            <?php
              function getTotalAllowances($connect, $staff_id, $parent_id) {
                    $output = '';
                    $query = $connect->prepare("SELECT SUM(`allowance_amount`) AS total_allowances FROM `payroll_allowances` WHERE `employee_id` = ? AND parent_id = ?");
                    $query->execute(array($staff_id, $parent_id));
                    $row = $query->fetch();
                    if ($row) {
                          $output = $row['total_allowances'];
                    }
                    return $output;
              }

              $query = $connect->prepare("SELECT * FROM payroll WHERE parent_id = ? ");
              $query->execute(array($_SESSION['parent_id']));
              foreach ($query as $row) {
                extract($row);
            ?>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <img src="<?php echo getStaffMemberImage($connect, $staff_id, $parent_id) ?>" class="img-fluid shadow" alt="<?php echo getStaffMemberImage($connect, $staff_id, $parent_id) ?>" style="width: 30px;height: 30px; border-radius: 50%;">
                    </div>

                    <h4 class="card-title ml-3">
                      <?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?>
                    </h4>
                    <div class="card-tools">
                      <a href="new-payroll?payroll_id=<?php echo $id?>&parent_id=<?php echo $parent_id?>&staff-id=<?php echo $staff_id?>"><i class="bi bi-pen"></i> Edit</a> | 
                      <a href="<?php echo $id?>" class="deletePayroll text-danger" id="<?php echo $staff_id?>"> <i class="bi bi-trash2"></i> Delete</a>
                    </div>    
                </div>
                <div class="card-body">
                  <table class="table table-borderless">
                    <tr>
                      <th>Pay Date</th>
                      <td style="text-align: right;"><?php echo $pay_date ?></td>
                    </tr>
                    <tr>
                      <th>Basic pay</th>
                      <td style="text-align: right;"><small><?php echo $the_currency?></small> <?php echo $salary_amount?></td>
                    </tr>
                    <tr>
                      <th>Allowances</th>
                      <td style="text-align: right;"><small><?php echo $the_currency?></small> <?php echo getTotalAllowances($connect, $staff_id, $parent_id)?></td>
                    </tr>
                    <tr>
                      <th>Gross pay</th>
                      <td style="text-align: right;"><small><?php echo $the_currency?></small> <?php echo number_format($grosspay, 2) ?></div></td>
                    </tr>
                    <tr>
                      <th>Deductions</th>
                      <td style="text-align: right;"><small><?php echo $the_currency?></small> <?php echo number_format($total_deductions, 2) ?></td>
                    </tr>
                    <tr>
                      <th>Net Pay</th>
                      <td style="text-align: right;"><small><?php echo $the_currency?></small> <?php echo number_format($net_pay, 2) ?></td>
                    </tr>
                  </table>
                    <div class="card-footer text-center">
                        <a href="payslip-preview?payroll-id=<?php echo $id;?>&parent-id=<?php echo $parent_id?>&staff-id=<?php echo $staff_id?>" class="btn btn-success OneTemplate">Preview Payslip One</a>
                        <a href="payslip-preview-two?payroll-id=<?php echo $id;?>&parent-id=<?php echo $parent_id?>&staff-id=<?php echo $staff_id?>" class="btn btn-warning TwoTemplate">Preview Payslip Two</a>
                    </div>
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
    <script src="plugins/toastr/toastr.min.js"></script>
    <script>
          
          $(document).ready(function(){
            $(document).on("click", ".deletePayroll", function(argument) {
                  argument.preventDefault();
                  var payroll_id = $(this).attr("href");
                  var staff_id = $(this).attr("id");
                  if(confirm("Confirm you wish to delete the payroll. It cannot be undone")){

                      $.ajax({
                        url:"editPayroll",
                        method:"post",
                        data:{payroll_id:payroll_id, staff_id:staff_id},
                        success:function(data){
                          successNow(data);
                          setTimeout(function(){
                                location.reload();
                          }, 1500);
                        }
                      })
                  }else{
                        return false;
                  }
            })
          })

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
    </script>
</body>
</html>