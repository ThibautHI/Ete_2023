<?php

ini_set('display_errors', 1);

//echo $_POST['challenge_id'];

// informations de connexion à la base de données MySQL
/*$host = 'localhost';
$dbname = 'id20668206_challenge';
$username = 'id20668206_mathieu';
$password = 'Db#9O-SwRezBd\m6';*/



$host = 'localhost';
$dbname = 'id20668206_challenge';
$username = 'root';
$password = '';


//echo $_POST['challenge_id'];

$tabChallenge = json_decode($_POST['challenge_id'], true);

echo $tabChallenge['id'] . "<br>";
echo $tabChallenge['lastname'] . "<br>";
echo $tabChallenge['challenge'] . "<br>";
echo $tabChallenge['pts'] . "<br>";
echo $tabChallenge['realiser'] . "<br>";


// chaîne de connexion PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // instanciation de la classe PDO
    $pdo = new PDO($dsn, $username, $password);

    // configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Requête préparée
    $sql = "DELETE FROM challenge WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Paramètres de la requête
    $challenge_id = (int)$tabChallenge['id'];
    $stmt->bindParam(1, $challenge_id);
    $stmt->execute();

    // Revient sur la page ajoutChallenge.php
    header('Location: ../ajoutChallenge.php');


} catch (PDOException $e) {
    // affichage de l'erreur en cas de problème de connexion
    echo 'Erreur de connexion : ' . $e->getMessage();
}