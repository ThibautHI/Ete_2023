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

for ($i = 0 ; $i<6;$i++) {
    //
    $sqlRequete = "SELECT SUM(challenge.pts) user.firstname FROM challenge JOIN user ON user.id = challenge.user_id WHERE user.lastname = ?";
    $stmtt = $pdo->query($sqlRequete);
}


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
    <link rel="stylesheet" href="../public/css/cssChallenge.css">
</head>
<body>
<div class="titre">
    <h1>Ajout d'un challenge</h1>
</div>
<div class="container">
    <form action="ajoutduChallenge.php" method="POST">

        <label>LASTNAME</label>
        <select name="choix_joueur">
            <?php
            while ($row = $stmt->fetch()) {
                echo '<option value=" '. $row["id"] . '">' . $row["lastname"] . '</option>';
            }
            ?>
        </select>

        <label>CHALLENGE</label>
        <input size="30" type="text" placeholder="Challenge" name="challenge" required>

        <label>POINTS DU CHALLENGE</label>
        <input type="number" placeholder="Points" id="pts" name="points" required>

        <input type="submit" value="Ajouter le challenge">

    </form>

</div>

<div class="tab_Challenge">

    <table class="tab">
        <thead>
        <tr>
            <th>id</th>
            <th>lastname</th>
            <th>challenge</th>
            <th>points</th>
            <th>fait</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $stmtt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['pts'] . "</td>";
            echo "<td>" . $row['fait'] . "</td><br>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>