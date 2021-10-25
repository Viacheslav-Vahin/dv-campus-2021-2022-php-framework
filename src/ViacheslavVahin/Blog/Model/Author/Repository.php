<?php
declare(strict_types=1);

namespace ViacheslavVahin\Blog\Model\Author;

class Repository
{
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
            1 => $this->makeEntity()->setAuthorId(1)
                ->setName('Author 1')
                ->setUrl('author-1'),
            2 => $this->makeEntity()->setAuthorId(2)
                ->setName('Author 2')
                ->setUrl('author-2'),
            3 => $this->makeEntity()->setAuthorId(3)
                ->setName('Author 3')
                ->setUrl('author-3'),
            4 => $this->makeEntity()->setAuthorId(4)
                ->setName('Author 4')
                ->setUrl('author-4'),
            5 => $this->makeEntity()->setAuthorId(5)
                ->setName('Author 5')
                ->setUrl('author-5'),
        ];
    }

    /**
     * @param string $url
     * @return ?Entity
     */
    public function getByUrl(string $url): ?Entity
    {
        $authors = array_filter(
            $this->getList(),
            static function ($author) use ($url) {
                return $author->getUrl() === $url;
            }
        );

        return array_pop($authors);
    }

    /**
     * @param int $authorId
     * @return ?Entity
     */
    public function getById(int $authorId): ?Entity
    {
        $authors = array_filter(
            $this->getList(),
            static function ($author) use ($authorId) {
                return $author->getAuthorId() === $authorId;
            }
        );

        return array_pop($authors);
    }

    /**
     * @return Entity
     */
    private function makeEntity(): Entity
    {
        return $this->factory->make(Entity::class);
    }
}