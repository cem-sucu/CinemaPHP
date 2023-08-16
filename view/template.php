<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/template.css">
    <link rel="stylesheet" href="./public/mobile/template.css">
    <title><?= $titre ?></title>
</head>
<body>


<header>
    <h1>Mon Cinéma</h1>
    <nav>
        <ul class="ulTemplate">
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listActeurs">Acteurs</a></li>
            <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
            <li><a href="index.php?action=listGenres">Genres</a></li>
            <!-- <li><a href="index.php?action=ajouterFilm">Ajouter un film</a></li> -->
        </ul>
    </nav>
</header>

<div class="container">
    <?= $contenu ?> <!-- C'est ici que le contenu spécifique à chaque vue sera inséré -->
</div>


</body>
</html>

