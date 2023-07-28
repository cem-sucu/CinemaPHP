<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    public function showPage($action){
        ob_start(); // Début de la mise en tampon du contenu
        
        $pdo = Connect::seConnecter();

        if ($action === 'listFilms') {
            $requete = $pdo->query(" SELECT f.titre, f.anneSortie, f.durée, f.affiche, p.nom AS réalisateur
                                    FROM film f
                                    INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
                                    INNER JOIN personne p ON r.id_personne = p.id_personne
                                ");
            $films = $requete->fetchAll(); // Récupérer les données sous forme d'un tableau associatif
            $titre = "Liste des films";
            $titre_secondaire = "Liste des films";

            // Inclure la vue listFilms.php et passer les données nécessaires
            require "view/listFilms.php";
        } elseif ($action === 'listActeurs') {
            $requete = $pdo->query(" SELECT a.id_acteur, p.nom, p.prenom, p.dateNaissance, p.sexe
                                    FROM acteur a
                                    JOIN personne p ON a.id_personne = p.id_personne
                                ");
            $acteurs = $requete->fetchAll();
            $titre = "Liste des acteurs";
            $titre_secondaire = "Liste des acteurs";

            // Inclure la vue listActeurs.php et passer les données nécessaires
            require "view/listActeurs.php";
        } else {
            // Si l'action n'est pas reconnue, afficher une page d'erreur ou rediriger vers une page par défaut
            // ...
        }
        
        $contenu = ob_get_clean(); // Récupérer le contenu mis en tampon

        return $contenu; // Nous renvoyons le contenu pour pouvoir l'utiliser ailleurs si nécessaire
    }
}



spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$action = isset($_GET["action"]) ? $_GET["action"] : null;
$contenu = $ctrlCinema->showPage($action); // Affiche la vue en fonction de l'action
echo $contenu; // Affiche le contenu ici, ou on peut l'insérer où on veut dans le fichier d'affichage
?>
