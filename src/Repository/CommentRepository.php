<?php


namespace App\Repository;


use App\Connector\DBConnexion;
use App\Entity\Comment;
use PDO;

class CommentRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnexion::dbConnect();
    }

    public function findAll(): array
    {
        $req = $this->db->query('SELECT * FROM comment ORDER BY created_at DESC');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,Comment::class);

        return $req->fetchAll();

    }

    public function findValidated($postId): array
    {
        $req = $this->db->prepare('SELECT * FROM comment WHERE post_id = :postId AND is_validated = 1 ORDER BY created_at DESC');
        $req->bindValue(':postId', (int)$postId);

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,Comment::class);

        $comments = $req->fetchAll();

        foreach ($comments as $comment)
        {
            $userRepository = new UserRepository();
            $comment->setAuthor($userRepository->find($comment->getUserId())); // Créer une function plus tard

        }

        return $comments;

    }

    public function find($id)
    {
        $req = $this->db->prepare('SELECT * FROM comment WHERE id = :id');

        $req->bindValue(':id',(int)$id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,Comment::class);

        return $req->fetch();

    }

    public function findByPostId($id)
    {
        $req = $this->db->prepare('SELECT * FROM comment WHERE post_id = :post_id ORDER BY created_at DESC');

        $req->bindValue(':post_id', (int)$id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, Comment::class);

        $comments = $req->fetchAll();

        foreach ($comments as $comment) {
            $userRepository = new UserRepository();
            $comment->setAuthor($userRepository->find($comment->getUserId()));
        }

        return $comments;
    }
    public function create(Comment $comment)
    {
        $req = $this->db->prepare('INSERT INTO comment(post_id, user_id, content, is_validated, created_at) VALUES(:postId, :userId, :content, :isValidated, NOW())');
        $req->bindValue(':postId', $comment->getPostId());
        $req->bindValue(':userId', $comment->getUserId());
        $req->bindValue(':content', $comment->getContent());
        $req->bindValue(':isValidated', $comment->getIsValidated());

        $req->execute();
    }

    public function delete(Comment $comment)
    {
        $req = $this->db->prepare('DELETE FROM comment WHERE id = :id');
        $req->bindValue(':id', $comment->getId());
        $req->execute();
    }

    public function validatedComment(Comment $comment)
    {
        $req = $this->db->prepare('UPDATE comment SET is_validated = :isValidated WHERE id = :id');
        $req->bindValue(':id', $comment->getId());
        $req->bindValue(':isValidated', $comment->getIsValidated());
        $req->execute();
    }

}