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

if(isset($GET["action"])){
    switch ($_GET["action"]){
        case "listFilms" : $ctrlCinema->listFilms(); break;
        // case "listActeurs" : $ctrlCinema->listActeurs(); break;

    };
};


?>

