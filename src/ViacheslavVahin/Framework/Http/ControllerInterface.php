<?php

namespace ViacheslavVahin\Framework\Http;

use ViacheslavVahin\Framework\Http\Response\Raw;

interface ControllerInterface
{
    public function execute(): Raw;
}