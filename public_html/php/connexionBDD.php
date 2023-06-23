<?php

class connexionBDD
{
    /*private $host = 'localhost';
    private $dbname = 'id20668206_challenge';
    private $username = 'id20668206_mathieu';
    private $password = 'Db#9O-SwRezBd\m6';*/

    private $host = 'localhost';
    private $dbname = 'id20668206_challenge';
    private $username = 'root';
    private $password = '';

    private $connection;

    public function __constructeur() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            die("La connexion a échoué : " . $e->getMessage());
        }
    }

    public function getConnexion() {
        echo "Connexion réussi";
        return $this->connection;
    }

    public function closeConnexion() {
        $this->connection = null;
    }
}

