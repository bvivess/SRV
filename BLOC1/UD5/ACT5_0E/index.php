<?php

	// Inclou l'autoload de Composer
	require 'vendor/autoload.php';

	// Importa la classe Carbon
	use Carbon\Carbon;
	use Faker\Factory;

	// Utilitza Carbon per mostrar la data actual
	$dataActual = Carbon::now();
	echo "Data actual: " . $dataActual->toDateTimeString() . "\n";

	// Exemple de manipulació de dates
	$dataFutura = $dataActual->addDays(10);
	echo "Data després de 10 dies: " . $dataFutura->toDateTimeString() . "\n";

	$dataPassada = $dataActual->subWeeks(2);
	echo "Data fa dues setmanes: " . $dataPassada->toDateTimeString() . "\n";
	
	echo "------------------------------------------------" . "\n";
	
	// Exemple d'utilització de 'Faker'
	$faker = Factory::create();
	echo "Nom de prova: " . $faker->name() . "\n";  // també '$faker->name'
	echo "Correu de prova: " . $faker->email . "\n"; 
	echo "Adreça de prova: " . $faker->address . "\n";
	echo "Text de prova: " . $faker->text . "\n";

?>