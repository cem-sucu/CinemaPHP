<?php
namespace Controller;
use Model\Connect;

class CinemaController {
    /* liste des films */
    public function listFilms(){
        ob_start(); // Début de la mise en tampon du contenu
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT f.id_film, f.titre, f.anneSortie, f.duree, f.affiche, p.nom AS réalisateur
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

    /*le détails des films */
    public function detailsFilms(){
        ob_start();
        $pdo = Connect::seConnecter();
        // details des films : la date, l'affiche, le nom prenom du realisateur, le resume, la duree la note, les acteurs

        $requete = $pdo->query("SELECT
        f.anneSortie AS date,
        f.affiche AS affiche,
        CONCAT(p.prenom, ' ', p.nom) AS realisateur,
        f.resume AS resume,
        f.duree,
        f.note AS note,
        GROUP_CONCAT(CONCAT(a.prenom, ' ', a.nom) SEPARATOR ', ') AS acteurs
    FROM film f
    INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
    INNER JOIN personne p ON r.id_personne = p.id_personne
    LEFT JOIN avoir av ON f.id_film = av.id_film
    LEFT JOIN acteur ac ON av.id_acteur = ac.id_acteur
    LEFT JOIN personne a ON ac.id_personne = a.id_personne
    GROUP BY f.id_film
    ORDER BY f.anneSortie DESC; ");
        $details = $requete->fetchAll(); // récupérer données sous forme de tableau toujours
        $titre = "Détails du film";
        $titre_secondaire = "Détails des films";
        require "view/detailsFilms.php";
    }

    /* liste des acteurs */
    public function listActeurs(){

        ob_start();
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT a.id_acteur, p.nom, p.prenom, p.dateNaissance, p.sexe
                                FROM acteur a
                                JOIN personne p ON a.id_personne = p.id_personne
                             ");
        $acteurs = $requete->fetchAll();
        $titre = "Liste des acteurs";
        $titre_secondaire = "Liste des acteurs";

        // Inclure la vue listActeurs.php et passer les données nécessaires
        require "view/listActeurs.php";

    }

    // list des réalisqateurs
    public function listRealisateurs(){
        ob_start();
        $pdo = Connect::SeConnecter();
        $requete = $pdo->query("SELECT r.id_realisateur, p.nom, p.prenom, p.dateNaissance, p.sexe
                                FROM realisateur r
                                INNER JOIN  personne p ON r.id_personne = p.id_personne
                             ");
        $realisateurs = $requete->fetchAll();
        $titre = "Liste des réalisateur";
        $titre_secondaire = "Liste des réalisateur";

        require "view/listRealisateurs.php";

    }

    /* liste des genrres */
    public function listGenres(){
        ob_start();
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT DISTINCT genre 
                                FROM genre
                            ");

        $genres = $requete->fetchAll();
        $titre = "Liste des genres";
        $titre_secondaire = "Liste des genres";

        // Inclure la vue listGenres.php et passer les données nécessaires
        require "view/listGenres.php";

        // Pas besoin d'utiliser ob_get_clean() ici, car nous ne faisons pas d'inclusion de vue directement dans cette méthode
        // Nous retournerons simplement les valeurs $genres, $titre et $titre_secondaire dans un tableau associatif
        
    }


}
?>
