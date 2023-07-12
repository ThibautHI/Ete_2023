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




if (isset($_POST['btnModifier'])) {
    echo $_POST["challenge_id"] . "<br>";
    echo $_POST["choix_joueur"] . "<br>";
    echo $_POST["challenge"] . "<br>";
    echo $_POST["points"] . "<br>";
    echo $_POST["effectue"] . "<br>";


    try {
        // instanciation de la classe PDO
        $pdo = new PDO($dsn, $username, $password);

        // configuration des attributs de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Requête préparée
        $sql = "UPDATE challenge SET user_id = ?, name = ?, pts = ?, fait = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(1, $_POST["choix_joueur"]);
        $stmt->bindParam(2, $_POST["challenge"]);
        $stmt->bindParam(3, $_POST["points"]);
        $stmt->bindParam(4, $_POST["effectue"]);
        $stmt->bindParam(5, $_POST["challenge_id"]);

        if (($_POST["effectue"] == "oui") || ($_POST["effectue"] == "non")) {

            $stmt->execute();
            header('Location: ../ajoutChallenge.php');
        } else {
            // Revient sur la page ajoutChallenge.php
            header('Location: ../ajoutChallenge.php');
        }


} catch (PDOException $e) {
        // affichage de l'erreur en cas de problème de connexion
        echo 'Erreur de connexion : ' . $e->getMessage();
    }

} else {
    $tabChallenge = json_decode($_POST['challenge_id'], true);

    $id_challenge = $tabChallenge['id'];
    $lastname_challenge = $tabChallenge['lastname'];
    $challenge_challenge = $tabChallenge['challenge'];
    $pts_challenge = (int)$tabChallenge['pts'];

    $realiser_challenge = "non";

    if ($tabChallenge['realiser'] == 1)
        $realiser_challenge = "oui";


}




try {
    // instanciation de la classe PDO
    $pdo = new PDO($dsn, $username, $password);

    // configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // requête SQL pour sélectionner toutes les entrées de la table 'utilisateurs'
    $sql = "SELECT * FROM user";
    $users = $pdo->query($sql);
/*
    // Requête préparée
    $sql = "DELETE FROM challenge WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Paramètres de la requête
    $challenge_id = (int)$tabChallenge['id'];
    $stmt->bindParam(1, $challenge_id);
    $stmt->execute();*/

    // Revient sur la page ajoutChallenge.php
    //header('Location: ajoutChallenge.php');


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
    <linK rel="stylesheet" href="../public/css/cssModification.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
</head>
<body>
<div class="titre">
    <h1>MODIFICATION D'UN CHALLENGE</h1>
</div>


<div class="container">

    <form action="ModificationChallenge.php" method="POST" onsubmit='return afficherPopupModifier()'>
        <label>LASTNAME</label>
        <select class="selectionJoueur" name="choix_joueur" >
            <?php
            while ($row = $users->fetch()) {
                if ($row["lastname"] == $lastname_challenge){
                    echo '<option value=" '. $row["id"] . '" selected>' . $row["lastname"] . '</option>';
                } else {
                    echo '<option value=" '. $row["id"] . '">' . $row["lastname"] . '</option>';

                }
            }
            ?>
        </select>

        <?php

        echo '<label>Challenge</label>';
        echo '<input class="inputAjout inputChallenge" size="30" type="text" placeholder="Challenge" name="challenge" value="' . $challenge_challenge . '" required >';

        echo '<label>Points du challenge</label>';
        echo '<input class="inputAjout input_pts" type="number" max="100" placeholder="Points" id="pts" name="points" value="' . $pts_challenge . '" required>';

        echo '<label>Challenge effectué (oui/non)</label>';
        echo '<input class="inputAjout input_pts" max="100" placeholder="Effectué" id="fait" name="effectue" value="' . $realiser_challenge . '" required>';

        echo "<input type='hidden' name='challenge_id' value='" . $id_challenge . "'>";
        echo '<input class="btnAjout" name="btnModifier" type="submit" value="Modifier le challenge">'
        ?>


    </form>
</div>

<script>
    function afficherPopupModifier() {
        if ((document.getElementById('fait').value === "oui") || document.getElementById('fait').value === "non") {
            var confirmation = confirm("Tu crois qu'c'est du respect ça ? Tu crois qu'c'est du respect mon garçon ?");

            if (confirmation) {
                window.location.href = 'ModificationChallenge.php'
            } else {

                return false;
            }
        } else {
            var confirmation = confirm("Putin tu sais pas lire, c'est soit OUI soit NON !");

            if (confirmation) {
                window.location.href = 'ModificationChallenge.php'
            } else {
                return false;
            }
        }
    }
</script>
</body>
</html>