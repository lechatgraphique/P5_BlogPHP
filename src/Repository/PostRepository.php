<?php


namespace App\Repository;


use PDO;

class PostRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnexion::dbConnect();
    }

    public function findAll()
    {
        $req = $this->db->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 0, 5');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        return $req->fetchAll();
    }

    public function find($id)
    {
        $req = $this->db->prepare('SELECT * FROM post WHERE id = :id');

        $req->bindValue(':id',(int)$id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Post');

        return $req->fetch();
    }
}