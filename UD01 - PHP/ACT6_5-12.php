<!DOCTYPE html>
<html>
	<head>
		<title>PHP - Tax payment an employee has to pay</title>
	</head>

	<?php
		/*  Write a program to calculate the Tax payment an employee has to pay.
			Ask for the Annual salary,
			Tax is calculated by following the next schedule:
				- Less than 10.000 EUR, no tax payment
				- For 10.001 to 15.000 EUR 	→ 10%
				- For 15.001 to 20.000 EUR	→ 15%
				- For 20.001 to 50.000 EUR	→ 20%
				- More than 50.001 EUR	→ 25%
		*/
		function calculate_bill( $units ) {
			$cost_block1 = 10/100;
			$cost_block2 = 15/100;
			$cost_block3 = 20/100;
			$cost_block4 = 25/100;
			$bill = 0.00;

			if ($units <= 10000) {
				$bill = $units * $cost_block1;
			} elseif($units > 10000 && $units <= 15000) {
				$bill = $units * $cost_block2;
			} elseif($units > 20000 && $units <= 50000) {
				$bill = $units * $cost_block3;
			} else {
				$bill = $units * $cost_block4;
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
			<h1>Php - Tax payment an employee has to pay</h1>

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