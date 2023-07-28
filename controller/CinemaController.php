<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    /* liste des films */
    public function listFilms(){
        ob_start(); // Début de la mise en tampon du contenu
        
        $pdo = Connect::seConnecter();
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
        
        
        $contenu = ob_get_clean(); // Récupérer le contenu mis en tampon

        return $contenu; // Nous renvoyons le contenu pour pouvoir l'utiliser ailleurs si nécessaire
    }
}

$ctrlCinema = new CinemaController();
$contenu = $ctrlCinema->listFilms(); // Ici, nous appelons la méthode listFilms() pour obtenir le contenu
echo $contenu; // Affiche le contenu ici, ou on peut l'insérer où on veux dans le index.php
?>
