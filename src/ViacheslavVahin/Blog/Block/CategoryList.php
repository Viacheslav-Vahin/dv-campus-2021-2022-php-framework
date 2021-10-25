<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Block;

use ViacheslavVahin\Blog\Model\Category\Entity as CategoryEntity;

class CategoryList extends \ViacheslavVahin\Framework\View\Block
{
    private \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository;

    protected string $template = '../src/ViacheslavVahin/Blog/view/category_list.php';

    /**
     * @param \ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository
     */
    public function __construct(\ViacheslavVahin\Blog\Model\Category\Repository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return CategoryEntity[]
     */
    public function getCategories(): array
    {
        return $this->categoryRepository->getList();
    }
}