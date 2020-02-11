<?php


namespace App\Controller;


use App\Entity\Post;
use App\Repository\PostRepository;

class PostController
{
    public function listPosts(): array
    {
        $postRepository = new PostRepository();

        return $posts = $postRepository->findAll();
    }

    public function post(int $id): Post
    {
        $postRepository = new PostRepository();

        return $post = $postRepository->find($id);
    }
}