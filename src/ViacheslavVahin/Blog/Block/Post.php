<?php

declare(strict_types=1);

namespace ViacheslavVahin\Blog\Block;

use ViacheslavVahin\Blog\Model\Author\Entity as AuthorEntity;
use ViacheslavVahin\Blog\Model\Post\Entity as PostEntity;

class Post extends \ViacheslavVahin\Framework\View\Block
{
    private \ViacheslavVahin\Framework\Http\Request $request;

    private \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository;

    protected string $template = '../src/ViacheslavVahin/Blog/view/post.php';

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     * @param \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request,
        \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository
    ) {
        $this->request = $request;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return PostEntity
     */
    public function getPost(): PostEntity
    {
        return $this->request->getParameter('post');
    }

    /**
     * @return AuthorEntity|null
     */
    public function getAuthor(): ?AuthorEntity
    {
        return $this->authorRepository->getById($this->getPost()->getAuthorId());
    }
}