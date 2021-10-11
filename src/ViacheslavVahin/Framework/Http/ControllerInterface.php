<?php

namespace ViacheslavVahin\Framework\Http;

interface ControllerInterface
{
    public function execute(): string;
}