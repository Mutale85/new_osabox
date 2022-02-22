<?php
	include("includes/db.php");
	extract($_POST);
	

	if (!empty($staff_id)) {
		if (!empty($salary_amount)) {
			$query = $connect->prepare("SELECT SUM(amount) AS total_allowances FROM `salary_allowances` WHERE branch_id = ?  AND parent_id = ? AND staff_id = ?");
			$query->execute(array($branch_id, $_SESSION['parent_id'], $staff_id));
			
			$row  = $query->fetch();
			$total_allowances = $row['total_allowances'];
			$grosspay = $_POST['salary_amount'] + $total_allowances;

			$query = $connect->prepare("SELECT SUM(amount) AS total_deductions FROM `salary_deductions` WHERE branch_id = ?  AND parent_id = ? AND staff_id = ?");
			$query->execute(array($branch_id, $_SESSION['parent_id'], $staff_id));
			$row  = $query->fetch();
			$total_deductions = $row['total_deductions'];
			if ($total_deductions == "") {
				$total_deductions = 0.00;
			}
			$net_pay = $grosspay - $total_deductions;
		}else{
			if (isset($_COOKIE['AllAmount'])) {
				$AllAmount = $_COOKIE['AllAmount'];
			}else{
				$AllAmount = 0;
			}
			$query = $connect->prepare("SELECT SUM(amount) AS total_allowances FROM `salary_allowances` WHERE branch_id = ?  AND parent_id = ? AND staff_id = ?");
			$query->execute(array($branch_id, $_SESSION['parent_id'], $staff_id));
			
			$row  = $query->fetch();
			$total_allowances = $row['total_allowances'];
			$grosspay = (int) $AllAmount + $total_allowances;

			$query = $connect->prepare("SELECT SUM(amount) AS total_deductions FROM `salary_deductions` WHERE branch_id = ?  AND parent_id = ? AND staff_id = ?");
			$query->execute(array($branch_id, $_SESSION['parent_id'], $staff_id));
			$row  = $query->fetch();
			$total_deductions = $row['total_deductions'];
			$net_pay = $grosspay - $total_deductions;
		} 
			 
	}

	
	
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
		<button class="btn btn-primary" type="submit" id="submitPay">Create Payslip</button>
	</div>
</div>