<?php
	include("../includes/db.php");
	if (isset($_POST['getAllowanceType'])) {

		$sql = $connect->prepare("SELECT * FROM salary_allowances WHERE parent_id = ?");
		$sql->execute(array($_SESSION['parent_id'])); 
		if ($sql->rowCount() > 0) {?>
			<div class="table table-responsive">
				<table class="table table">
			<?php
				foreach ($sql->fetchAll() as $row) {?>
					<tr>
						<!-- <td style="width: 20%;"><?php echo $row['name']?></td> -->
						<td style="width: 75%;">
							<div class="input-group">
								<input type="text" step="any" name="allowance_name[]" id="allowance_name" class="form-control" readonly value="<?php echo $row['name']?>">
								<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
								<input type="number" step="any" name="allowance_amount[]" id="allowance_amount" class="form-control" placeholder="" min="0" max="1000000" value="" onkeyup="calC(this.value)">
								<input type="hidden" step="any" name="allowance_id[]" id="allowance_id" class="form-control" placeholder="" value="<?php echo $row['id']?>">
							</div>
						</td>
						<td style="width: 5%;">
							<a href="<?php echo $row['id']?>" class="text-danger remove_allowance"><i class="bi bi-x-circle"></i></a>
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