<?php


namespace App\Entity;


class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var int
     */
    private $disabled;

    /**
     * @var string ('USER','ADMINISTRATOR')
     */
    private $role;

    /**
     * @var string
     */
    private $created_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return object
     */
    public function setId(int $id): object
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return object
     */
    public function setUsername(string $username): object
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return object
     */
    public function setPassword(string $password): object
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return object
     */
    public function setAvatar(string $avatar): object
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @return object
     */
    public function setFirstName(string $first_name): object
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     * @return object
     */
    public function setLastName(string $last_name): object
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param string $disabled
     * @return object
     */
    public function setDisabled(?string $disabled): object
    {
        if($disabled == 'on') {
            $disabled = 1;
        } elseif (!isset($disabled)) {
            $disabled = 0;
        }

        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return object
     */
    public function setRole(?string $role): object
    {
        if($role === 'on') {
            $role = 'ADMINISTRATOR';
        } elseif (!isset($role)) {
            $role = 'USER';
        }

        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return object
     */
    public function setCreatedAt(string $created_at): object
    {
        $this->created_at = $created_at;
        return $this;
    }
}
