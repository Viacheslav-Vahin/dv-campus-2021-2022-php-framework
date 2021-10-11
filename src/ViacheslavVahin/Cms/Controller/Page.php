<?php

declare(strict_types=1);

namespace ViacheslavVahin\Cms\Controller;

class Page implements \ViacheslavVahin\Framework\Http\ControllerInterface
{
    public function execute(): string
    {
        $page = 'home.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}