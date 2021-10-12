<?php

declare(strict_types=1);

namespace ViacheslavVahin\Cms\Controller;

class Page implements \ViacheslavVahin\Framework\Http\ControllerInterface
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

    public function execute(): string
    {
        $page = $this->request->getParameter('page') . '.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}