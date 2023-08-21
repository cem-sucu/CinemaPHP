<?php

namespace Controller;

use Model\Connect;

class ActionController {
    public function ajouterFilm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $titre = $_POST['titre'];
            $anneeSortie = $_POST['anneeSortie'];
            $duree = $_POST['duree'];
            $resume = $_POST['resume'];
            $note = $_POST['note'];
            $realisateurId = $_POST['realisateurId'];
            $genreId = $_POST['genreId'];
            $acteurIds = $_POST['acteurIds'];
            $roleId = $_POST['roleId'];
    
            $bdd = Connect::seConnecter();
    
            if (!$bdd) {
                echo "Erreur de connexion à la base de données.";
                exit;
            }
    
            try {
                $bdd->beginTransaction(); // Début de la transaction
    
            // Gérer le téléchargement de l'affiche
            if (isset($_FILES['affiche']) && $_FILES['affiche']['error'] === 0) {
                $affiche_tmp = $_FILES['affiche']['tmp_name'];
                $affiche_nom = $_FILES['affiche']['name'];
                $affiche_destination = './public/img/'  . $affiche_nom;

                // Déplacer le fichier
                if (move_uploaded_file($affiche_tmp, $affiche_destination)) {
                    echo "Le fichier a été téléchargé avec succès et déplacé vers le dossier de destination.";
                } else {
                    echo "Erreur lors du téléchargement de l'affiche.";
                }
                } else {
                    echo "Erreur : aucun fichier d'affiche téléchargé.";
                }
            
                // Requête INSERT INTO pour ajout film
                $requeteFilm = $bdd->prepare('INSERT INTO film (titre, anneSortie, duree, resume, affiche, note, id_realisateur) VALUES (:titre, :anneeSortie, :duree, :resume, :affiche, :note, :realisateurId)');
                $requeteFilm->bindValue(':titre', $titre);
                $requeteFilm->bindValue(':anneeSortie', $anneeSortie);
                $requeteFilm->bindValue(':duree', $duree);
                $requeteFilm->bindValue(':resume', $resume);
                $requeteFilm->bindValue(':affiche', $affiche_nom);
                $requeteFilm->bindValue(':note', $note);
                $requeteFilm->bindValue(':realisateurId', $realisateurId);
                $requeteFilm->execute();
    
                $filmId = $bdd->lastInsertId(); // Récupération de l'ID du film inséré
    
                // Requête INSERT INTO pour ajout genre du film (table posseder de bdd)
                $requeteGenre = $bdd->prepare('INSERT INTO posseder (id_film, id_genre) VALUES (:filmId, :genreId)');
                $requeteGenre->bindValue(':filmId', $filmId);
                $requeteGenre->bindValue(':genreId', $genreId);
                $requeteGenre->execute();
    
                // Requête INSERT INTO pour ajouter les acteurs du film (table avoir de la bdd)
                foreach ($acteurIds as $acteurId) {
                    $requeteActeur = $bdd->prepare('INSERT INTO avoir (id_film, id_acteur, id_role) VALUES (:filmId, :acteurId, :roleId)');
                    $requeteActeur->bindValue(':filmId', $filmId);
                    $requeteActeur->bindValue(':acteurId', $acteurId);
                    $requeteActeur->bindValue(':roleId', $roleId);
                    $requeteActeur->execute();
                }
    
                $bdd->commit(); // et ensuite validation de la transaction
                echo "Le film a été ajouté avec succès ! ";
                header("Refresh: 1; url=index.php?action=detailsFilms&id=".$filmId);
                exit;
            } catch (\Exception $e) {
                $bdd->rollBack(); // En cas d'erreur, pouer annuler la transaction
                echo "Erreur lors de l'ajout du film : " . $e->getMessage();
            }
        } else {
            ob_start();
            require "view/ajouterFilm.php";
            // $contenu = ob_get_clean();
        }
    }
    

    public function supprimerFilm($id)
    {   
        $bdd = Connect::seConnecter(); // Obtenir une instance de PDO

        // Vérifier si la connexion à la base de données a réussi
        if (!$bdd) {
            echo "Erreur de connexion à la base de données.";
            exit;
        }

        try {
            $bdd->beginTransaction(); // Début de la transaction

            // Supprimer les enregistrements liés dans la table "avoir" d'abord
            $requeteSupprimerAvoir = $bdd->prepare('DELETE FROM avoir WHERE id_film = :id');
            $requeteSupprimerAvoir->bindParam(':id', $id);
            $requeteSupprimerAvoir->execute();

            // Supprimer les enregistrements liés dans la table "posseder" d'abord
            $requeteSupprimerPosseder = $bdd->prepare('DELETE FROM posseder WHERE id_film = :id');
            $requeteSupprimerPosseder->bindParam(':id', $id);
            $requeteSupprimerPosseder->execute();

            // Supprimer le film de la table "film"
            $requeteSupprimerFilm = $bdd->prepare('DELETE FROM film WHERE id_film = :id');
            $requeteSupprimerFilm->bindParam(':id', $id);
            $requeteSupprimerFilm->execute();

            $bdd->commit(); // Validation de la transaction
            echo "Le film a été supprimé avec succès!";
            header("Refresh: 1; url=index.php?action=listFilms"); // Rediriger après 1 seconde vers la liste des films
            exit; // Quitter le script
        } catch (\Exception $e) {
            $bdd->rollBack(); // En cas d'erreur, pour annuler la transaction
            echo "Erreur lors de la suppression du film : " . $e->getMessage();
        }
    }






}




?>
