<?php

declare(strict_types=1);

namespace ViacheslavVahin\ContactUs;

use ViacheslavVahin\ContactUs\Controller\Form;

class Router implements \ViacheslavVahin\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($requestUrl === 'contact-us') {
            return Form::class;
        }

        return '';
    }
}