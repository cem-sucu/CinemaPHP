<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./public/css/listFilms.css">
    <title><?= $titre ?></title>
</head>
<body>



<div class="infos">
    <h2><?= $titre_secondaire ?></h2>
    <p>Il y a <?= count($films) ?> films</p>
</div>

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE DE SORTIE</th>
            <th>DUREE</th>
            <th>REALISATEUR</th>
            <th>AFFICHAGE</th>
            <th>AJOUTER UN FILM<br>
                <a href="index.php?action=ajouterFilm">
                <i class="fa-regular fa-square-plus"></i>
                </a>
            </th>
            <!-- <th>CASTING</th> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach($films as $film) { ?>
            <tr>
                <td><?= $film["titre"] ?></td>
                <td><?= $film["anneSortie"] ?></td>
                <td><?= $film["duree"]." min"?></td>
                <td><?= $film["réalisateur"]?></td>
                <td><a href="index.php?action=detailsFilms&id"><img src="./public/img/<?= $film["affiche"] ?>" alt="<?= $film["titre"] ?>" width="100"></a></td>
                <td>
                        <a href="index.php?action=supprimerFilm&id=<?= $film['id_film'] ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php

$film = $requete->fetchAll();
$titre = "Liste des films";
$titre_secondaire = "Liste des films";

$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
    
</body>
</html>
