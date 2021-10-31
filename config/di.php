<?php

declare(strict_types=1);

use ViacheslavVahin\Framework\Database\Adapter\MySQL;

return [
    \ViacheslavVahin\Framework\Database\Adapter\AdapterInterface::class => DI\get(
        MySQL::class
    ),
    MySQL::class => DI\autowire()->constructorParameter(
        'connectionParams',
        [
            MySQL::DB_NAME     => 'viacheslavvahin_blog',
            MySQL::DB_USER     => 'viacheslavvahin_blog_user',
            MySQL::DB_PASSWORD => 'Sla601601',
            MySQL::DB_HOST     => 'mysql',
            MySQL::DB_PORT     => '3306'
        ]
    ),
    \ViacheslavVahin\Framework\Http\RequestDispatcher::class => DI\autowire()->constructorParameter(
        'routers',
        [
            \DI\get(\ViacheslavVahin\Cms\Router::class),
            \DI\get(\ViacheslavVahin\Blog\Router::class),
            \DI\get(\ViacheslavVahin\ContactUs\Router::class),
            \DI\get(\ViacheslavVahin\Install\Router::class),
        ]
    )
];