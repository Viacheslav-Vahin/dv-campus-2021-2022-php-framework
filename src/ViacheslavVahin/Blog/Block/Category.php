<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Block;

use ViacheslavVahin\Blog\Model\Author\Entity as AuthorEntity;
use ViacheslavVahin\Blog\Model\Category\Entity as CategoryEntity;
use ViacheslavVahin\Blog\Model\Post\Entity as PostEntity;

class Category extends \ViacheslavVahin\Framework\View\Block
{
    private \ViacheslavVahin\Framework\Http\Request $request;

    private \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository;

    private \ViacheslavVahin\Blog\Model\Post\Repository $postRepository;

    protected string $template = '../src/ViacheslavVahin/Blog/view/category.php';

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     * @param \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository
     * @param \ViacheslavVahin\Blog\Model\Post\Repository $postRepository
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request,
        \ViacheslavVahin\Blog\Model\Author\Repository $authorRepository,
        \ViacheslavVahin\Blog\Model\Post\Repository $postRepository
    ) {
        $this->request = $request;
        $this->authorRepository = $authorRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @return CategoryEntity
     */
    public function getCategory(): CategoryEntity
    {
        return $this->request->getParameter('category');
    }

    /**
     * @return PostEntity[]
     */
    public function getCategoryPosts(): array
    {
        return $this->postRepository->getByIds(
            $this->getCategory()->getPostsIds()
        );
    }

    /**
     * @param PostEntity $post
     * @return AuthorEntity|null
     */
    public function getPostAuthor(PostEntity $post): ?AuthorEntity
    {
        return $this->authorRepository->getById($post->getAuthorId());
    }
}