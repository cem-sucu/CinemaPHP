<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/ajouterFilm.css">
    <link rel="stylesheet" href="./public/mobile/ajouterFilm.css">
    <title>Document</title>
</head>
<body>
    
<!-- <button class="retour"><a href="index.php?action=listFilms">Retour</button> -->

<form action="?action=ajouterFilm" method="post" enctype="multipart/form-data">
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
    <label for="affiche">Affiche :</label>
    <input type="file" name="affiche" required>
    <br>
    <label for="note">Note :</label>
    <input type="number" name="note" required>
    <br>
    <label for="realisateurId">ID du réalisateur :</label>
    <input type="number" name="realisateurId" required>
    <br>
    <label for="genreId">Genre :</label>
    <select name="genreId" required>
        <option value="">Sélectionner un genre</option>
        <option value="1">Fantastique</option>
        <option value="2">Action</option>
        <option value="3">Aventure</option>
    </select>
    <br>
    <label for="acteurIds[]">Acteurs :</label>
    <select name="acteurIds[]" multiple required>
        <option value="1">Johnny Depp</option>
        <option value="2">Jason Statham</option>
        <option value="3">Emma Watson</option>
        
    </select>
    <br>
    <label for="roleId">Rôle des acteurs :</label>
    <select name="roleId" required>
        <option value="">Sélectionner un rôle</option>
        <option value="1">Jack Sparrow</option>
        <option value="2">Frank Martin</option>
        <option value="3">Hermione Granger</option>
    </select>
    <br>
    <input type="submit" value="Ajouter le film">
</form>


</body>
</html>