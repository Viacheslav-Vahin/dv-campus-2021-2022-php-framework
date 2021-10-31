<?php
declare(strict_types=1);

namespace ViacheslavVahin\Install;

use ViacheslavVahin\Install\Controller\Index;

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
        if ($this->request->getRequestUrl() === 'install') {
            return Index::class;
        }
        return '';
    }
}