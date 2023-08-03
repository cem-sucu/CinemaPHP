<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/template.css">
    <title><?= $titre ?></title>
</head>
<body>
<h2><?= $titre_secondaire ?></h2>

<h3><?= $details["titre"] ?></h3>

<div class="content">
    <p>Année de sortie : <?= $details["anneSortie"] ?></p>
    <p>Durée : <?= $details["duree"] ?> min</p>
    <p>Réalisateur : <?= $details["realisateur"] ?></p>
    <img src="./public/img/<?= $details["affiche"] ?>" alt="<?= $details["titre"] ?>" width="100">
</div>

</body>


<?php 
$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
</html>