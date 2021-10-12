<?php

declare(strict_types=1);

namespace ViacheslavVahin\Cms;

use ViacheslavVahin\Cms\Controller\Page;

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
        $cmsPage = [
            '',
            'test-page',
            'test-page-2'
        ];

        if (in_array($requestUrl, $cmsPage)) {
            $this->request->setParameter('page', $requestUrl ?: 'home');

            return Page::class;
        }

        return '';
    }
}