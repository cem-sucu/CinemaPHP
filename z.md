pour les image que l'on ajoute dans dans vscode, il faut pas oublier de changer la bdd avec le meme nom de l'image et faire la modif depuis heidisql  -> et dans le foreach ne pas oublier d'ajouter la source src="./public/img/ juste avant <?= $film["affiche"] ?>

```UPDATE film SET affiche = 'pirate.jpg' WHERE titre = 'Pirates Des Caraïbes';```

http://localhost/CinemaPHP/index.php?action=listFilms

PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats