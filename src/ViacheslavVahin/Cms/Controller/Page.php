<?php

declare(strict_types=1);

namespace ViacheslavVahin\Cms\Controller;

use ViacheslavVahin\Framework\Http\Response\Raw;
use ViacheslavVahin\Framework\View\Block;

class Page implements \ViacheslavVahin\Framework\Http\ControllerInterface
{

    private \ViacheslavVahin\Framework\Http\Request $request;

    private \ViacheslavVahin\Framework\View\PageResponse $pageResponse;

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     * @param \ViacheslavVahin\Framework\View\PageResponse $pageResponse
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request,
        \ViacheslavVahin\Framework\View\PageResponse $pageResponse
    ) {
        $this->pageResponse = $pageResponse;
        $this->request = $request;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(
            Block::class,
            '../src/ViacheslavVahin/Cms/view/' . $this->request->getParameter('page') . '.php'
        );
    }
}