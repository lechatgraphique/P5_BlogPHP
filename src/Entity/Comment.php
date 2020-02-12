<?php


namespace App\Entity;


class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $user_id;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $created_at;

    /**
     * @var bool
     */
    private $is_validated;

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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return string
     */
    public function setContent(string $content): string
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return int
     */
    public function setUserId(int $user_id): int
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param  $author
     * @return
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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
     * @param string $create_at
     * @return string
     */
    public function setCreatedAt(string $create_at): string
    {
        $this->created_at_at = $create_at;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIsValidated(): bool
    {
        return $this->is_validated;
    }

    /**
     * @param bool $is_validated
     * @return string
     */
    public function setIsValidated(bool $is_validated): string
    {
        $this->is_validated = $is_validated;
        return $this;
    }
}