<?php

class Reaction_publication
{
    private $table = "reaction_publication";
    private $connexion = null;

    public $id;
    public $type;
    public $id_pub;
    public $id_compte;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function react()
    {
        $stmt = $this->connexion->prepare("SELECT id FROM reaction_publication WHERE id_pub = ? AND id_compte = ?");
        $stmt->execute([$this->id_pub, $this->id_compte]);
        $existingReaction = $stmt->fetch();

        if ($existingReaction) {
            // Mis à jour de la réaction existante
            $stmt = $this->connexion->prepare("UPDATE reaction_publication SET type = ? WHERE id = ?");
            $stmt->execute([$this->type, $existingReaction['id']]);
        } else {
            // Ajout d'une nouvelle réaction
            $stmt = $this->connexion->prepare("
            INSERT INTO reaction_publication (id_pub, id_compte, type)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE type = VALUES(type)
        ");
            $stmt->execute([$this->id_pub, $this->id_compte, $this->type]);
        }
    }

    public function readAllWithIdPub($id_pub)
    {
        $query = "
            SELECT * FROM $this->table where id_pub=$id_pub

        ";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les publications avec les détails de l'utilisateur
    }

    public function deleteAll($id)
    {
        $sql = "DELETE FROM $this->table WHERE id_pub = ?";
        $query = $this->connexion->prepare($sql);
        $query->execute([$id]);
    }
}
