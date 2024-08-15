<html>
 <head>
  <title>Helaalo...</title>

  <meta charset="utf-8"> 

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
		<h1>Hi! I'm happy</h1>

		<?php
			// Set MySQLi to throw exceptions
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);	
			try {
				$host='localhost';
				$dbname='myDb';
				$username='user';
				$passwd='test';
				$conn = null;
				// Try a connection ...
				echo 'Conexión a la base de datos: '.$username.'/'.$passwd.'@'.$dbname.'<br /><br />';
				$conn = mysqli_connect('db', $username, $passwd, $dbname);
				echo '<h4>Conexión con éxito</h4> <br />';                
			} catch (mysqli_sql_exception $e) {
				$conn = null;
				die("Unfortunately, the details you entered for connection are incorrect!");
			} finally {
				$query = 'SELECT * FROM Person';
				$result = mysqli_query($conn, $query);

				if ($result) {
				echo '<table class="table table-striped">';
				echo '<thead><tr><th>SEARCH</th><th>ID</th><th>NAME</th></tr></thead>';
				while($value = $result->fetch_array(MYSQLI_ASSOC)){
				echo '<tr>';
				echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
				foreach($value as $element){
				echo '<td>' . $element . '</td>';
				}

				echo '</tr>';
				}
				echo '</table>';
				}
				else {
				echo 'Error al hacer la consulta ('.mysqli_sqlstate($connection).'):'.mysqli_error($connection);
				}

				/* Libération du jeu de résultats */
				$result->close();

				mysqli_close($conn);
			}
		?>
    </div>
</body>
</html>
