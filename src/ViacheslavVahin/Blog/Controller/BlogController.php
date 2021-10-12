<?php

namespace ViacheslavVahin\Blog\Controller;

use ViacheslavVahin\Framework\Http\ControllerInterface;

class BlogController implements ControllerInterface
{
    private \ViacheslavVahin\Framework\Http\Request $request;

    /**
     * @param \ViacheslavVahin\Framework\Http\Request $request
     */
    public function __construct(
        \ViacheslavVahin\Framework\Http\Request $request
    )
    {
        $this->request = $request;
    }

    public function execute(): string
    {
        $data = $this->request->getParameter('blog');
        $page = 'post.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}