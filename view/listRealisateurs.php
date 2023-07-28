<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>
   
<p>Il y a <?= count($realisateurs) ?> films</p>
<h2><?= $titre_secondaire ?></h2>

<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>DATE DE NAISSANCE</th>
            <th>SEXE</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($realisateurs as $realisateur) { ?>
                <tr>
                    <td><?= $realisateur["nom"] ?></td>
                    <td><?= $realisateur["prenom"] ?></td>
                    <td><?= $realisateur["dateNaissance"] ?></td>
                    <td><?= $realisateur["sexe"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>
<?php


$titre = "Liste des réalisateur";
$titre_secondaire = "Liste des réalisateur";

$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
</body>
</html>