<?php
	// Include config file
	require_once "config.php";
	$conn = null;
	$p_ID = $p_last_name = $p_first_name = "";
	$p_department = 80;
	$p_job_id = 'IT_PROG';
	$p_salary = "1";
	$text_err = "Please enter a text.";
	
	try {
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$p_ID = trim($_POST["id"]);
			$p_last_name = trim($_POST["last_name"]);
			$p_first_name = trim($_POST["first_name"]);
			$p_job_id = trim($_POST["job_id"]);
			$p_salary = trim($_POST["salary"]);
			
			/* Attempt to connect to MySQL database */
			$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
			mysqli_autocommit($conn, true);
			
			// Attempt select query execution
			$query = "INSERT INTO employees ( employee_id, first_name, last_name, job_id, department_id, salary )
					  VALUES( " . $p_ID . ", '" . $p_first_name ."','" . $p_last_name ."','" . $p_job_id . "'," . $p_department . "," . $p_salary .")";
			$table = mysqli_query($conn, $query);
			// mysqli_commit($conn);

		}
	} catch (mysqli_sql_exception $e) {
		echo  "</p> ERROR:" . $e-> getMessage() . "</p>";
	} catch (Exception $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
	} catch (Error $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
	} finally {
		try {
			mysqli_close($conn);
		} catch (Exception $e) {
			// Nothing to do
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="estils.css">
		<title>Human Resource</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>
			.wrapper{
				width: 600px;
				margin: 0 auto;
			}
			table tr td:last-child{
				width: 120px;
			}
		</style>
		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
	</head>
	<body>
		<div id="header">
			<h1>HR & OE Management</h1>
		</div>
		<div id="content">
			<div id="menu">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li>
						<ul> HR
							<li><a href="employees.php">Employees</a></li>
							<li><a href="departments.php">Departments</a></li>
							<li><a href="jobs.php">Jobs</a></li>
							<li><a href="locations.php">Locations</a></li>
						</ul>
					</li>
					<li>
						<ul> OE
							<li><a href="warehouses.php">Warehouses</a></li>
							<li><a href="categories.php">Categories</a></li>
							<li><a href="customers.php">Customers</a></li>
							<li><a href="products.php">Products</a></li>
							<li><a href="orders.php">Orders</a></li>
						</ul>
					</li>
				</ul>
			</div>

			<div id="section">
				<h3>Employees</h3>
			
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id" class="form-control " value="<?php echo $p_ID; ?>">
                            <span class="invalid-feedback"><?php echo $text_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control " value="<?php echo $p_first_name; ?>">
                            <span class="invalid-feedback"><?php echo $text_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control " value="<?php echo $p_last_name; ?>">
                            <span class="invalid-feedback"><?php echo $text_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Job ID</label>
                            <input type="text" name="job_id" class="form-control " value="<?php echo $p_job_id; ?>">
                            <span class="invalid-feedback"><?php echo $text_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control " value="<?php echo $p_salary; ?>">
                            <span class="invalid-feedback"><?php echo $text_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employees.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>

			</div>
		</div>

		<div id="footer">
            <p>(c) IES Emili Darder - 2022</p>
		</div>
	</body>
</html>

