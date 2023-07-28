<?php

echo "TEST";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Controller\CinemaController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        case "listFilms" : $contenu = $ctrlCinema->listFilms(); 
        break;
        case "listActeurs" : $contenu = $ctrlCinema->listActeurs(); 
        break;
        case "listRealisateurs" : $contenu = $ctrlCinema->listRealisateurs(); 
        break;
        default: $contenu = $ctrlCinema->listFilms(); // Définir une action par défaut au cas où l'action n'est pas spécifiée ou invalide
    }
}

// Maintenant, vous pouvez afficher le contenu
echo $contenu;


