<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Model\Category;

class Repository extends \ViacheslavVahin\Framework\Database\AbstractRepository
{
    public const TABLE = 'category';

    public const ENTITY = Entity::class;

    /**
     * @param string $url
     * @return Entity|object|null
     */
    public function getByUrl(string $url): ?Entity
    {
        return $this->fetchOne(
            $this->select()->where('url = :url'),
            [
                ':url' => $url
            ]
        );
    }
}
