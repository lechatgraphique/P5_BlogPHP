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
    private $author;

    /**
     * @var string
     */
    private $create_at;

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
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return string
     */
    public function setAuthor(string $author): string
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreateAt(): string
    {
        return $this->create_at;
    }

    /**
     * @param string $create_at
     * @return string
     */
    public function setCreateAt(string $create_at): string
    {
        $this->create_at = $create_at;
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