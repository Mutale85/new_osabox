<?php 
extract($_POST);


$number_of_repayments = '';
if ($symbol == 'p') {
	if ($loan_payment_options == 'Daily' && $interest_per_period == 'Month') {
		$number_of_repayments = 1 * ($loan_duration * 30);
	}else if ($loan_payment_options == 'Daily' && $interest_per_period == 'Year') {
		$number_of_repayments = 1 * ($loan_duration * 30*12); //Year = 12 Months * 30 Days in each month
	}else if ($loan_payment_options == 'Daily' && $interest_per_period == 'Week') {
		$number_of_repayments = 1 * ($loan_duration * 7);
	}else if ($loan_payment_options == 'Daily' && $interest_per_period == 'Daily') {
		$number_of_repayments = 1 * ($loan_duration * 1);
	}

	$m = 30;
	$w = 7;
	$d = 1;
	$y = 365;
	if ($interest_per_period == 'Month' AND $loan__period == 'Months' AND $loan_payment_options == 'Monthly') {
		$number_of_repayments = ($loan_duration * $m) / $m;
	}else if($interest_per_period == 'Month' AND $loan__period == 'Months' AND $loan_payment_options == 'Weekly'){
		$number_of_repayments = ($loan_duration * 30) / $w;
	}else if ($interest_per_period == 'Month' AND $loan__period == 'Months' AND $loan_payment_options == 'Lump-Sum') {
		$number_of_repayments = 1;
	}
	
}else {

	if ($loan_payment_options == 'Daily' && $interest_per_period == 'Month') {
		$number_of_repayments = 1 * ($loan_duration * 30);
	}else if ($loan_payment_options == 'Daily' && $interest_per_period == 'Year') {
		$number_of_repayments = 1 * ($loan_duration * 30*12); //Year = 12 Months * 30 Days in each month
	}else if ($loan_payment_options == 'Daily' && $interest_per_period == 'Week') {
		$number_of_repayments = 1 * ($loan_duration * 7);
	}else if ($loan_payment_options == 'Daily' && $interest_per_period == 'Daily') {
		$number_of_repayments = 1 * ($loan_duration * 1);
	}

	$m = 30;
	$w = 7;
	$d = 1;
	$y = 365;
	if ($interest_per_period == 'Month' AND $loan__period == 'Months' AND $loan_payment_options == 'Monthly') {
		$number_of_repayments = ($loan_duration * $m) / $m;
	}else if($interest_per_period == 'Month' AND $loan__period == 'Months' AND $loan_payment_options == 'Weekly'){
		$number_of_repayments = ($loan_duration * 30) / $w;
	}else if ($interest_per_period == 'Month' AND $loan__period == 'Months' AND $loan_payment_options == 'Lump-Sum') {
		$number_of_repayments = 1;

	}
}

if($symbol == 'p'){
	if ($interest_per_period == "Day" && $loan__period == 'Days') {
		$interest = $loan_interest * $loan_duration;
		$duration = $loan_duration * 1;
		// $monthly = ($principle_amount + ($principle_amount * ($interest/100))) / $duration;

	}elseif ($interest_per_period == "Day" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration * 7); // 7day is a week;
		$duration = $loan_duration * 7;

	}elseif ($interest_per_period == 'Day' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration * 30);
		$duration = $loan_duration * 30;
	}elseif ($interest_per_period == 'Day' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 365);
		$duration = $loan_duration * 365;

	}elseif ($interest_per_period == "Week" && $loan__period == 'Days') {
		$interest = $loan_interest * ($loan_duration / 7);
		$duration = $loan_duration / 7;

	}elseif ($interest_per_period == "Week" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration * 1); // 7day is a week;
		$duration = $loan_duration * 1;
	}elseif ($interest_per_period == 'Week' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration * 4);
		$duration = $loan_duration * 4;

	}elseif ($interest_per_period == 'Week' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 52);
		$duration = $loan_duration * 52;
	}elseif ($interest_per_period == "Month" && $loan__period == 'Days') {
		$interest = $loan_interest * ($loan_duration / 30);
		$duration = $loan_duration / 30;
	}elseif ($interest_per_period == "Month" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration / 4); // 7day is a week;
		$duration = $loan_duration / 4;
	}elseif ($interest_per_period == 'Month' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration * 1);
		$duration = $loan_duration * 1;
	}elseif ($interest_per_period == 'Month' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 12);
		$duration = $loan_duration * 12;
	}elseif ($interest_per_period == "Year" && $loan__period == 'Days') {
		$interest = $loan_interest * ($loan_duration / 365);
		$duration = $loan_duration / 365;
	}elseif ($interest_per_period == "Year" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration / 52); // 7day is a week;
		$duration = $loan_duration / 52;
	}elseif ($interest_per_period == 'Year' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration / 12);
		$duration = $loan_duration / 12;
	}elseif ($interest_per_period == 'Year' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 1);
		$duration = $loan_duration * 1;
	}
}

