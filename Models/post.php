<?php

class Message {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllMessages() {
        $data = "
            SELECT p.id, p.titre, p.contenu, p.date_publication, u.nom AS nom_utilisateur, p.utilisateur_id
            FROM posts p
            JOIN users u ON p.utilisateur_id = u.id
            ORDER BY p.date_publication DESC
        ";
        $requete = $this->pdo->prepare($data);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMessage($title, $content, $userId) {
        $data = "INSERT INTO posts (titre, contenu, utilisateur_id, date_publication) 
                  VALUES (:title, :content, :user_id, NOW())";
        $requete = $this->pdo->prepare($data);
        $requete->bindParam(':title', $title);
        $requete->bindParam(':content', $content);
        $requete->bindParam(':user_id', $userId);

        return $requete->execute();
    }

    public function getMessageById($id) {
        $data = "SELECT * FROM posts WHERE id = :id";
        $requete = $this->pdo->prepare($data);
        $requete->bindParam(':id', $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMessage($id, $title, $content, $userId) {
        $data = "
            UPDATE posts
            SET titre = :title, contenu = :content
            WHERE id = :id AND utilisateur_id = :user_id
        ";
        $requete = $this->pdo->prepare($data);
        $requete->bindParam(':title', $title);
        $requete->bindParam(':content', $content);
        $requete->bindParam(':id', $id);
        $requete->bindParam(':user_id', $userId);

        return $requete->execute();
    }

    public function deleteMessage($id, $userId) {
        $data = "DELETE FROM posts WHERE id = :id AND utilisateur_id = :user_id";
        $requete = $this->pdo->prepare($data);
        $requete->bindParam(':id', $id);
        $requete->bindParam(':user_id', $userId);

        return $requete->execute();
    }
}
