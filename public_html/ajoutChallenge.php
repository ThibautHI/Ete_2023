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

    // requête SQL pour sélectionner toutes les entrées de la table 'utilisateurs'
    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql);

    //requête SQL pour sélectionner tout les challenges sur la BDD et les personnes relié à ce dernier
    $sqlChallenge = "SELECT challenge.id, user.lastname, challenge.name, challenge.pts, challenge.fait FROM challenge JOIN user ON user_id = user.id ORDER BY user.lastname ASC";
    $stmtt = $pdo->query($sqlChallenge);


    $sqlPtsTotalUser = "SELECT SUM(challenge.pts), user.lastname FROM challenge JOIN user ON user.id = challenge.user_id WHERE user.lastname = ?";
    $resultPtsMax = $pdo->prepare($sqlPtsTotalUser);


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
    <h1>AJOUT D'UN CHALLENGE</h1>
</div>
<div class="container">
    <form class="formAjout" action="Service/ajoutduChallenge.php" method="POST">

        <label>LASTNAME</label>
        <select class="selectionJoueur" name="choix_joueur">
            <?php
            while ($row = $stmt->fetch()) {
                echo '<option value=" '. $row["id"] . '">' . $row["lastname"] . '</option>';
            }
            ?>
        </select>

        <label>CHALLENGE</label>
        <input class="inputAjout" size="30" type="text" placeholder="Challenge" name="challenge" required>

        <label>POINTS DU CHALLENGE</label>
        <input class="inputAjout" type="number" placeholder="Points" id="pts" name="points" required>

        <input   type="submit" class="btnAjout" value="Ajouter le challenge">

    </form>

</div>


<div class="tab_Challenge">
        <table class="tab">
            <thead>
            <tr>
                <th>Id</th>
                <th>Lastname</th>
                <th>Challenge</th>
                <th>Pts</th>
                <th>Fait</th>
                <th>Mod</th>
                <th>Supp</th>
            </tr>
            </thead>
            <tbody>

            <?php

            while ($row = $stmtt->fetch()) {

                $tabChallenge = array(
                        "id" => $row['id'],
                        "lastname" =>  $row['lastname'],
                        "challenge" => $row['name'],
                        "pts" =>  $row['pts'],
                        "realiser" =>  $row['fait']
                );

                $challengeJSON = json_encode($tabChallenge, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS);

                echo "<tr class='tabTr'>";
                echo "<td class='TabTd'>" . $row['id'] . "</td>";
                echo "<td class='TabTd'>" . $row['lastname'] . "</td>";
                echo "<td class='TabTd'>" . $row['name'] . "</td>";
                echo "<td class='TabTd'>" . $row['pts'] . "</td>";
                echo "<td class='TabTd'>" . $row['fait'] . "</td>";
                echo "<td class='TabTd'>

                        <form class='form_challenge' action='Service/ModificationChallenge.php' onsubmit='return afficherPopupModifier()' method='POST'>
                            <input type='hidden' name='challenge_id' onclick='afficherPopup()' value='" . $challengeJSON . "'>
                            <input class='btnModifier' type='submit' value='M'>
                        </form>
                      
                     
                      </td>";
                echo "<td class='TabTd'>
                        <form class='form_challenge' action='Service/SuppressionChallenge.php' onsubmit='return afficherPopupSupprimer()' method='POST'>
                            <input type='hidden' name='challenge_id' onclick='afficherPopup()' value='" . $challengeJSON . "'>
                            <input class='btnDelete' type='submit' value='X'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
</div>
</body>

<script>
    function afficherPopupSupprimer() {
        var confirmation = confirm("Es-tu sur de vouloirs supprimés ce challenge beau gosse des îles ?");

        if (confirmation) {
            return true;
        } else {
            return false;
        }
    }

    function afficherPopupModifier() {
        var confirmation = confirm("Es-tu sur de vouloirs modifiés ce challenge mon sucre d'orge ?");

        if (confirmation) {
            return true;
        } else {
            return false;
        }
    }
</script>
</html>