if ($symbol != 'p') {
	if ($interest_per_period == "Day" && $loan__period == 'Days') {
		$interest = $loan_interest * $loan_duration;
		$duration = $loan_duration * 1;
		
	}elseif ($interest_per_period == "Day" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration * 7); // 7day is a week;
		$duration = $loan_duration * 7;

	}elseif ($interest_per_period == 'Day' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration * 30);
		$duration = $loan_duration * 30;
	}elseif ($interest_per_period == 'Day' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 365);
		$duration = $loan_duration * 365;

	}elseif ($interest_per_period == "Week" && $loan__period == 'Days') {
		$interest = $loan_interest * ($loan_duration / 7);
		$duration = $loan_duration / 7;

	}elseif ($interest_per_period == "Week" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration * 1); // 7day is a week;
		$duration = $loan_duration * 1;
	}elseif ($interest_per_period == 'Week' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration * 4);
		$duration = $loan_duration * 4;

	}elseif ($interest_per_period == 'Week' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 52);
		$duration = $loan_duration * 52;
	}elseif ($interest_per_period == "Month" && $loan__period == 'Days') {
		$interest = $loan_interest * ($loan_duration / 30);
		$duration = $loan_duration / 30;
	}elseif ($interest_per_period == "Month" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration / 4); // 7day is a week;
		$duration = $loan_duration / 4;
	}elseif ($interest_per_period == 'Month' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration * 1);
		$duration = $loan_duration * 1;
	}elseif ($interest_per_period == 'Month' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 12);
		$duration = $loan_duration * 12;
	}elseif ($interest_per_period == "Year" && $loan__period == 'Days') {
		$interest = $loan_interest * ($loan_duration / 365);
		$duration = $loan_duration / 365;
	}elseif ($interest_per_period == "Year" && $loan__period == 'Weeks') {
		$interest = $loan_interest * ($loan_duration / 52); // 7day is a week;
		$duration = $loan_duration / 52;
	}elseif ($interest_per_period == 'Year' && $loan__period == 'Months') {
		$interest = $loan_interest * ($loan_duration / 12);
		$duration = $loan_duration / 12;
	}elseif ($interest_per_period == 'Year' && $loan__period == 'Years') {
		$interest = $loan_interest * ($loan_duration * 1);
		$duration = $loan_duration * 1;
	}
}

if ($loan_interest_method == 'flat_rate') {
	#flat interest $I = interest, $P = principal, $R = Rate charged, $T = $time of Repayment 
	$P = $principle_amount;
	$R = $loan_interest / 100;
	$T = $loan_duration/12;

	$I = $P*$R*$T;
	// A is now the total amount to pay back
	$A = $P+$I;

	$repayments = $A / $number_of_repayments;

}

if ($loan_interest_method == 'reducing_rate') {

	$I = $principle_amount * ($loan_interest*$loan_duration) /100;
	$A = $principle_amount+$I; 
	$repayments = $A / $number_of_repayments;
}

