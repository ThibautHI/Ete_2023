<?php

require 'Model/User.php';

ini_set('display_errors', 1);

// informations de connexion à la base de données MySQL
/*$host = 'localhost';
$dbname = 'id20668206_challenge';
$username = 'id20668206_mathieu';
$password = 'Db#9O-SwRezBd\m6';*/

$host = 'localhost';
$dbname = 'id20668206_challenge';
$username = 'root';
$password = '';

// chaîne de connexion PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // instanciation de la classe PDO
    $pdo = new PDO($dsn, $username, $password);

    // configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // requête SQL pour sélectionner toutes les entrées de la table 'utilisateurs'
    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql);

    $sqlPts = "SELECT SUM(challenge.pts) FROM challenge JOIN user ON user.id = challenge.user_id WHERE challenge.fait = 1 AND lastname = ?";

    $tabUsers = array();

    while ($row = $stmt->fetch()) {

        $requetePTS = $pdo->prepare($sqlPts);
        $requetePTS->bindParam(1, $row["lastname"]);
        $requetePTS->execute();
        $ptsUser  = $requetePTS->fetch();
        //echo $ptsUser["SUM(challenge.pts)"];

        $userChallenge = new User((int)$row["id"], $row["firstname"], $row["lastname"], (int)$ptsUser["SUM(challenge.pts)"], $row["image"]);

        $tabUsers[] = $userChallenge;

    }
    echo $tabUsers[0] . "<br>";
    echo $tabUsers[1] . "<br>";
    echo $tabUsers[2] . "<br>";
    echo $tabUsers[3] . "<br>";
    echo $tabUsers[4] . "<br>";
    echo $tabUsers[5];

    //SELECT * FROM challenge JOIN user ON challenge.user_id = user.id WHERE challenge.fait = 1 ORDER BY user.lastname;

    //SELECT SUM(challenge.pts) FROM challenge JOIN user ON user.id = challenge.user_id WHERE challenge.fait = 1 AND lastname = "RESSE";


       /*for ($i = 0; $i < lesTrailers.size() - 1; $i++) {
            for ($j = 0; $j < lesTrailers.size() - 1 - $i; $j++) {
                if(lesTrailers.get(j).getTime().compareTo(lesTrailers.get(j + 1).getTime()) > 0){
                    Trailer temp = lesTrailers.get(j);
                    lesTrailers.set(j, lesTrailers.get(j + 1));
                    lesTrailers.set(j + 1, temp);
                }
            }
        }*/



} catch (PDOException $e) {
    // affichage de l'erreur en cas de problème de connexion
    echo 'Erreur de connexion : ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix Joueur</title>
    <link rel="stylesheet" href="public/css/cssChallenge.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
</head>
<body>

<div class="titre">
    <h1>PODIUM</h1>
</div>

</body>
</html>