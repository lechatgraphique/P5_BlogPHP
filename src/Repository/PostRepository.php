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
        $req = $this->db->query('SELECT * FROM post ORDER BY created_at DESC');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        $posts = $req->fetchAll();

        foreach ($posts as $post)
        {
            $userRepository = new UserRepository();
            $post->setAuthor($userRepository->find($post->getUserId())); // Créer une function plus tard

            $categoryRepository = new CategoryRepository();
            $post->setCategory($categoryRepository->find($post->getCategoryId()));

            $commentRepository = new CommentRepository();
            $post->setComments($commentRepository->findByPostId($post->getId()));
        }

        return $posts;
    }

    public function findLast(): array
    {
        $req = $this->db->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 0, 3');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        $posts = $req->fetchAll();

        foreach ($posts as $post)
        {
            $userRepository = new UserRepository();
            $post->setAuthor($userRepository->find($post->getUserId())); // Créer une function plus tard

            $categoryRepository = new CategoryRepository();
            $post->setCategory($categoryRepository->find($post->getCategoryId()));

            $commentRepository = new CommentRepository();
            $post->setComments($commentRepository->findByPostId($post->getId()));
        }

        return $posts;
    }

    public function findValidated(): array
    {
        $req = $this->db->query('SELECT * FROM post WHERE is_validated = 1 ORDER BY created_at DESC');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        $posts = $req->fetchAll();

        foreach ($posts as $post)
        {
            $userRepository = new UserRepository();
            $post->setAuthor($userRepository->find($post->getUserId())); // Créer une function plus tard

            $categoryRepository = new CategoryRepository();
            $post->setCategory($categoryRepository->find($post->getCategoryId()));

            $commentRepository = new CommentRepository();
            $post->setComments($commentRepository->findByPostId($post->getId()));
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
        $post->setAuthor($userRepository->find($post->getUserId()));

        $categoryRepository = new CategoryRepository();
        $post->setCategory($categoryRepository->find($post->getCategoryId()));

        $commentRepository = new CommentRepository();
        $post->setComments($commentRepository->findByPostId($post->getId()));

        return $post;
    }

    public function create(Post $post)
    {
        $req = $this->db->prepare('INSERT INTO post(user_id, category_id, slug, title, description, content, created_at, is_validated, image) 
                            VALUES(:userId, :categoryId, :slug, :title, :description, :content, NOW(), :isValidated, :image)');
        $req->bindValue(':title', $post->getTitle());
        $req->bindValue(':userId', $post->getUserId());
        $req->bindValue(':slug', $post->getSlug());
        $req->bindValue(':description', $post->getDescription());
        $req->bindValue(':content', $post->getContent());
        $req->bindValue(':categoryId', $post->getCategoryId());
        $req->bindValue(':isValidated', $post->getIsValidated());
        $req->bindValue(':image', $post->getImage());

        $req->execute();
    }

    public function update(Post $post)
    {
        $req = $this->db->prepare('UPDATE post 
                           SET title = :title,  
                               slug = :slug,
                               description = :description,
                               content = :content,
                               category_id = :categoryId,
                               image = :image,
                               is_validated = :isValidated,
                               updated_at = :updatedAt
                           WHERE id = :id');
        $req->bindValue(':id', $post->getId());
        $req->bindValue(':title', $post->getTitle());
        $req->bindValue(':slug', $post->getSlug());
        $req->bindValue(':description', $post->getDescription());
        $req->bindValue(':content', $post->getContent());
        $req->bindValue(':categoryId', $post->getCategoryId());
        $req->bindValue(':image', $post->getImage());
        $req->bindValue(':isValidated', $post->getIsValidated());
        $req->bindValue(':updatedAt', $post->getUpdatedAt());

        $req->execute();
    }

    public function delete(Post $post)
    {
        $req = $this->db->prepare('DELETE FROM post WHERE id = :id');
        $req->bindValue(':id', $post->getId());
        $req->execute();
    }

}

