<?php

class Commentaire
{
    private $table = "commentaire";
    private $connexion = null;

    public $id;
    public $id_pub;
    public $id_compte;
    public $contenu;
    public $date_commentaire;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function create()
    {
        $sql = "insert into $this->table (id_pub,id_compte,contenu) values ('$this->id_pub','$this->id_compte',
                        '$this->contenu')";
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
            SELECT cm.*, c.nom, c.prenom, c.email, c.id AS user_id
            FROM commentaire cm
            JOIN compte c ON cm.id_compte = c.id
            ORDER BY cm.date_publication DESC
        ";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les publications avec les détails de l'utilisateur
    }

    public function readAllWithIdPub($id_pub)
    {
        $query = "
            SELECT * FROM $this->table where id_pub=$id_pub
            ORDER BY date_commentaire DESC

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
        $sql = "UPDATE $this->table set id_pub= '$this->id_pub',id_compte='$this->id_compte',contenu='$this->contenu'
            where id=$this->id";
        $query = $this->connexion->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE from $this->table where id=$id";
        $query = $this->connexion->query($sql);
    }

    public function deleteAll($id)
    {
        $sql = "DELETE FROM $this->table WHERE id_pub = ?";
        $query = $this->connexion->prepare($sql);
        $query->execute([$id]);
    }
}
