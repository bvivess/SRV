<?php
	/*  Write a program to calculate the Water service a customer has to pay.
		Ask for the water amount a customer has consumed,
		Calculated by following the next schedule: 7000m3 --> 230 EUR
			- Fixed tax of 10 EUR
			- First 1.000 m3 		→ 0,01 EUR / m3 1000 * 0.01 = 10
			- From 1.001 to 2.000	→ 0,02 EUR / m3 1000 * 0.02 = 20 
			- From 2.001 to 5.000	→ 0,03 EUR / m3 3000 * 0.03 = 90
			- More than 5.001		→ 0,05 EUR / m3 2000 * 0,05 = 100
	*/
	function calculate_bill( $units ) {
		$steps   = array( 0, 1000, 2000, 5000);
		$cost    = array( 0.01, 0.02, 0.03, 0.05 );
		$parcial = 0.00; 
		$bill    = 10.00; // Fixed tax
		
		// Explanation
		echo '<p>Fixed tax--> ' . $bill . '</p>';
		// check all steps, except the last one
		for ($i = 0; $i < sizeof($steps) - 1; $i++) {
			echo '<p>';
			echo $steps[$i] . '-' . $steps[$i+1] . ' (' . $cost[$i] . ') ';
			if ($units >= $steps[$i+1]) {
				$parcial = ( max( $steps[$i+1]-$steps[$i], $steps[$i+1]-$units ) * $cost[$i] );
			} elseif (($units ) >= $steps[$i]) {
				$parcial = ( ($units - $steps[$i]) * $cost[$i] );				
			} else {
				$parcial = 0.00; 
			}
			$bill = $bill + $parcial;
			echo '--> +' . $parcial . ' = ' . $bill;
			echo '</p>';
		}
		
		// check the last step
		if ($units > $steps[sizeof($steps) - 1]) {
			$parcial = (($units - $steps[sizeof($steps) - 1]) * $cost[sizeof($cost) - 1]); 
			$bill = $bill + $parcial;
		}
		
		echo '<p>' . '>' . $steps[sizeof($steps)-1] . ' (' . $cost[sizeof($cost)-1] . ') ' . '--> +' . $parcial . ' = ' . $bill . '</p>';
		
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

<!DOCTYPE html>
<html>
	<head>
		<title>PHP - Water service</title>
	</head>

	<body>
		<div id="page-wrap">
			<h1>Php - Water service</h1>

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