<?php

declare(strict_types=1);

namespace ViacheslavVahin\Cms;

use ViacheslavVahin\Cms\Controller\Page;

class Router implements \ViacheslavVahin\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($requestUrl === '') {
            return Page::class;
        }

        return '';
    }
}