<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Block;

use ViacheslavVahin\Blog\Model\Category\Entity as CategoryEntity;
use ViacheslavVahin\Blog\Model\Category\Repository as CategoryRepository;
use ViacheslavVahin\Blog\Model\Post\Repository as PostRepository;

class CategoryList extends \ViacheslavVahin\Framework\View\Block
{
    private \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository;

    protected string $template = '../src/ViacheslavVahin/Blog/view/category_list.php';

    /**
     * @param \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository
     */
    public function __construct(\ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return CategoryEntity[]
     */
    public function getCategories(): array
    {
        $select = $this->categoryRepository->select()
            ->distinct(true)
            ->fields(CategoryRepository::TABLE . '.*', true)
            ->innerJoin(PostRepository::TABLE_CATEGORY_POST, '', 'USING(`category_id`)');

        return $this->categoryRepository->fetchEntities($select);
    }
}