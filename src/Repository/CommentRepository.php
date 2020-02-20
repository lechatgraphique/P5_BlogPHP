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

    public function findAll()
    {
        $req = $this->db->query('SELECT * FROM comment ORDER BY created_at DESC LIMIT 0, 5');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,Comment::class);

        return $req->fetchAll();

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