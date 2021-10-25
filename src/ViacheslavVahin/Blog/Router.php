<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog;

use ViacheslavVahin\Blog\Controller\Post;
use ViacheslavVahin\Blog\Controller\Category;
use ViacheslavVahin\Blog\Controller\Author;

class Router implements \ViacheslavVahin\Framework\Http\RouterInterface
{
    private \ViacheslavVahin\Framework\Http\Request $request;

    private \ViacheslavVahin\Blog\Model\Post\Repository $postRepository;

    private \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository;

    private \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository;

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     * @param \ViacheslavVahin\Blog\Model\Post\Repository $postRepository,
     * @param \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository,
     * @param \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request,
        \ViacheslavVahin\Blog\Model\Post\Repository $postRepository,
        \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository,
        \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository
    ) {
        $this->request = $request;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($category = $this->categoryRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('category', $category);
            $this->request->setParameter('posts', $this->postRepository->getByIds($category->getPostsIds()));
            return Category::class;
        }

        if ($post = $this->postRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('post', $post);
            return Post::class;
        }

        if ($author = $this->authorRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('author', $author);
            return Author::class;
        }

        return '';
    }
}
