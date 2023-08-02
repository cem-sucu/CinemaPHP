<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>
<h2><?= $titre_secondaire ?></h2>

<p>il y a <?= count($details)?></p>
<table>
    <thead>
        <tr>
            <th>Affiche</th>
            <th>Sortie</th>
            <th>Realisateur</th>
            <th>Resume</th>
            <th>Note</th>
            <th>Duree</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($details as $detail) { ?>
            <tr>
                <td><?= $detail['affiche'] ?></td>
                <td><?= $detail['date'] ?></td>
                <td><?= $detail['realisateur']?></td>
                <td><?= $detail['resume']?></td>
                <td><?= $detail['note']?></td>
                <td><?= $detail['duree']?></td>
                
            </tr>


        <?php } ?>
    </tbody>
</table>

</body>


<?php 
$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
</html>

<?php 
        // f.anneSortie AS date
        // f.affiche AS affiche,
        // CONCAT(p.prenom, ' ', p.nom) AS realisateur,
        // f.resume AS resume,
        // f.durée AS duree,
        // f.note AS note
?>