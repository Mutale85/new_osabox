<!DOCTYPE html>
<html>
<head>
	<?php include("supports/header.php");?>
	<title>Osabox.co - Pricing</title>

</head>
<body>
	<?php include ("supports/nav.php"); ?>
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	  <symbol id="check" viewBox="0 0 16 16">
	    <title>Check</title>
	    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
	  </symbol>
	</svg>
<div class="first_section">
<div class="container py-3">
  <header>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Pricing</h1>
      <p class="fs-5 text-muted">Monthly</p>
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Free</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title pricing-card-title">30 Days Free<small class="text-muted fw-light"></small></h4>
            <ul class="list-unstyled mt-3 mb-4">
              <li>5 Projects</li>
              <li>5 Payslips</li>
              <li>5 Free SMS</li>
              <li>1 Branch</li>
              <li>5 Team Members</li>
              <li>Email support</li>
            </ul>
            <form method="get" action="register">
            	<input type="hidden" name="register" id="register" value="1">
            	<button type="submit" class="button-17">Sign up for free</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Standard</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title pricing-card-title">$10<small class="text-muted fw-light">/mo</small><small class="text-muted fw-light"></small></h4>
            <ul class="list-unstyled mt-3 mb-4">
              	<li>Unlimited Projects</li>
                <li>20 Payslips</li>
                <li>50 Monthly SMS</li>
              	<li>5 Branches</li>
              	<li>05 Team Members</li>
              	<li>Priority email support</li>
            </ul>
            <form method="get" action="register">
            	<input type="hidden" name="register" id="register" value="2">
            	<button type="submit" class="button-17">Get started</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Platinum</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title pricing-card-title">$29.99<small class="text-muted fw-light">/mo</small></h4>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Unlimited Projects</li>
              <li>Unlimited Payslips</li>
              <li>200 Monthly SMS</li>
              <li>Unlimited Branches</li>
              <li>Unlimited Team Members</li>
              <li>Priorty email support</li>
            </ul>
            <form method="get" action="register">
            	<input type="hidden" name="register" id="register" value="3">
            	<button type="submit" class="button-17">Get started</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <h2 class="display-6 text-center mb-4">Compare plans</h2>

    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th style="width: 34%;"></th>
            <th style="width: 22%;">Free</th>
            <th style="width: 22%;">Standard</th>
            <th style="width: 22%;">Platinum</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-start">Project Mangement Tool</th>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Payroll Generating System</th>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
        </tbody>

        <tbody>
          <tr>
            <th scope="row" class="text-start">Branches</th>
            <td>1</td>
            <td>5</td>
            <td>Unlimited</td>
          </tr>
          <tr>
            <th scope="row" class="text-start">SMS Clients</th>
            <td>5 SMS</td>
            <td>50 SMS (Accumulative)</td>
            <td>200 SMS (Accumulative)</td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Staff Members</th>
            <td>5</td>
            <td>5</td>
            <td>Unlimited</td>
          </tr>
          <!-- <tr>
            <th scope="row" class="text-start">Collateral Management</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr> -->
          <tr>
            <th scope="row" class="text-start">No Set Up Fee</th>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
        </tbody>
      </table>
    </div>
  	</main>
  </div>
</div>
<?php include ("supports/footer.php");?>
</body>
</html>