<?php

declare(strict_types=1);

namespace ViacheslavVahin\ContactUs\Controller;

use ViacheslavVahin\Framework\Http\ControllerInterface;
use ViacheslavVahin\Framework\Http\Response\Raw;
use ViacheslavVahin\Framework\View\Block;

class Form implements ControllerInterface
{
    private \ViacheslavVahin\Framework\View\PageResponse $pageResponse;

    /**
     * @param \ViacheslavVahin\Framework\View\PageResponse $pageResponse
     */
    public function __construct(
        \ViacheslavVahin\Framework\View\PageResponse $pageResponse
    )
    {
        $this->pageResponse = $pageResponse;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(
            Block::class,
            '../src/ViacheslavVahin/ContactUs/view/contact-us.php'
        );
    }
}
