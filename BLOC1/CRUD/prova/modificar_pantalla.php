<!DOCTYPE html>
<html>
	<head>
		<title>Hello...</title>

		<meta charset="utf-8"> 

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
<body>
		<h1>Exemple CRUD</h1>

		<h2>Inserir/modificar un client</h2>
		<form action="crud.php" method="POST">
			<input  name="id" value="<?php echo $_GET[$employee_id]; ?>" >
			<label>ID:</label><br>
			<input name="dep_id" value=" "><br>
			<label>Department:</label><br>
			<input name="dep_name" value=" "><br>
			<input type="submit">
		</form>

		<table>
			<caption> CLIENTS </caption>
			<thead>
				<tr>
					<th>ID</th>
					<th>nom</th>
					<th>Llinatges</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</body>
</html>