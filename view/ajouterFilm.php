<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/ajouterFilm.css">
    <title>Document</title>
</head>
<body>
    
<button class="retour"><a href="index.php?action=listFilms">Retour</button>

<form action="?action=ajouterFilm" method="post">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" required>
        <br>
        <label for="anneeSortie">Année de sortie :</label>
        <input type="date" name="anneeSortie" required>
        <br>
        <label for="duree">Durée :</label>
        <input type="number" name="duree" required>
        <br>
        <label for="resume">Résumé :</label>
        <input type="text" name="resume" required>
        <br>
        <label for="affiche">Affiche (urrl):</label>
        <input type="text" name="affiche" required>
        <br>
        <label for="note">Note :</label>
        <input type="number" name="note" required>
        <br>
        <label for="realisateurId">ID du réalisateur :</label>
        <input type="number" name="realisateurId" required>
        <br>
        <input type="submit" value="Ajouter le film">
    </form>

</body>
</html>