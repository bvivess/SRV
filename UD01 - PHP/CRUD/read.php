<?php
	// Check existence of "id" parameter before processing further 
	// Check if "id" is not empty
	if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
		// Include config file
		require_once "config.php";
		$conn = null;
		
		try {
			$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
			
			// Prepare a select statement
			$stmt = "SELECT first_name, last_name, salary FROM employees WHERE employee_id = ?";
			
			$query = mysqli_prepare($conn, $stmt);
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($query, "i", $param_id);
			
			// Set parameters
			$param_id = trim($_GET["id"]);
			
			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($query)) {
				$result = mysqli_stmt_get_result($query);
		
				if(mysqli_num_rows($result) == 1){
					/* Fetch result row as an associative array. Since the result set
					contains only one row, we don't need to use while loop */
					$row = mysqli_fetch_array($result);
				} else{
					// URL doesn't contain valid "id" parameter. Redirect to error page
					header("location: error.php");
					exit();
				}
				
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
			
			// Close statement
			mysqli_stmt_close($query);
		} catch (mysqli_sql_exception $e) {
			echo  "</p>" . $e-> getMessage() . "</p>";
		} finally {
			try {
				// Close connection
				mysqli_close($conn);
			} catch (Exception $e) {
				// Nothing to do
			} catch (Error $e) {
				// Nothing to do
			}
		}
	} else{
		// URL doesn't contain id parameter. Redirect to error page
		header("location: error.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>View Record</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<style>
			.wrapper{
				width: 600px;
				margin: 0 auto;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
			<h1 class="mt-5 mb-3">View Record</h1>
			<div class="form-group">
				<label>First Name</label>
				<p><b><?php echo $row["first_name"]; ?></b></p>
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<p><b><?php echo $row["last_name"]; ?></b></p>
			</div>
			<div class="form-group">
				<label>Salary</label>
				<p><b><?php echo $row["salary"]; ?></b></p>
			</div>
			<p><a href="index.php" class="btn btn-primary">Back</a></p>
		</div>
		</div>        
		</div>
		</div>
	</body>
</html>