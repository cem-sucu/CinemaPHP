<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    genre
</body>

<?php 
$contenu = ob_get_clean(); // Récupérer le contenu mis en tampon
require "./view/template.php";
?>
</html>