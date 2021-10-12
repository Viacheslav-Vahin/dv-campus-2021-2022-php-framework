<?php

declare(strict_types=1);

return [
    \ViacheslavVahin\Framework\Http\RequestDispatcher::class => DI\autowire()->constructorParameter(
        'routers',
        [
            \DI\get(\ViacheslavVahin\Cms\Router::class),
            \DI\get(\ViacheslavVahin\Blog\Router::class),
            \DI\get(\ViacheslavVahin\ContactUs\Router::class),
        ]
    )
];