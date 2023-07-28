<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>
 
<p>Il y a <?= count($genres) ?> films</p>

<h2><?= $titre_secondaire ?></h2>

<ul>
    <?php foreach($genres as $genre) { ?>
        <li><?= $genre["genre"] ?></li>
    <?php } ?>
</ul>

<?php
$titre = "Liste des réalisateur";
$titre_secondaire = "Liste des réalisateur";

$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
</body>
</html>