<?php 
	require_once __DIR__ . '/../includes/header.php';
	require_once __DIR__ . '/../includes/nav.php';

	require '../../../vendor/autoload.php';
	use Models\Employee;

	$employees = Employee::all();
?>

<div id="section">
	<h3>Employees</h3>
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

	<?php
		require_once __DIR__ . '/../includes/footer.php';
	?>
</div>


