<?php
	require 'db_init.php';
	require 'db_functions.php';
	$conn = null;

	try {
		$conn = db_connect('localhost', 'HR', 'hr', 'Educacio123!');
		echo '<p>Connection OK</p>';

	----------------
		$nom = $_POST['nom'];
		$llinatges = $_POST['llinatges'];
		if($nom!="" and $llinatges!=""){
		  $query="INSERT INTO client (nom,llinatges) VALUES (\"$nom\", \"$llinatges\")";
		  $res=$conn->query($query);
		  echo "S'han inserit ".$conn->affected_rows." registres correctament.";
		}
	------------------------  
  
	} catch (Exception $e) {
		echo "ko";
	} finally {
		if (!is_null($conn)) {
			echo "Closing Database";
			mysqli_close($conn);
		}
	}
?>