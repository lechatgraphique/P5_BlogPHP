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
     * @var bool
     */
    private $disabled;

    /**
     * @var enum('USER','ADMINISTRATOR')
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
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return string
     */
    public function setUsername(string $username): string
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
     * @return string
     */
    public function setPassword(string $password): string
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
     * @return string
     */
    public function setAvatar(string $avatar): string
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
     * @return string
     */
    public function setFirstName(string $first_name): string
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
     * @return string
     */
    public function setLastName(string $last_name): string
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return string
     */
    public function setDisabled(bool $disabled): string
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return enum
     */
    public function getRole(): enum
    {
        return $this->role;
    }

    /**
     * @param enum $role
     * @return 
     */
    public function setRole(enum $role)
    {
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
     * @return string
     */
    public function setCreatedAt(string $created_at): string
    {
        $this->created_at = $created_at;
        return $this;
    }
}
