<!-- view/listActeurs.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>
<p>Il y a <?= count($acteurs) ?> acteurs</p>

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
            <?php foreach($acteurs as $acteur) { ?>
                <tr>
                    <td><?= $acteur["nom"] ?></td>
                    <td><?= $acteur["prenom"] ?></td>
                    <td><?= $acteur["dateNaissance"] ?></td>
                    <td><?= $acteur["sexe"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
<?php


$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteur";
$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon

require "./view/template.php";
?>
</html>
