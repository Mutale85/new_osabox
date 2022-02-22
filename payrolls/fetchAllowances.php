<?php
	include("../includes/db.php");
	if (isset($_POST['fetchAllowances'])) {

		$sql = $connect->prepare("SELECT * FROM salary_allowances WHERE branch_id = ? AND parent_id = ? AND staff_id = ?");
		$sql->execute(array($_POST['branch_id'], $_SESSION['parent_id'], $_POST['staff_id'])); 
		if ($sql->rowCount() > 0) {?>
			<div class="table table-responsive">
				<table class="table table-borderless">
			<?php
				foreach ($sql->fetchAll() as $row) {?>
					<tr>
						<th><?php echo $row['name']?></th>
						<td>
							<div class="form-group">
								<div class="input-group">
									<input type="hidden" step="any" name="allowance_name[]" id="allowance_name" class="form-control" readonly value="<?php echo $row['name']?>">
									<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
									<input type="number" step="any" name="allowance_amount[]" id="allowance_amount" class="form-control" placeholder="" min="0" max="1000000" value="<?php echo $row['amount']?>" onkeyup="calC(this.value)" readonly>
									<input type="hidden" step="any" name="allowance_id[]" id="allowance_id" class="form-control" placeholder="" value="<?php echo $row['id']?>">
									<span class="input-group-text"><a href="<?php echo $row['id']?>" class="text-danger remove_allowance_and_amount"><i class="bi bi-x-circle"></i></a></span>
								</div>
							</div>
						</td>
					</tr>	
		<?php	}?>
				</table>
			</div>
	<?php	
		}else{
			$output = '';
		}	
	}

?>