<!DOCTYPE html>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style>

		#loading-img{
			display:none;
		}

		.response_msg{
			margin-top:10px;
			font-size:13px;
			background:#E5D669;
			color:#ffffff;
			width:250px;
			padding:3px;
			display:none;
		}

		</style>
	</head>
	
	<?php
		// Define handler
		set_error_handler(function ($err_severity, $err_msg) {
			switch ($err_severity) {
				case E_ERROR:
				case E_USER_ERROR:
				case E_WARNING:
				case E_USER_WARNING:
					throw new Exception($err_msg);
				default:
					throw new Error($err_msg);					
			}
		});
		
		// Connection data
		DEFINE('HOST','localhost');
		DEFINE('DBNAME','HR');
		DEFINE('USERNAME','HR');
		DEFINE('PASSWD','Educacio123!');
		$conn = null;
		
		// Create connection
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);	
		try {
			// Try a connection ...
			$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
			echo '<p>Connection OK</p>';

			// sql to create table
			$sql = "CREATE TABLE IF NOT EXISTS contact_data (
						id 			INT(6) UNSIGNED AUTO_INCREMENT,
						name 		VARCHAR(30) NOT NULL,
						email		VARCHAR(30) NOT NULL,
						phone		VARCHAR (15),
						comments	VARCHAR(50),
						reg_date	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						CONSTRAINT contact_data PRIMARY KEY cd_PK( id )
					)";

			if ($conn->query($sql) === TRUE) {
				echo "Table contact_form_info created successfully<br>";
			} else {
				echo "Error creating table: " . $conn->error;
			}

			if ((isset($_POST['your_name'])&& $_POST['your_name'] !='') && (isset($_POST['your_email'])&& $_POST['your_email'] !='')) {
				$yourName = $conn->real_escape_string($_POST['your_name']);
				$yourEmail = $conn->real_escape_string($_POST['your_email']);
				$yourPhone = $conn->real_escape_string($_POST['your_phone']);
				$comments = $conn->real_escape_string($_POST['comments']);

				$sql="INSERT INTO contact_data (name, email, phone, comments) 
					  VALUES ('".$yourName."','".$yourEmail."', '".$yourPhone."', '".$comments."')";

				if (!$result = $conn->query($sql)) {
					die('There was an error running the query [' . $conn->error . ']');
				} else {
					echo "Thank you! We will contact you soon";
				}
			} else {
				echo "Please fill Name and Email";
			}
		} catch (mysqli_sql_exception $e) {
			echo "</p>" . $e-> getMessage() . "</p>";
		} catch (Exception $e) {
			echo "</p>" . $e-> getMessage() . "</p>";
		} catch (Error $e) {
			echo "</p>" . $e-> getMessage() . "</p>";
		} finally {
			try {
				$conn->close();
			} catch (Exception $e) {
				// Nothing to do
			} catch (Error $e) {
				// Nothing to do
			}
		}
	?>

	<body>
		<div class="container">
		<div class="row">
		<div class="col-md-8">
			<h1><width="80px">Easy Contact Form With MySQL</h1>
			<form name="contact-form" action="" method="post" id="contact-form">
				<div class="form-group">
					<input type="text" class="form-control" name="your_name" placeholder="Name" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control" name="your_email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label for="Phone">Phone</label>
					<input type="text" class="form-control" name="your_phone" placeholder="Phone" required>
				</div>
				<div class="form-group">
					<label for="comments">Comments</label>
					<textarea name="comments" class="form-control" rows="3" cols="28" rows="5" placeholder="Comments"></textarea> 
				</div>
				<button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Submit</button>
			</form>
		</div>
		</div>
		</div>
	</body>
</html>