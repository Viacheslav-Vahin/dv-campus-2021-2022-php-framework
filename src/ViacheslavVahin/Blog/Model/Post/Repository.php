<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Model\Post;

class Repository extends \ViacheslavVahin\Framework\Database\AbstractRepository
{
    public const TABLE = 'post';
    public const TABLE_CATEGORY_POST = 'category_post';
    public const TABLE_DAILY_STATISTICS = 'daily_statistics';
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
     * @param int $categoryId
     * @return Entity[]
     */
    public function getByCategoryId(int $categoryId): array
    {
        $query = $this->select()
            ->innerJoin(self::TABLE_CATEGORY_POST, '', 'USING(`post_id`)')
            ->where('category_id = :category_id')
            ->limit(100);

        return $this->fetchEntities(
            $query,
            [
                ':category_id' => $categoryId
            ]
        );
    }

    /**
     * @param int $authorId
     * @return Entity[]
     */
    public function getByAuthorId(int $authorId): array
    {
        return $this->fetchEntities(
            $this->select()->where('author_id = :author_id'),
            [
                ':author_id' => $authorId
            ]
        );
    }
}
