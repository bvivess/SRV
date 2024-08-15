<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dashboard</title>
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
		<div class="wrapper">
			<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
			<div class="mt-5 mb-3 clearfix">
				<h2 class="pull-left">Employees Details</h2>
				<a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
			</div>
			<?php
				// Include config file
				require_once "config.php";
				$conn = null;
				
				try {
					/* Attempt to connect to MySQL database */
					$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
					mysqli_autocommit($conn, true);
					
					// Attempt select query execution
					$query = "SELECT employee_id, first_name, last_name, department_name FROM departments d, employees e WHERE d.department_id = e.employee_id ORDER BY 1";
					$table = mysqli_query($conn, $query);
					if (mysqli_num_rows($table) > 0) {
						echo '<table class="table table-bordered table-striped">';
							echo 
								"<thead>" .
									"<tr>" . 
										"<th>#</th>"          .
										"<th>Last Name</th>"  .
										"<th>First Name</th>" .
										"<th>Department</th>" .
										"<th>Action</th>"     .
									"</tr>" .
								"</thead>";
							echo "<tbody>";
								while(null !== ($row = mysqli_fetch_array($table))) {
									echo 
										"<tr>" . 
											"<td>" . $row['employee_id']     . "</td>" .
											"<td>" . $row['last_name']       . "</td>" .
											"<td>" . $row['first_name']      . "</td>" .
											"<td>" . $row['department_name'] . "</td>" .
											"<td>" .
												'<a href="read.php?id='   . $row['employee_id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>'      . 
												'<a href="update.php?id=' . $row['employee_id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>' .
												'<a href="delete.php?id=' . $row['employee_id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>'               .
											"</td>" .
										"</tr>";
								}
							echo "</tbody>";                            
						echo "</table>";
							
						// Free result set
						mysqli_free_result($table);
					} else{
						echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
					}
				} catch (mysqli_sql_exception $e) {
					echo  "</p>" . $e-> getMessage() . "</p>";
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
			</div>
			</div>        
			</div>
		</div>
	</body>
</html>