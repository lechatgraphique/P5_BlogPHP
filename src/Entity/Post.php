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
     * @var object
     */
    private $author;

    /**
     * @var int
     */
    private $category_id;

    /**
     * @var string
     */
    private $category;

    /**
     * @var object
     */
    private $comments;

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
     * @return object
     */
    public function setId(int $id): object
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
    public function setUserId(int $user_id): object
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return
     */
    public function getAuthor(): object
    {
        return $this->author;
    }

    /**
     * @param object $author
     * @return object
     */
    public function setAuthor(object $author): object
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $categoryId
     * @return int
     */
    public function setCategoryId($categoryId): object
    {
        $this->category_id = $categoryId;
        return $this;
    }

    /**
     * @return
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param  $category
     * @return
     */
    public function setCategory($category): object
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return object
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     * @return object
     */
    public function setComments(array $comments): object
    {
        $this->comments = $comments;
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
    public function setSlug(string $slug)
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
    public function setTitle(string $title): object
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
    public function setDescription(string $description): object
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
    public function setContent(string $content): object
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
     * @return object
     */
    public function setImage(string $image): object
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
    public function setCreatedAt(string $created_at): object
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return string
     */
    public function setUpdatedAt(string $updated_at): object
    {
        $this->updated_at = $updated_at;
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
     * @param $is_validated
     * @return object
     */
    public function setIsValidated($is_validated): object
    {
        if($is_validated == 'on') {
            $is_validated = 1;
        } elseif (!isset($is_validated)) {
            $is_validated = 0;
        }

        $this->is_validated = $is_validated;
        return $this;
    }
}