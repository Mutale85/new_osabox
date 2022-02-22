<?php
	include("../includes/db.php");
	if (isset($_POST['getDeductionType'])) {
		$query = $connect->prepare("SELECT * FROM salary_deductions WHERE parent_id = ?");
		$query->execute(array($_SESSION['parent_id'])); 
		if ($query->rowCount() > 0) {
		?>
		<div class="table table-responsive">
			<table class="table table">
			<?php 
				foreach ($query->fetchAll() as $row) {?>
					<tr>
						<!-- <td style="width: 20%"><?php echo $row['name']?></td> -->
						<td style="width: 75%">
							
						<div class="input-group">
							<input type="text" step="any" name="deduction_name[]" id="deduction_name" class="form-control" readonly value="<?php echo $row['name']?>">
						<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
							<input type="number" step="any" name="deduction_amount[]" id="deduction_amount" class="form-control" placeholder="" min="0" max="1000000" value="" onkeyup="calCDeduction(this.value)">
						</div>
						<input type="hidden" step="any" name="deduction_id[]" id="deduction_id" class="form-control" placeholder="" value="<?php echo $row['id']?>">

					</td>
					<td style="width: 5%">
						<a href="<?php echo $row['id']?>" class="text-danger remove_deduction"><i class="bi bi-x-circle"></i></a>
					</td>
				</tr>
		<?php	} ?>
			</table>
		</div>
	<?php
		}else{
			$output = '';
		}
	}
?>