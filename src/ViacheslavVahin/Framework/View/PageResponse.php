<?php
declare(strict_types=1);

namespace ViacheslavVahin\Framework\View;

use ViacheslavVahin\Framework\Http\Response\Html;

class PageResponse extends Html
{
    private \ViacheslavVahin\Framework\View\Renderer $renderer;

    /**
     * @param \ViacheslavVahin\Framework\View\Renderer $renderer
     */
    public function __construct(
        \ViacheslavVahin\Framework\View\Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    /**
     * @param string $contentBlocClassm
     * @param string $template
     * @return PageResponse
     */
    public function setBody(string $contentBlocClass, string $template = ''): PageResponse
    {
        return parent::setBody((string) $this->renderer->setContent($contentBlocClass, $template));
    }
}