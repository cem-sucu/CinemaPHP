<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="?action=ajouterFilm" method="post">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required>

        <label for="anneSortie">Année de sortie :</label>
        <input type="number" name="anneSortie" id="anneSortie" required>

        <label for="duree">Durée (en minutes) :</label>
        <input type="number" name="duree" id="duree" required>

        <label for="realisateur_nom">Nom du réalisateur :</label>
        <input type="text" name="realisateur_nom" id="realisateur_nom" required>

        <label for="realisateur_prenom">Prénom du réalisateur :</label>
        <input type="text" name="realisateur_prenom" id="realisateur_prenom" required>

        <label for="affiche">Affiche (URL de l'image) :</label>
        <input type="text" name="affiche" id="affiche" required>

        <input type="submit" value="Ajouter">
    </form>

</body>
</html>