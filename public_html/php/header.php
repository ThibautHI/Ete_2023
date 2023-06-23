<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../public/css/styleSheet.css" media="screen" type="text/css" />
    <title>Summer Challenge !</title>
</head>
<body style='background:#fff;'>
<div id="content">
    <!-- tester si l'utilisateur est connecté -->
    <?php
    session_start();
    if(isset($_COOKIE['adrienSuce'])){
        if ($_COOKIE['adrienSuce']!= hash('sha256',"Maxime suce et mathieu a un petit cul")){



        header('Location: ../login.php'); // utilisateur ou mot de passe vide

    }else {
            header('Location: ../login.php'); // utilisateur ou mot de passe vide

        }


    }
    ?>

</div>
