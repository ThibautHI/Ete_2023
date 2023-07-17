<?php

ini_set('display_errors', 1);


$host = 'localhost';
$dbname = 'sys';
$username = 'user';
$password = 'password';

// chaîne de connexion PDO

try {
    // instanciation de la classe PDO

    if (empty($_REQUEST['idChallenge'])||empty($_REQUEST['idUser'])||empty($_REQUEST['pointChallenge'])) {

        header("location: ../listeChallenge.php?erreur=1");
    }

    $idChallenge = $_REQUEST['idChallenge'] ; 

    $idUser = $_REQUEST['idUser'] ; 

    $pointChallenge = $_REQUEST['pointChallenge'];


    $pdo = new PDO('mysql:host=127.0.0.1;dbname=sys;charset=utf8', 'user', 'password');


    // configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmtValiderChallenge = $pdo->query("UPDATE challenge SET fait = true WHERE id = $idChallenge ;") ;


    $stmtModifPointUser = $pdo->query("UPDATE user SET pts = pts + $pointChallenge WHERE id = $idUser;") ;

    echo "test" ; 


    header("location: ../listeChallenge.php?validation=1");



    echo "test"  ;



}catch(Exception $e) {


}

?>
