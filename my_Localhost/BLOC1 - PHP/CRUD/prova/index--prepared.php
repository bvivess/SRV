<html>
 <head>
  <title>Hello...</title>

  <meta charset="utf-8"> 

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
		<?php

			require 'db_init.php';
			require 'db_functions.php';
			$conn = null;
			
			try {	
				$conn = db_connect('localhost', 'HR', $username='hr', 'Educacio123!');
				echo '<p>Connection OK</p>';			
			} catch (mysqli_sql_exception $e) {
				$conn = null;
				die('Connection KO');
			} finally {
				
				// Show a result		
				$query = $conn->query('SELECT employee_id, last_name, first_name FROM employees ORDER BY employee_id');
				$table = $query->fetch_array();
				echo '<table class="table table-striped">';
				echo '<thead><tr><th>SEARCH</th><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th></tr></thead>';
				while ($table != null){
					echo '<tr>';
					echo '<td><a href="modificar_pantalla.php?employee_id='.$table['employee_id'].'?first_name='.$table['first_name'].'?last_name='.$table['last_name'].
					'"><span class="glyphicon glyphicon-search"></span></a></td>';
						
					echo '<td>' . $table['employee_id']."</td><td>".$table['last_name']."</td><td>".$table['first_name']. '</td>';;
					//echo $table[0]." ".$table[1]." ".$table[2]."<br>";
					echo '</tr>';
					$table = $query->fetch_array();
				}
				echo '</table>';

				$conn->close();
			}
		?>
    </div>
</body>
</html>
http://localhost/CRUD/modificar_pantalla.php?employee_id%20=%20100%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20?first_name%20%20=%20Steven
