<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Block;

use ViacheslavVahin\Blog\Model\Author\Entity as AuthorEntity;
use ViacheslavVahin\Blog\Model\Post\Entity as PostEntity;

class Author extends \ViacheslavVahin\Framework\View\Block
{
    private \ViacheslavVahin\Framework\Http\Request $request;

    private \ViacheslavVahin\Blog\Model\Post\Repository $postRepository;

    protected string $template = '../src/ViacheslavVahin/Blog/view/author.php';

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     * @param \ViacheslavVahin\Blog\Model\Post\Repository $postRepository
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request,
        \ViacheslavVahin\Blog\Model\Post\Repository $postRepository
    ) {
        $this->request = $request;
        $this->postRepository = $postRepository;
    }

    /**
     * @return AuthorEntity
     */
    public function getAuthor(): AuthorEntity
    {
        return $this->request->getParameter('author');
    }

    /**
     * @return PostEntity[]
     */
    public function getAuthorPosts(): array
    {
        return $this->postRepository->getByAuthorId($this->getAuthor()->getAuthorId());
    }
}