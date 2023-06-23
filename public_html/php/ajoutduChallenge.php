<?php

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

    // Requête préparée
    $sql = "INSERT INTO `challenge` (`id`, `user_id`, `name`, `pts`, `fait`) VALUES (NULL, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($sql);

    // Paramètres de la requête
    $user_id = $_POST['choix_joueur'];
    $name = $_POST['challenge'];
    $pts = $_POST['points'];
    $fait = 0;

    // Exécution de la requête préparée
    $stmt->execute([$user_id, $name, $pts, $fait]);

    // Revien sur la page ajoutChallenge.php
    header('Location: ajoutChallenge.php');


} catch (PDOException $e) {
    // affichage de l'erreur en cas de problème de connexion
    echo 'Erreur de connexion : ' . $e->getMessage();
}