<?php

declare(strict_types=1);

namespace ViacheslavVahin\Blog;

use ViacheslavVahin\Blog\Controller\Category;
use ViacheslavVahin\Blog\Controller\BlogController;

class Router implements \ViacheslavVahin\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        return '';
    }
}