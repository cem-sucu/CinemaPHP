<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../public/css/listFilms.css"> -->
    <title><?= $titre ?></title>
</head>
<body>



<!-- view/listFilms.php -->
<p>Il y a <?= count($films) ?> films</p>

<h2><?= $titre_secondaire ?></h2>

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE DE SORTIE</th>
            <th>DUREE</th>
            <th>REALISATEUR</th>
            <th>AFFICHAGE</th>
            <!-- <th>CASTING</th> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach($films as $film) { ?>
            <tr>
                <td><?= $film["titre"] ?></td>
                <td><?= $film["anneSortie"] ?></td>
                <td><?= $film["durée"]." min"?></td>
                <td><?= $film["réalisateur"]?></td>
                <td><img src="./public/img/<?= $film["affiche"] ?>" alt="<?= $film["titre"] ?>" width="100"></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php


$titre = "Liste des films";
$titre_secondaire = "Liste des films";

$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
    
</body>
</html>
