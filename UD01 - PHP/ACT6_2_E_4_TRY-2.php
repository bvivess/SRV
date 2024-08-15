<!DOCTYPE html>
<html>
	<body>
		<h1>Control Structures</h1>

		<?php
			class myException extends OutofBoundsException {} // for example
			$var1 = 0;
			
			// Define an error handler
			set_error_handler(function ($err_severity, $err_msg) {
				switch ($err_severity) {
					case E_ERROR: 
					case E_USER_ERROR: 
						throw new Error('1-->'.$err_msg);
					case E_WARNING: 
					case E_USER_WARNING: 
						throw new Exception('2-->'.$err_msg);
					default:
						throw new Exception('3-->'.$err_msg);					
				}
			});

			/* Trigger exception */
			try
			{
				// try any of these statements separately
				
				// Catched by 'set_error_handler'
				//trigger_error("A trigger_error - USER_ERROR has been fired", E_USER_ERROR);
				//trigger_error("A trigger_error - USER_WARNING has been fired", E_USER_WARNING);
				//trigger_error("A trigger_error - default has been fired");

				// Catched directly
				//$var1 = 1 / "a";
				//$var1 = 1 / 0;
				//throw new myException("A 'myException' has been fired");
				throw new OutofBoundsException("An 'OutofBoundsException' has been fired");
				//throw new Exception("An 'Exception' has been fired");
				//throw new Error("An 'Error' has been fired");
			} catch(myException $e) {
				// Anything you want to do with $e
				echo "myException--> " . $e-> getMessage();
			} catch(OutofBoundsException $e) {
					echo "OutofBoundsException--> " . $e-> getMessage();
			} catch(Exception $e) {
				// Anything you want to do with $e
				echo "Exception--> " . $e-> getMessage();
			} catch(Error $e) {
				// Anything you want to do with $e
				echo "Error--> " . $e-> getMessage();
			}

		?>
	</body>
</html>