<?php

namespace Controller;

use Model\Connect;

class ActionController {
    public function ajouterFilm(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Récupérer les données du formulaire
            $titre = $_POST["titre"];
            $anneSortie = $_POST["anneSortie"];
            $duree = $_POST["duree"];
            $realisateur_nom = $_POST["realisateur_nom"];
            $realisateur_prenom = $_POST["realisateur_prenom"];
            $affiche = $_POST["affiche"];
    
            // Insérer le nouveau film dans la base de données
            $pdo = Connect::seConnecter();
            if($pdo){
                // Vérifier si le réalisateur existe déjà dans la base de données
                $requete_select_realisateur = $pdo->prepare("SELECT id_realisateur FROM realisateur WHERE nom = ? AND prenom = ?");
                $requete_select_realisateur->execute([$realisateur_nom, $realisateur_prenom]);
                $realisateur = $requete_select_realisateur->fetch();
    
                // Si le réalisateur n'existe pas dans la base de données, l'ajouter
                if(!$realisateur){
                    $requete_insert_realisateur = $pdo->prepare("INSERT INTO personne (nom, prenom) VALUES (?, ?)");
                    $requete_insert_realisateur->execute([$realisateur_nom, $realisateur_prenom]);
                    $id_realisateur = $pdo->lastInsertId();
                } else {
                    $id_realisateur = $realisateur["id_realisateur"];
                }
    
                // Insérer le nouveau film en utilisant l'identifiant du réalisateur
                $requete_insert_film = $pdo->prepare("INSERT INTO film (titre, anneSortie, durée, id_realisateur, affiche) 
                                         VALUES (?, ?, ?, ?, ?)");
                $requete_insert_film->execute([$titre, $anneSortie, $duree, $id_realisateur, $affiche]);

                // Rediriger vers la page de liste des films après l'ajout
                header("Location: ?action=listFilms");
                exit; // Ajoutez cette ligne pour terminer l'exécution du script après la redirection
            }
        }
    
        // Si la méthode HTTP est GET, alors on affiche le formulaire d'ajout
        ob_start();
        require "view/ajouterFilm.php";
        $contenu = ob_get_clean();
        return $contenu;
    }
}




?>