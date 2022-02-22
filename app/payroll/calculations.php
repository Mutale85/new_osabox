<?php
	include("../../includes/db.php");
	extract($_POST);
	 
	$calc = 0; 
	foreach ($allowance_amount as $key => $value) {
		$calc += $value;
	}

	$deduc = 0;
	foreach ($deduction_amount as $key => $value) {
		$deduc += $value;

	}

	$grosspay =  $calc+$salary_amount;
	$total_deductions = $deduc;

	$net_pay = $grosspay - $total_deductions;
?>

<div class="row ">
	<div class="form-group col-md-4">
		<label>Gross Pay</label>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
				<input type="number" step="any" name="grosspay" id="grosspay" class="form-control" readonly value="<?php echo $grosspay?>">
			</div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<label>Total Deduction </label>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
				<input type="number" step="any" name="total_deductions" id="total_deductions" class="form-control" readonly value="<?php echo $total_deductions?>">
			</div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<label>Net Pay </label>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
				<input type="number" step="any" name="net_pay" id="net_pay" class="form-control" readonly value="<?php echo $net_pay?>">
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h4 class="text-primary mb-4">Payment Distribution</h4>
	</div>
	<div class="col-md-3 mb-3">
		<label>Payment Method</label>
		<select class="form-control" name="payment_method" id="payment_method" required>
			<option value="">Select</option>
			<option value="Cash">Cash</option>
			<option value="Wire Transfer">Wire Transfer</option>
			<option value="Bank Deposit">Bank Deposit</option>
		</select>
	</div>
	<div class="col-md-3 mb-3">
		<label>Bank Name</label>
		<input type="text" name="bank_name" id="bank_name" class="form-control">
	</div>
	<div class="col-md-3 mb-3">
		<label>Account Number</label>
		<input type="text" name="account_number" id="account_number" class="form-control">
	</div>
	<div class="col-md-3 mb-3">
		<label>Paid Amount</label>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
				<input type="text" name="paid_amount" id="paid_amount" class="form-control" value="<?php echo $net_pay?>" readonly>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<button class="btn btn-primary" type="submit" id="submitPay">Create Payslip</button>
	</div>
</div>