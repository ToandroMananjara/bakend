<?php
class Database
{
    // Propriété de connexion au base de donnée
    private $host = "sql209.infinityfree.com";
    private $dbname = "if0_37683360_XXX";
    private $user = "if0_37683360";
    private $password = "100901marsup";

    // connexion à la base de donnée
    public function getConnexion()
    {
        $conn = null;
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
        return $conn;
    }
}
