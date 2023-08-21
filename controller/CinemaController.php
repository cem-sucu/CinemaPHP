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

        // return $contenu; // Nous renvoyons le contenu pour pouvoir l'utiliser ailleurs si nécessaire
    }

    /*le détails des films */
    public function detailsFilms($id){
    ob_start(); // Début de la mise en tampon du contenu

    $id = (isset($_SESSION['lastInsertedFilmId'])) ? $_SESSION['lastInsertedFilmId'] : $_GET["id"];

    $pdo = Connect::seConnecter();
    $requete = $pdo->prepare(" SELECT
    f.titre, f.anneSortie,
    CONCAT(p.prenom, ' ', p.nom) AS realisateur,
    GROUP_CONCAT(DISTINCT CONCAT(a.prenom, ' ', a.nom) SEPARATOR ', ') AS acteurs,
    GROUP_CONCAT(DISTINCT r.role SEPARATOR ', ') AS roles,
    f.duree, f.resume, f.affiche, f.note
    FROM film f
    JOIN realisateur r1 ON f.id_realisateur = r1.id_realisateur
    JOIN personne p ON r1.id_personne = p.id_personne
    JOIN avoir av ON f.id_film = av.id_film
    JOIN acteur ac ON av.id_acteur = ac.id_acteur
    JOIN personne a ON ac.id_personne = a.id_personne
    JOIN avoir avr ON f.id_film = avr.id_film
    JOIN role r ON avr.id_role = r.id_role
    WHERE f.id_film = :id
    GROUP BY f.id_film;

    ");

    $requete->bindParam(':id', $id);
    $requete->execute();
    $details = $requete->fetch(); // Récupérer les données du film sous forme d'un tableau associatif

    $titre = "Détails du film : " . $details['titre'];
    $titre_secondaire = "Détails du film";

    unset($_SESSION['lastInsertedFilmId']);
    // inclue la vue detailsFilms.php
    require "view/detailsFilms.php";
    }


    /* liste des acteurs */
    public function listActeurs(){
        ob_start();
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT 
        a.id_acteur, p.nom, p.prenom, p.dateNaissance, p.sexe
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
        $requete = $pdo->query("SELECT
        r.id_realisateur, p.nom, p.prenom, p.dateNaissance, p.sexe
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

    public function genreFilms($id){
    ob_start();

    $pdo = Connect::seConnecter();
    $requete = $pdo->prepare("SELECT f.titre, f.anneSortie, f.duree, f.affiche, p.nom AS realisateur
    FROM film f
    INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
    INNER JOIN personne p ON r.id_personne = p.id_personne
    INNER JOIN posseder po ON f.id_film = po.id_film
    INNER JOIN genre g ON po.id_genre = g.id_genre
    WHERE g.id_genre = :id;
    ");

    $requete->bindParam(':id', $id);
    $requete->execute();
    $genreFilms = $requete->fetch();

    $titre = "Les films :";
    require "view/genreFilms.php";
    
    }


}
?>