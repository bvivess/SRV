<!DOCTYPE html>

<head>
	<title>PHP - Simple Calculator Program </title>
</head>

    <?php

		$result = '';
		if (isset($_POST['first_num']) && isset($_POST['second_num']) && isset($_POST['operator']) && isset($_POST['result']))
		{
			$first_num = $_POST['first_num'];
			$second_num = $_POST['second_num'];
			$operator = $_POST['operator'];

			if (is_numeric($first_num) && is_numeric($second_num)) {
				switch ($operator) {
					case "Add":
					   $result = $first_num + $second_num;
						break;
					case "Subtract":
					   $result = $first_num - $second_num;
						break;
					case "Multiply":
						$result = $first_num * $second_num;
						break;
					case "Divide":
						try {
							if ($second_num == 0) {
								throw new Exception("Divide by zero exception!");
							} else if ($second_num < 0) {
								throw new Exception("Divide by negative number exception!");
							} else {
								$result = $first_num / $second_num;
							}
						} catch (Exception $ex) {
							echo "Exception--> " . $ex-> getMessage();
						} catch (Error $x) {
							echo "UNKNOWN ERROR!";
						}
					}		
				}
			}
	?>


	<body>
		<div>
			<h1>PHP - Simple Calculator Program</h1>
			<form action="" method="POST" id="quiz-form">
				<p>
					<input type="number" name="first_num" id="first_num" required="required" value="<?php echo $first_num; ?>" /> <b>First Number</b>
				</p>
				<p>
					<input type="number" name="second_num" id="second_num" required="required" value="<?php echo $second_num; ?>" /> <b>Second Number</b>
				</p>
				<p>
					<input readonly="readonly" name="result" value="<?php echo $result; ?>"/> <b>Result</b>
				</p>
				<input type="submit" name="operator" value="Add" />
				<input type="submit" name="operator" value="Subtract" />
				<input type="submit" name="operator" value="Multiply" />
				<input type="submit" name="operator" value="Divide" />
			</form>
		</div>
	</body>
	
</html>

