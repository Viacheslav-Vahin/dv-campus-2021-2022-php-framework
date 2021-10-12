<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();

try {
    $containerBuilder->addDefinitions('../config/di.php');
    $container = $containerBuilder->build();
    /** @var \ViacheslavVahin\Framework\Http\RequestDispatcher $requestDispatcher */
    $requestDispatcher = $container->get(\ViacheslavVahin\Framework\Http\RequestDispatcher::class);
    $requestDispatcher->dispatch();
} catch (\Exception $e) {
    echo "{$e->getMessage()} in file {$e->getFile()} at line {$e->getLine()}";
    exit(1);
}