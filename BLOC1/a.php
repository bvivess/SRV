<?php
	function gestorErrors($errno, $errstr, $errfile, $errline) {
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}
	
	set_error_handler("gestorErrors");

	try {
		//throw new Exception("S'ha produït una excepció");
		//trigger_error("S'ha produït un error"); 
		$a = 10/0;
	} catch (Error $e) {
		// 🔹 Mostra un missatge segur a l'usuari
		echo "S'ha produït un Error.<br>";
	} catch (Exception $e) {
		// 🔹 Mostra un missatge segur a l'usuari
		echo "S'ha produït una Exception.<br>";
	} finally {
		// 🔹 Registre complet al fitxer de log
		$logMessage = "[" . date('Y-m-d H:i:s') . "] "
					. $e->getMessage()
					. " in " . $e->getFile()
					. " on line " . $e->getLine() . PHP_EOL;

		error_log($logMessage, 3, __DIR__ . "/error_log.txt");
	}
?>