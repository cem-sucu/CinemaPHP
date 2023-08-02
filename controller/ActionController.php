<?php

namespace Controller;

use Model\Connect;

class ActionController {
    public function ajouterFilm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $anneeSortie = $_POST['anneeSortie'];
            $duree = $_POST['duree'];
            $resume = $_POST['resume'];
            $affiche = $_POST['affiche'];
            $note = $_POST['note'];
            $realisateurId = $_POST['realisateurId'];

            $bdd = Connect::seConnecter(); // Obtenir une instance de PDO

            // si pas bdd afficher une erreur .
            if (!$bdd) {
                echo "Erreur de connexion à la base de données.";
                exit;
            }

            // Requête INSERT INTO
            $requete = $bdd->prepare('INSERT INTO film (titre, anneSortie, durée, resume, affiche, note, id_realisateur) VALUES (:titre, :anneeSortie, :duree, :resume, :affiche, :note, :realisateurId)');
            $requete->bindParam(':titre', $titre);
            $requete->bindParam(':anneeSortie', $anneeSortie);
            $requete->bindParam(':duree', $duree);
            $requete->bindValue(':resume', $resume);
            $requete->bindParam(':affiche', $affiche);
            $requete->bindValue(':note', $note);
            $requete->bindParam(':realisateurId', $realisateurId);

            if ($requete->execute()) {
                ob_start();
                echo "Le film a été ajouté avec succès!";
                ob_end_flush();
                header("Refresh: 3; url=index.php?action=listFilms"); //une fois le message succés affiché nous redirige dans 3 secondes a listFilm
                exit; // on quitte le script
            } else {
                echo "Erreur lors de l'ajout du film.";
            }
        } else {
            ob_start();
            require "view/ajouterFilm.php";
            // $contenu = ob_get_clean();

        }
    }

    public function supprimerFilm($id)
    {   
        $_GET["id"];
        $bdd = Connect::seConnecter(); // Obtenir une instance de PDO

        // Vérifier si la connexion à la base de données a réussi
        if (!$bdd) {
            echo "Erreur de connexion à la base de données.";
            exit;
        }

        // Requête DELETE FROM
        $requete = $bdd->prepare('DELETE FROM film WHERE id_film = :id');
        $requete->bindParam(':id', $id);

        if ($requete->execute()) {
            ob_start();
            echo "Le film a été supprimé avec succès!";
            ob_end_flush();
            header("Refresh: 3; url=index.php?action=listFilms"); // Rediriger après 3 secondes vers la liste des films
            exit; // Quitter le script
        } else {
            echo "Erreur lors de la suppression du film.";
        }
    }
}




?>
