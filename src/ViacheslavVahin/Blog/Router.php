<?php

declare(strict_types=1);

namespace ViacheslavVahin\Blog;

use ViacheslavVahin\Blog\Controller\Category;
use ViacheslavVahin\Blog\Controller\BlogController;

class Router implements \ViacheslavVahin\Framework\Http\RouterInterface
{

    private \ViacheslavVahin\Framework\Http\Request $request;

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request
    ) {
        $this->request = $request;
    }
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        require_once '../src/data.php';

        if ($data = blogGetCategoryByUrl($requestUrl)) {
            $this->request->setParameter('category', $data);
            return Category::class;
        }

        if ($data = blogGetPostByUrl($requestUrl)) {
            $this->request->setParameter('blog', $data);
            return BlogController::class;
        }
        return '';
    }
}