<?php

declare(strict_types=1);

namespace ViacheslavVahin\Framework\Database\Adapter;

interface AdapterInterface
{
    public function getConnection();
}