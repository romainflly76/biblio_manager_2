<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>requete MYSQL</title>
</head>
<body>

    <?php
            // Connexion à la bdd
    // stockage d'acces à la bdd dans une variable $bddrequeteMySQL
                                                            // charset utf8 pour encoder
$bddrequeteMySQL = new PDO("mysql:host=localhost;dbname=biblioDB2;charset=utf8", "root", "root");

//requete = la bdd -> query(prepare la chercher dans la bdd)
                                    // SELECT Tout Depuis la table books
$requete = $bddrequeteMySQL->query("SELECT * FROM books");


// on met dans la variable $resultat, la requete que l'on va chercher dans la bdd
                    // fetch(va chercher)
// $resultat = $requete->fetch();


// ça n'affiche qu'un seul resultat
// echo $resultat['id'] . "." . $resultat['title'];

// Pour afficher tous les element de la bdd 'id' + 'Title' on fait une boucle While
while($resultat = $requete->fetch())
{
    echo $resultat['id'] . "." . $resultat['title'] . "<br />";
}


?>
    
</body>
</html>
