<?php


namespace App\Repository;


use App\Connector\DBConnexion;
use App\Entity\Post;
use PDO;

class PostRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnexion::dbConnect();
    }

    public function findAll(): array
    {
        $req = $this->db->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 0, 6');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        $posts = $req->fetchAll();

        foreach ($posts as $post)
        {
            $userRepository = new UserRepository();
            $post->setAuthor($userRepository->find($post->getUserId())); // Créer une function plus tard
        }

        return $posts;
    }

    public function find(int $id): Post
    {
        $req = $this->db->prepare('SELECT * FROM post WHERE id = :id');

        $req->bindValue(':id',(int)$id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        $post =  $req->fetch();

        $userRepository = new UserRepository();
        $post->setAuthor($userRepository->find($post->getUserId()));  // Créer une function plus tard

        return $post;
    }
}

