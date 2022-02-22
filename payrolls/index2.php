<?php 
  require ("includes/db.php");
  if (!isset($_COOKIE['userLoggedin']) && !isset($_SESSION['email'])) {?>
      <script>
          window.location = 'https://osabox.co';
      </script>
  <?php
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("links.php") ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include ("nav_side.php"); ?>

  <div class="content-wrapper">
    <div class="content-header mt-5">
      <div class="container-fluid mt-5">
        <div class="row mb-2 mt-5">
          <div class="col-sm-6">
            <h4 class="m-0"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./" id="timeRemaining">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?> </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      
      <div class="container-fluid">
        <?php if($_SESSION['user_role'] == 'Admin'):?>
        <div class="row">
          <div class="col-lg-12 mb-4">
            <h1 class="h3 text-center"><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $_SESSION['parent_id'])?></h1>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo Generated_Payslips ($connect, $_SESSION['parent_id'])?></h3>

                <p>Generated Payslips</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="check-payroll" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo getCurrency($connect, $_SESSION['parent_id'])?> <?php echo TotalPaid($connect, $_SESSION['parent_id'])?></h3>

                <p>Payroll Expenditure</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="PayrollExpenditure" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo countAllMembers($connect, $_SESSION['parent_id'])?></h3>

                <p>Staff Members</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="members/staff-members" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <?php else:?>
          <div class="row">
            <div class="col-lg-12 mb-4">
              <h1 class="h3 text-center"><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $_SESSION['parent_id'])?> <small><?php echo $_SESSION['user_role']?></small></h1>
            </div>
            <div class="col-lg-12 col-12">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo Generated_Payslips ($connect, $_SESSION['parent_id'])?></h3>

                  <p>View Payslip</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="view-payslips" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
      </div>

        <?php endif;?>
        
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
  </div>
<?php include("footer_links.php")?>

</body>
</html>
