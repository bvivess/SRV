<?php

	// Inclou l'autoload de Composer
	require 'vendor/autoload.php';

	// Importa la classe Carbon
	use Carbon\Carbon;
	use Faker\Factory;

	// Utilitza Carbon per mostrar la data actual
	$dataActual = Carbon::now();
	echo "Data actual: " . $dataActual->toDateTimeString() . "<br>";

	// Exemple de manipulació de dates
	$dataFutura = $dataActual->addDays(10);
	echo "Data després de 10 dies: " . $dataFutura->toDateTimeString() . "<br>";

	$dataPassada = $dataActual->subWeeks(2);
	echo "Data fa dues setmanes: " . $dataPassada->toDateTimeString() . "<br>";
	
	echo "------------------------------------------------" . "<br>";
	
	// Exemple d'utilització de 'Faker'
	$faker = Factory::create();
	echo "Nom de prova: " . $faker->name() . "<br>";  // també '$faker->name'
	echo "Correu de prova: " . $faker->email . "<br>"; 
	echo "Adreça de prova: " . $faker->address . "<br>";
	echo "Text de prova: " . $faker->text . "<br>";

?>