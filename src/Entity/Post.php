<?php


namespace App\Entity;


class Post
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var
     */
    private $author;

    /**
     * @var string
     */
    private $category;

    // private $comments; (implementation plus tard)

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $created_at;

    /**
     * @var string
     */
    private $updated_at;

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
    public function setId(int $id): int
    {
        $this->id = $id;
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
    public function setAuthor( $author)
    {
        $this->author = $author;
        return $this;
    }
    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return string
     */
    public function setCategory(string $category): string
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return string
     */
    public function setSlug(string $slug): string
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return string
     */
    public function setTitle(string $title): string
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return string
     */
    public function setDescription(string $description): string
    {
        $this->description = $description;
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
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return string
     */
    public function setImage(string $image): string
    {
        $this->image = $image;
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

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return string
     */
    public function setUpdatedAt(string $updated_at): string
    {
        $this->updated_at = $updated_at;
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
     * @return bool
     */
    public function setIsValidated(bool $is_validated): bool
    {
        $this->is_validated = $is_validated;
        return $this;
    }
}