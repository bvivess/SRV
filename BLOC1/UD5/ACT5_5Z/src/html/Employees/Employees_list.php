<?php
	use models\Employee;

	require_once dirname(__DIR__, 3) . '/src/config/config.php';
	require_once BASE_PATH . '/vendor/autoload.php';

	$employees = Employee::all();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Human Resource</title>
		<link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>
			.wrapper {
				width: 600px;
				margin: 0 auto;
			}
			table tr td:last-child {
				width: 120px;
			}
		</style>
		<script>
			$(document).ready(function () {
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</head>
	<body>
		<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
		<div id="content">
			<?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
			<main id="section">
				<h3>Employees</h3>
				<a href="<?= BASE_URL ?>/src/html/employees/employee_new.php" class="btn btn-primary">
					<span class="fa fa-plus" aria-hidden="true"></span> New Employee
				</a>
				
				<table class="table table-bordered table-striped">
					<thead>
						<tr> <th>#</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Department</th>
							<th>Actions </th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($employees as $row) {
								echo 
									"<tr>" . 
										"<td>" . $row->employee_id     . "</td>" .
										"<td>" . $row->last_name       . "</td>" .
										"<td>" . $row->first_name      . "</td>" .
										"<td>" . $row->department_id   . "</td>" .
										"<td>" .
											'<a href="employee_read.php?id='   . $row->employee_id . '" class="mr-2" title="View File" data-toggle="tooltip"><span class="fa fa-eye"></span></a>'      . 
											'<a href="employee_update.php?id=' . $row->employee_id . '" class="mr-2" title="Update File" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>' .
											'<a href="employee_delete.php?id=' . $row->employee_id . '" class="mr-2" title="Delete File" data-toggle="tooltip"><span class="fa fa-trash"></span></a>'               .
										"</td>" .
									"</tr>";
							}
						?>
					</tbody> 
				</table>
			</main>
		</div>

		<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
	</body>
</html>