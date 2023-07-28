<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>

<!-- Ajoutez ici l'en-tête commun à toutes les pages -->
<header>
    <h1>Mon Cinéma</h1>
    <nav>
        <ul>
            <li><a href="index.php?action=listFilms">Liste des films</a></li>
           <li><a href="index.php?action=listActeurs">Liste des acteurs</a></li>
           <li><a href="index.php?action=listRealisateurs">Liste des réalisateurs</a></li>
           <li><a href="index.php?action=listGenres">Liste des genres</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <?= $contenu ?> <!-- C'est ici que le contenu spécifique à chaque vue sera inséré -->


</div>


</body>
</html>

