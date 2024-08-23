<?php

    // // Incloure els arxius manualment (en la pràctica,emprar 'autoloader')
    //require_once('Figures/Base/FiguraGeometrica.php');
    //require_once('Figures/Concretes/Circulo.php');
    //require_once('Figures/Concretes/Rectangulo.php');
    //require_once('Figures/Concretes/Triangulo.php');

    // Emprar les classes del 'namespace' 'Figures\Concretes'
    use Figures\Concretes\Cercle;
    use Figures\Concretes\Rectangle;
    use Figures\Concretes\Quadrat;

    spl_autoload_register(function($classe) {
        if (file_exists(str_replace('\\','/',$classe) . '.php'))
            require_once (str_replace('\\','/',$classe) . '.php');

    });

    // Crear instàncias de les figures geomètriques
    $cercle = new Cercle(5);
    $rectangle = new Rectangle(4, 6);
    $quadrat = new Quadrat(4);

    // Calcular i mostrar l'àrea de cada figura
    echo "Área del círculo: " . $cercle->calcularArea() . "<br>";
    echo "Área del rectángulo: " . $rectangle->calcularArea() . "<br>";
    echo "Área del triángulo: " . $quadrat->calcularArea() . "<br>";
?>