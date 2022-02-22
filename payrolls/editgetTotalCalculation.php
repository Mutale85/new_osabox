<?php
	include("../includes/db.php");
	$parent_id = $_SESSION['parent_id'];
	if (isset($_POST['getTotalCalculation'])) {
		$payroll_id = $_POST['payroll_id'];
		$staff_id   = $_POST['staff_id'];
		$query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND employee_id = ? AND parent_id = ? ");
      	$query->execute(array($payroll_id, $staff_id, $parent_id));
      	foreach ($query as $row) {
            extract($row);
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
					<option value="<?php echo $payment_method?>"><?php echo $payment_method?></option>
					<option value="Cash">Cash</option>
					<option value="Wire Transfer">Wire Transfer</option>
					<option value="Bank Deposit">Bank Deposit</option>
				</select>
			</div>
			<div class="col-md-3 mb-3">
				<label>Bank Name</label>
				<input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $bank_name?>">
			</div>
			<div class="col-md-3 mb-3">
				<label>Account Number</label>
				<input type="text" name="account_number" id="account_number" class="form-control" value="<?php echo $account_number?>">
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
<?php
        }
	}
