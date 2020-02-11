<?php


namespace App\Repository;


use App\Connector\DBConnexion;
use App\Entity\User;
use PDO;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnexion::dbConnect();
    }

    public function findAll(): array
    {
        $req = $this->db->query('SELECT * FROM user');

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\User');

        return $req->fetchAll();
    }

    public function find(int $id): User
    {
        $req = $this->db->prepare('SELECT * FROM user WHERE id = :id');

        $req->bindValue(':id',(int)$id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\User');

        return $req->fetch();
    }
}