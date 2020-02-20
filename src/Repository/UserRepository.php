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

    public function findUser(string $username, string $password): User
    {
        $req = $this->db->prepare('SELECT username, password FROM user WHERE username = :username, password = :password');

        $req->bindValue(':username', $username);
        $req->bindValue(':password', $password);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,'App\Entity\User');

        return $req->fetch();
    }

    public function create(User $user)
    {
        $req = $this->db->prepare('INSERT INTO user(username, password, avatar, first_name, last_name, disabled, created_at, role) 
                            VALUES(:username, :password, :avatar, :firstName, :lastName, :disabled, NOW(), :role)');
        $req->bindValue(':username', $user->getUsername());
        $req->bindValue(':password', $user->getPassword());
        $req->bindValue(':avatar', $user->getAvatar());
        $req->bindValue(':firstName', $user->getFirstName());
        $req->bindValue(':lastName', $user->getLastName());
        $req->bindValue(':disabled', $user->getDisabled());
        $req->bindValue(':role', $user->getRole());

        $req->execute();
    }

    public function update(User $user)
    {
        $req = $this->db->prepare('UPDATE user 
                           SET username = :username,  
                               password = :password,
                               avatar = :avatar,
                               first_name = :firstName,
                               last_name = :lastName,
                               disabled = :disabled,
                               role = :role
                           WHERE id = :id');
        $req->bindValue(':id', $user->getId());
        $req->bindValue(':username', $user->getUsername());
        $req->bindValue(':password', $user->getPassword());
        $req->bindValue(':avatar', $user->getAvatar());
        $req->bindValue(':firstName', $user->getFirstName());
        $req->bindValue(':lastName', $user->getLastName());
        $req->bindValue(':disabled', $user->getDisabled());
        $req->bindValue(':role', $user->getRole());

        $req->execute();
    }

    public function delete(User $user)
    {
        $req = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $req->bindValue(':id', $user->getId());
        $req->execute();
    }
}