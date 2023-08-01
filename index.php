<?php

// echo "TEST"; // pour voir si tout marche si page blanche apparait

// permet d'affichee tout les erreur 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//importe la class controller
use Controller\CinemaController;
use Controller\ActionController;

// l'autoloader pour inclure autoimatiquement les fichier
spl_autoload_register(function ($class_name){
    include  $class_name . '.php';
});

// je creer une insatnce de la classe CinemaContrtoller
$ctrlCinema = new CinemaController();
$ctrlAction = new ActionController();

// Récupère la valeur du paramètre "id" dans l'URL s'il existe, sinon le définir à null
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

// Vérifie si le paramètre "action" existe dans l'URL
if(isset($_GET["action"])){
    switch ($_GET["action"]){
        // Si "action" est "listFilms": appelle la méthode listFilms() de CinemaController et stocke son résultat dans $contenu
        case "listFilms" : $contenu = $ctrlCinema->listFilms(); 
        break;
        // Si "action" est "listActeurs", : appelle la méthode listActeurs() de CinemaController et stocke son résultat dans $contenu
        case "listActeurs" : $contenu = $ctrlCinema->listActeurs(); 
        break;
        // Si "action" est "listRealisateurs" : appelle la méthode listRealisateurs() de CinemaController et stocke son résultat dans $contenu
        case "listRealisateurs" : $contenu = $ctrlCinema->listRealisateurs(); 
        break;
        case "listGenres" : $contenu = $ctrlCinema->listGenres();
        break;
        case "ajouterFilm":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $contenu = $ctrlAction->ajouterFilm();
            } else {
                // Afficher le formulaire pour ajouter un film (qui est déja dans le fichier "ajouterFilm.php")
                ob_start();
                require "view/ajouterFilm.php";
                $contenu = ob_get_clean();
            }
        break;
        case "supprimerFilm":
            //si film le id existe alors... on peux supprimer
            if (isset($_GET["idFilm"])) {
                $idFilmASupprimer = $_GET["idFilm"];
                // Appeler une méthode du contrôleur pour supprimer le film en utilisant l'ID du film
                $ctrlAction->supprimerFilm($idFilmASupprimer);
            }
            break;
        default: $contenu = $ctrlCinema->listFilms(); // Définir une action par défaut au cas où l'action n'est pas spécifiée ou invalide
    }
}

// afficher le contenu
echo $contenu;


