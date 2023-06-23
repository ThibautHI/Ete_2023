<?php

session_start();

//header('Location: ../selectionChallenge.html');
header('Location: ajoutChallenge.php');

//header('Location: ../index.html');

/*if (!isset($_POST['username']) && isset($_POST['password'])) {

    $username =$_POST['username'];
    $password = $_POST['password'];

    if ($username == "adrienSuce" && $password == "adrienSuce") {

        setcookie('adrienSuce', hash('sha256',"Maxime suce et mathieu a un petit cul"), time() + (86400 * 30), "/");
        header('Location: ../selectionChallenge.html');

    } else {
        header('Location: ../login.php?erreur=1'); // utilisateur ou mot de passe vide
    }
} else {
    header('Location: ../login.php?erreur=1');
}
*/