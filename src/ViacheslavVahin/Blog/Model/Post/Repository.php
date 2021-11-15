<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Model\Post;

class Repository
{
    public const TABLE = 'post';
    public const TABLE_CATEGORY_POST = 'category_post';
    public const TABLE_DAILY_STATISTICS = 'daily_statistics';

    private \DI\FactoryInterface $factory;

    /**
     * @param \DI\FactoryInterface $factory
     */
    public function __construct(\DI\FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Entity[]
     */
    public function getList(): array
    {
        return [
            1 => $this->makeEntity()->setPostId(1)
                ->setName('Post 1')
                ->setUrl('post-1')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPublicationDate('14.11.1987')
                ->setAuthorId(1),
            2 => $this->makeEntity()->setPostId(2)
                ->setName('Post 2')
                ->setUrl('post-2')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPublicationDate('15.11.1987')
                ->setAuthorId(2),
            3 => $this->makeEntity()->setPostId(3)
                ->setName('Post 3')
                ->setUrl('post-3')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPublicationDate('16.11.1987')
                ->setAuthorId(3),
            4 => $this->makeEntity()->setPostId(4)
                ->setName('Post 4')
                ->setUrl('post-4')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPublicationDate('17.11.1987')
                ->setAuthorId(4),
            5 => $this->makeEntity()->setPostId(5)
                ->setName('Post 5')
                ->setUrl('post-5')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPublicationDate('18.11.1987')
                ->setAuthorId(5),
            6 => $this->makeEntity()->setPostId(6)
                ->setName('Post 6')
                ->setUrl('post-6')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPublicationDate('19.11.1987')
                ->setAuthorId(5),
        ];
    }

    /**
     * @param string $url
     * @return ?Entity
     */
    public function getByUrl(string $url): ?Entity
    {
        $data = array_filter(
            $this->getList(),
            static function ($post) use ($url) {
                return $post->getUrl() === $url;
            }
        );

        return array_pop($data);
    }

    /**
     * @param array $postIds
     * @return array
     */
    public function getByIds(array $postIds): array
    {
        return array_intersect_key(
            $this->getList(),
            array_flip($postIds)
        );
    }

    /**
     * @param int $authorId
     * @return array
     */
    public function getByAuthorId(int $authorId): array
    {
        return array_filter(
            $this->getList(),
            static function ($post) use ($authorId) {
                return $post->getAuthorId() === $authorId;
            }
        );
    }

    /**
     * @return Entity
     */
    private function makeEntity(): Entity
    {
        return $this->factory->make(Entity::class);
    }
}
