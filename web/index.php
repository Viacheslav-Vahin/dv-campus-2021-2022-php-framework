<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

$requestDispatcher = new \ViacheslavVahin\Framework\Http\RequestDispatcher([
    new \ViacheslavVahin\Cms\Router(),
    new \ViacheslavVahin\Blog\Router(),
    new \ViacheslavVahin\ContactUs\Router(),
]);
$requestDispatcher->dispatch();

exit;

switch ($requestUri) {
    default:


        break;
}