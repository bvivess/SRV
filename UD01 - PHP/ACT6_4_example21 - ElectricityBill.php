<!DOCTYPE html>
<html>
	<head>
		<title>PHP - Calculate Electricity Bill</title>
	</head>

	<?php
		/*  Write a program to calculate Electricity bill in PHP
			Description:

			You need to write a PHP program to calculate electricity bill using if-else conditions.

			Conditions:

			For first 100 kW 	–-> Result: 1.00 €/kW
			For next  200 kW 	–-> Result: 2.00 €/kW
			For next  300 kW 	–-> Result: 3.00 €/kW
			For units above 300	–-> Result: 4.00 €/kW
		*/
		function calculate_bill( $units ) {
			$cost_block1 = 1.00;
			$cost_block2 = 2.00;
			$cost_block3 = 3.00;
			$cost_block4 = 4.00;
			$bill = 0.00;

			if ($units <= 100) {
				$bill = $units * $cost_block1;
			} elseif($units > 100 && $units <= 200) {
				$bill = (100 * $cost_block1) + (($units - 100) * $cost_block2);
			} elseif($units > 200 && $units <= 300) {
				$bill = (100 * $cost_block1) + (100 * $cost_block2) + (($units - 200) * $cost_block3);
			} else {
				$bill = (100 * $cost_block1) + (100 * $cost_block2) + (100 * $cost_block2) + (($units - 300) * $cost_block3);
			}
			
			return number_format((float)$bill, 2, '.', '');
		}
	
		$result_str = $result = '';
		
		if (isset($_POST['unit-submit'])) {
			$units = $_POST['units'];
			
			if (!empty($units)) {
				$result = calculate_bill($units);
				$result_str = $units . ' - ' . $result;
			}
		}
	?>

	<body>
		<div id="page-wrap">
			<h1>Php - Calculate Electricity Bill</h1>

			<form action="" method="post" id="quiz-form">
				<input type="number" name="units" id="units" placeholder="Please enter no. of Units" />
				<input type="submit" name="unit-submit" id="unit-submit" value="Submit" />
				<p>
					<input readonly="readonly" name="result" value="<?php echo $result_str; ?>"/> <b>Euros</b>
				</p>
			</form>
		</div> 
	</body>
</html>