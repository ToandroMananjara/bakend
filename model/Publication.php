<?php

class Publication
{
    private $table = "publication";
    private $connexion = null;

    public $id;
    public $id_compte;
    public $contenu;
    public $date_publication;
    public $imagePost;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function create()
    {
        $sql = "insert into $this->table (id_compte,contenu,image_name) values ('$this->id_compte',
                        '$this->contenu','$this->imagePost')";
        $query = $this->connexion->query($sql);
    }

    public function readAll()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->connexion->query($sql);
        $datas = $query->fetchAll(PDO::FETCH_OBJ);
        return $datas;
    }

    public function readAllWithUser()
    {
        $query = "
            SELECT p.*, c.nom, c.prenom, c.email, c.id AS user_id
            FROM publication p
            JOIN compte c ON p.id_compte = c.id
            ORDER BY p.date_publication DESC
        ";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les publications avec les détails de l'utilisateur
    }

    public function readById()
    {
        $sql = "SELECT * FROM $this->table where id=$this->id";
        $query = $this->connexion->query($sql);
        $datas = $query->fetch(PDO::FETCH_ASSOC);
        return $datas;
    }

    public function update()
    {
        $sql = "UPDATE $this->table set id_compte='$this->id_compte',contenu='$this->contenu',date_publication='$this->date_publication',
            where id=$this->id";
        $query = $this->connexion->query($sql);
    }

    public function delete($id)
    {
        $filePathQuery = "select image_name from $this->table where id=$id ";
        $sql = "
        DELETE from $this->table where id=$id
        ";
        $query = $this->connexion->query($sql);
        $result = $this->connexion->query($filePathQuery);
        $row = $result->fetch_assoc();
        $imageName = $row['image_name'];
        return $imageName;
    }
}
