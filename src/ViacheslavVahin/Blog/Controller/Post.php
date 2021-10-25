<?php

namespace ViacheslavVahin\Blog\Controller;

use ViacheslavVahin\Framework\Http\ControllerInterface;
use ViacheslavVahin\Framework\Http\Response\Raw;

class Post implements ControllerInterface
{
    private \ViacheslavVahin\Framework\View\PageResponse $pageResponse;

    /**
     * @param \ViacheslavVahin\Framework\View\PageResponse $pageResponse
     */
    public function __construct(
        \ViacheslavVahin\Framework\View\PageResponse $pageResponse
    ) {
        $this->pageResponse = $pageResponse;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(\ViacheslavVahin\Blog\Block\Post::class);
    }
}