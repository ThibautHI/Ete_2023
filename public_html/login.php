<?php
?>

<html>
 <head>
 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- importer le fichier de style -->
 <!-- <link rel="stylesheet" href="public/css/styleSheet.css" media="screen" type="text/css" /> -->
     <link rel="stylesheet" href="public/css/styleSheet.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&family=Righteous&family=Vina+Sans&display=swap" rel="stylesheet">


 </head>
 <body>

 <!-- fond d'écran -->

 <img src="public/image/image_plage.jpg" class="image">

 <!-- zone de connexion -->

<div class="container">
    <form action="./php/verification.php" method="POST" class="parent">
        <div class="titre">
            <h2>Connexion</h2>
        </div>

        <div class="username">
            <label>Nom d'utilisateur</label>
            <input type="text" placeholder="User" name="username" required>
        </div>

        <div class="password">
            <label>Mot de passe</label>
            <input type="password" placeholder="Password" name="password" required>
        </div>

        <div class="">
            <input type="submit" id='submit' value='LOGIN' class="inputBtn">
        </div>

        <?php
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1 || $err==2)
                echo "<p class='erreur_connexion'>User / Password incorrect</p>";
        }
        ?>
    </form>
</div>

 </body>
</html>
