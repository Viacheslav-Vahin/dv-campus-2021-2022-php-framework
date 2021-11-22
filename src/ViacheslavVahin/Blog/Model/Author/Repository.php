<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Model\Author;

class Repository extends \ViacheslavVahin\Framework\Database\AbstractRepository
{
    public const TABLE = 'author';

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

    /**
     * @param int $authorId
     * @return Entity|object|null
     */
    public function getById(int $authorId): ?Entity
    {
        return $this->fetchOne(
            $this->select()->where('author_id = :author_id'),
            [
                ':author_id' => $authorId
            ]
        );
    }
}