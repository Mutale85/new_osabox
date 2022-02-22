<?php
	include("../includes/db.php");
	$parent_id = $_SESSION['parent_id'];
	if (isset($_POST['getDeductionType'])) {
		$payroll_id = $_POST['payroll_id'];
		$staff_id   = $_POST['staff_id'];

		$query = $connect->prepare("SELECT * FROM salary_deductions WHERE parent_id = ?");
		$query->execute(array($_SESSION['parent_id'])); 
		if ($query->rowCount() > 0) {
			
		?>
		<div class="table table-responsive">
			<table class="table table-borderless">
			<?php 
				foreach ($query->fetchAll() as $row) {
					$sql = $connect->prepare("SELECT * FROM payroll_deductions WHERE payroll_id = ? AND parent_id = ? AND deduction_id = ? ");
					$sql->execute(array($payroll_id, $parent_id, $row['id']));
					$roq = $sql->fetch();
					if ($roq) {
			?>
					<tr>
						<td style="width: 20%"><?php echo $row['name']?></td>
						<td style="width: 75%">
							
						<div class="input-group">
						<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
							<input type="number" step="any" name="deduction_amount[]" id="deduction_amount" class="form-control" placeholder="" min="0" max="1000000" value="<?php echo $roq['deduction_amount'] ?>" onkeyup="calCDeduction(this.value)">
						</div>
						<input type="hidden" step="any" name="deduction_id[]" id="deduction_id" class="form-control" placeholder="" value="<?php echo $row['id']?>">
					</td>
					<td style="width: 5%">
						<a href="<?php echo $row['id']?>" class="text-danger remove_deduction"><i class="bi bi-x-circle"></i></a>
					</td>
				</tr>
		<?php	} 
			}
		?>
			</table>
		</div>
	<?php
		}else{
			$output = '';
		}
	}
?>