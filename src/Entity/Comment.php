<?php


namespace App\Entity;


class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $post_id;

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
     * @param int $id
     * @return int
     */
    public function setId(int $id): object
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param $post_id
     * @return object
     */
    public function setPostId($post_id): object
    {
        $this->post_id = $post_id;
        return $this;
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
     * @return object
     */
    public function setContent(string $content): object
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
     * @param string $user_id
     * @return object
     */
    public function setUserId(string $user_id): object
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
        $this->created_at = $create_at;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsValidated(): int
    {
        return $this->is_validated;
    }

    /**
     * @param bool $is_validated
     * @return object
     */
    public function setIsValidated(bool $is_validated): object
    {
        $this->is_validated = $is_validated;
        return $this;
    }
}