$interest = $principle_amount*($loan_interest/100)*$loan_duration;
$release_date = date("Y-m-d");	
?>
<hr>
<div class="table table-responsive">
<table width="100%">
	<caption><?php echo preg_replace("#[^a-z]#i", " ", ucwords($loan_interest_method))?> Interest</caption>
	<tr>
		<th class="text-center">Repayments</th>
		<th class="text-center">Total Interest</th>
		<th class="text-center">Total Payable Amount</th>
		<th class="text-center"><?php echo $loan_payment_options ?> Payments</th>
		<th class="text-center">Principal Amount</th>
	</tr>
	<tr>
		<td class="text-center"><small><?php echo floor($number_of_repayments) ?> | <?php echo number_format(($loan_interest/100) * $number_of_repayments, 2) ?>%</small></td>
		<td class="text-center"><?php echo $symbol_fee?> <?php echo number_format($I, 2) ?></td>
		<td class="text-center"><?php echo $symbol_fee?> <?php echo number_format($A, 2) ?></td>
		<td class="text-center"><?php echo $symbol_fee?> <?php echo number_format($repayments, 2)?></td>
		<td class="text-center"><?php echo $symbol_fee?> <?php echo number_format($principle_amount, 2)?></td>
		<input type="hidden" name="repayments" id="repayments" value="<?php echo floor($number_of_repayments) ?>">
		<input type="hidden" name="annual_p_rate" id="annual_p_rate" value="<?php echo number_format(($loan_interest/100) * $number_of_repayments, 2) ?>">
		<input type="hidden" name="total_interest_amount" id="total_interest_amount" value="<?php echo $I ?>">
		<input type="hidden" name="total_payable_amount" id="total_payable_amount" value="<?php echo $A ?>">
		<input type="hidden" name="recurring_amount" id="recurring_amount" value="<?php echo $repayments?>">
		<input type="hidden" name="principle_amount" id="principle_amount" value="<?php echo $principle_amount?>">
		<input type="hidden" name="monthly_interest" id="monthly_interest" value="<?php echo  $I/$number_of_repayments ?>">
		<input type="hidden" name="total_monthly_repayments" id="total_monthly_repayments" value="<?php echo  $repayments+($I/$number_of_repayments) ?>">
	</tr>
</table>
</div>
<div class="table table-responsive">
	<table class="cell-border table table-sm " id="ScheduleTable" style="width: 100%">
		<thead>
			<tr>
				<th>Repayments</th>
				<th>Dates:</th>
				<th><?php echo $symbol_fee ?> <?php echo $loan_payment_options ?> Amount</th>
				<th><?php echo $symbol_fee ?> <?php echo $loan_payment_options ?> Interest</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = 1;
				if ($loan_payment_options == "Daily") {
					$p_d = 'days';
				}elseif($loan_payment_options == "Weekly"){
					$p_d = 'weeks';
				}elseif ($loan_payment_options == 'Monthly') {
					$p_d = 'months';
				}elseif ($loan_payment_options == 'Lump-Sum') {
					$p_d = 'months';
				}
				$period = 1;
				$numbers = 1;
				$add = 1;
				for ($loan_duration = 1; $loan_duration <= $number_of_repayments; $loan_duration++) {?>
					<tr>
						<td><?php echo $numbers++;?></td>
						<td><?php echo date("Y-m-d", strtotime("+".$period++." ".$p_d."", strtotime($release_date))); ?></td>
						<td><small class="text-fade"><?php echo $symbol_fee?></small> <?php echo number_format($repayments, 2) ?></td>
						<td><small class="text-fade"><?php echo $symbol_fee?></small> <?php echo number_format( ($I/$number_of_repayments), 2) ?></td>
					</tr>
					<input type="hidden" name="payment_period[]" id="payment_period" value="<?php echo date("Y-m-d", strtotime("+".$add++." ".$p_d."", strtotime($release_date)))?>">
			<?
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>Payment Mode</th>
				<th><?php echo $loan_payment_options ?></th>
				<th>Loan Duration</th>
				<th><?php echo $loan_duration  - 1 ?> <?php echo $loan__period ?></th>
			</tr>
		</tfoot>
		<!-- <tfoot>
			<tr>
				<th>Loan Interest</th>
				<th></th>
				<th><small class="text-fade"><?php echo $symbol_fee?></small> <?php echo number_format($total_payable_amount, 2) ?></th>
				<th><small class="text-fade"><?php echo $symbol_fee?></small> <?php echo number_format($total_interest_amount, 2) ?></th>
				<th></th>
			</tr>
		</tfoot> -->
	</table>        
</div>
<hr>