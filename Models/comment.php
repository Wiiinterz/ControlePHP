<?php

class Comment {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addComment($content, $userId, $postId) {
        $data = "INSERT INTO comments (contenu, utilisateur_id, post_id, date_commentaire)
                  VALUES (:content, :user_id, :post_id, NOW())";
        $requete = $this->pdo->prepare($data);
        $requete->bindParam(':content', $content);
        $requete->bindParam(':user_id', $userId);
        $requete->bindParam(':post_id', $postId);

        return $requete->execute();
    }

    public function getCommentsByPostId($postId) {
        $data = "
            SELECT c.id, c.contenu, c.date_commentaire, u.nom AS auteur
            FROM comments c
            JOIN users u ON c.utilisateur_id = u.id
            WHERE c.post_id = :post_id
            ORDER BY c.date_commentaire ASC
        ";
        $requete = $this->pdo->prepare($data);
        $requete->bindParam(':post_id', $postId);
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}