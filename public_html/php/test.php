
<?php

include "header.php" ;
// informations de connexion à la base de données MySQL
$host = 'localhost';
$dbname = 'id20668206_challenge';
$username = 'id20668206_mathieu';
$password = 'Db#9O-SwRezBd\m6';

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

    // affichage des résultats
    while ($row = $stmt->fetch()) {
       echo "<pre>";

       print_r($row);

        echo "</pre>";

    }
} catch (PDOException $e) {
    // affichage de l'erreur en cas de problème de connexion
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>

</body>
</html>