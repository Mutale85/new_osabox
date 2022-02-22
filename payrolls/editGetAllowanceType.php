<?php
	include("../includes/db.php");
	$parent_id = $_SESSION['parent_id'];
	if (isset($_POST['getAllowanceType'])) {
		$payroll_id = $_POST['payroll_id'];
		$staff_id   = $_POST['staff_id'];
		$sql = $connect->prepare("SELECT * FROM salary_allowances WHERE parent_id = ?");
		$sql->execute(array($_SESSION['parent_id'])); 
		if ($sql->rowCount() > 0) {?>
			<div class="table table-responsive">
				<table class="table table-borderless">
			<?php
				foreach ($sql->fetchAll() as $row) {
					$find = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND parent_id = ? AND allowance_id = ? ");
					$find->execute(array($payroll_id, $parent_id, $row['id']));
					$roq = $find->fetch();
					if ($roq) {
						extract($roq);
				?>
						<tr>
							<td style="width: 20%;"><?php echo $row['name']?></td>
							<td style="width: 75%;">
								<div class="input-group">
									<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
									<input type="number" step="any" name="allowance_amount[]" id="allowance_amount" class="form-control" placeholder="" min="0" max="1000000" value="<?php echo $allowance_amount?>" onkeyup="calC(this.value)">
								</div>
							</td>
							<td style="width: 5%;">
								<a href="<?php echo $id?>" class="text-danger remove_allowance_and_amount"><i class="bi bi-x-circle"></i></a>
							</td>
							<input type="hidden" step="any" name="allowance_id[]" id="allowance_id" class="form-control" placeholder="" value="<?php echo $id?>">
						</tr>	
		<?php		}
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