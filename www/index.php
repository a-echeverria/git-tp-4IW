<?php
function myAutoloader($class)
{
    $class = str_replace('TP\\', '', $class);
    $class = str_replace('\\', '/', $class);

    $path = $class.".php";
    if (file_exists($path)) {
        include $path;
    }
}

// Appel l'autoloader
spl_autoload_register("myAutoloader");
$uri = strtok($_SERVER["REQUEST_URI"], '?');
$listOfRoutes = yaml_parse_file("routes.yml");

if (!empty($listOfRoutes[$uri])) {
    // Recupere le controller et l'action sur laquelle la route pointe
    $c =  ucwords($listOfRoutes[$uri]["controller"]."Controller");
    $a =  $listOfRoutes[$uri]["action"]."Action";

    // Le chemin vers le controller
    $pathController = "Controllers/".$c.".php";

    // Verifie que le fichier existe sinon renvoie une exception
    if (file_exists($pathController)) {
        // L'inclus s'il existe
        include $pathController;
        //Vérifier que la class existe sinon renvoie une exception
        if (class_exists($c)) {
            // Crée une instance de la classe
            $controller = new $c();

            //Vérifier que la méthode existe sinon renvoie une exception
            if (method_exists($controller, $a)) {
                // Appelle la fonction défini dans le fichier route
                $controller->$a();
            } else {
                throw new Exception('L\'action n\'existe pas.');
            }
        } else {
            throw new Exception("La class controller n'existe pas" . $c);
        }
    } else {
        throw new Exception('Le fichier controller n\'existe pas.');
    }
} else {
    die("La route n'existe pas ! :/");
}