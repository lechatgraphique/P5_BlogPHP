<?php


namespace App\Repository;


use App\Connector\DBConnexion;
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
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Comment');

        return $req->fetchAll();
    }

    public function find($id)
    {
        $req = $this->db->prepare('SELECT * FROM comment WHERE id = :id');

        $req->bindValue(':id',(int)$id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\Comment');

        return $req->fetch();
    }
}