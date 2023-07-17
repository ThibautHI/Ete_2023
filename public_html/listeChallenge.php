<?php


ini_set('display_errors', 1);

// informations de connexion à la base de données MySQL
/*$host = 'localhost';
$dbname = 'id20668206_challenge';
$username = 'id20668206_mathieu';
$password = 'Db#9O-SwRezBd\m6';*/

$host = 'localhost';
$dbname = 'sys';
$username = 'user';
$password = 'password';

// chaîne de connexion PDO

try {

    if (!empty($_GET['erreur'])) {

        if ($_GET['erreur'] == 1) {

            echo "<script>alert(\"Erreur de Validation !!!\")</script>";
        }
    }

    if (!empty($_GET['validation'])) {

        if ($_GET['validation'] == 1) {

            echo "<script>alert(\"Valider avec Validation !!!\")</script>";
        }
    }
    // instanciation de la classe PDO

    $pdo = new PDO('mysql:host=127.0.0.1;dbname=sys;charset=utf8', 'user', 'password');


    // configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



    //requête SQL pour sélectionner tout les challenges sur la BDD et les personnes relié à ce dernier
    $sqlChallenge = "SELECT challenge.id, user.id as user_id , user.lastname, challenge.name, challenge.pts, challenge.fait FROM challenge JOIN user ON user_id = user.id ORDER BY user.lastname ASC";
    $stmtt = $pdo->query($sqlChallenge);
    echo "<pre>";
    $result = $stmtt->fetchAll();

    //var_dump($result) ; 
    echo "</pre>";
} catch (Exception $e) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

</head>

<body>

    <i class="fa-sharp fa-solid fa-trash fa-beat" style="color: #ff0000;"></i>
    <div class="titre">
        <h1>Ajout d'un challenge</h1>
    </div>


    <div class="tab_Challenge">

        <table id="example" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Joueur</th>
                    <th>Challenge</th>
                    <th>points</th>
                    <th>Validation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $value) {


                    echo "<tr>";
                    echo "<td>" . $value['lastname'] . "</td>";
                    echo "<td>" . $value['name'] . "</td>";
                    echo "<td>" . $value['pts'] . "</td>";
                    echo "<td>" . '<form action="./Service/validationChallenge.php?idChallenge=' . $value['id'] . '&idUser=' . $value['user_id'] . '&pointChallenge=' . $value['pts'] . '" method="post"><input type="submit" value="Valider le Challenge" />

                    </form>' . "</td><br>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>