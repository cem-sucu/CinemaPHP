<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/listGenres.css">
    <title><?= $titre ?></title>
</head>
<body>
 
<div class="infos">
    <p>Il y a <?= count($genres) ?> genres de film</p>
</div>

<form action="" method="post">
    <label for="genreId"></label>
    <select name="genreId">
        <?php foreach($genres as $genre) { ?>
            <option value="<?= $genre['id_genre'] ?>"><?= $genre['genre'] ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Afficher les films du genre">
</form>

<?php if (isset($films)) { ?>
    <h2>Films du genre sélectionné :</h2>
    <ul class="listgenre">
        <?php foreach($films as $film) { ?>
            <li>
                <h3><?= $film['titre'] ?></h3>
                <!-- <p>Année de sortie : <?= $film['anneSortie'] ?></p>
                <p>Durée : <?= $film['duree'] ?> minutes</p>
                <p>Résumé : <?= $film['resume'] ?></p>
                <p>Réalisateur : <?= $film['realisateur'] ?></p>
                <p>Acteurs : <?= $film['acteurs'] ?></p>
                <p>Note : <?= $film['note'] ?></p> -->
                <img src="./public/img/<?= $film['affiche'] ?>" alt="<?= $film['titre'] ?>" width="100">
            </li>
        <?php } ?>
    </ul>
<?php } 


$titre = "Liste des films";
$titre_secondaire = "Liste des films";

$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";?>
</body>
</html>