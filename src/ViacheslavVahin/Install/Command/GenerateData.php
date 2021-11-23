<?php
declare(strict_types=1);

namespace ViacheslavVahin\Install\Command;

use ViacheslavVahin\Blog\Model\Post\Repository as PostRepository;
use ViacheslavVahin\Blog\Model\Category\Repository as CategoryRepository;
use ViacheslavVahin\Blog\Model\Author\Repository as AuthorRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateData extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'install:generate-data';

    private \ViacheslavVahin\Framework\Database\Adapter\AdapterInterface $adapter;
    private OutputInterface $output;
    private int $numberOfPosts = 0;
    private const AUTHOR_COUNT = 50000;
    private const CATEGORY_COUNT = 1500;
    private const CATEGORY_WITH_POSTS_COUNT = 1000;
    private const STATISTIC_DAYS = 1;

    /**
     * @param \ViacheslavVahin\Framework\Database\Adapter\AdapterInterface $adapter
     * @param string|null $name
     */
    public function __construct(
        \ViacheslavVahin\Framework\Database\Adapter\AdapterInterface $adapter,
        string $name = null
    ) {
        parent::__construct($name);
        $this->adapter = $adapter;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Generate demo data for blog testing');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;
        $this->generateData();
        $output->writeln('Completed!');

        return self::SUCCESS;
    }

    /**
     * @return void
     */
    private function generateData(): void
    {
        $callbacks = [
            [$this, 'truncateTables'],
            [$this, 'generateAuthors'],
            [$this, 'generatePosts'],
            [$this, 'generateCategories'],
            [$this, 'generateCategoryPosts'],
            [$this, 'generateDailyStatistics'],
        ];
        $connection = $this->adapter->getConnection();

        foreach ($callbacks as $callback) {
            try {
                $connection->beginTransaction();
                $this->profile($callback);
                $connection->commit();
            } catch (\Exception $e) {
                $connection->rollBack();
                throw $e;
            }
        }
    }

    /**
     * @return void
     */
    private function truncateTables(): void
    {
        $tables = [
            AuthorRepository::TABLE,
            CategoryRepository::TABLE,
            PostRepository::TABLE,
            PostRepository::TABLE_CATEGORY_POST,
            PostRepository::TABLE_DAILY_STATISTICS,
        ];
        $connection = $this->adapter->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($tables as $table) {
            $connection->query("TRUNCATE TABLE `$table`");
            $this->output->writeln("Truncated table: $table");
        }

        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * @return void
     */
    private function generateAuthors(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO author (`firstname`, `lastname`, `url`)
                VALUES (:firstname, :lastname, :url);
            SQL
            );
        for ($i = 1; $i <= self::AUTHOR_COUNT; $i++) {
            $firstname = $this->getRandomName();
            $lastname = $this->getRandomLastName();
            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':lastname', $lastname);
            $statement->bindValue(':url', str_replace(' ', '-', strtolower("$firstname $lastname")));
            $statement->execute();
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function generatePosts(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO post (`name`, `url`, `description`, `author_id`)
                VALUES (:name, :url, :description, :author_id);
            SQL
            );
        $postId = 1;

        for ($authorId = 1; $authorId <= self::AUTHOR_COUNT; $authorId++) {
            $numberOfPosts = random_int(5, 20);

            for ($i = 1; $i <= $numberOfPosts; $i++) {
                $name = "Post $postId";
                $statement->bindValue(':name', $name);
                $statement->bindValue(':url', str_replace(' ', '-', strtolower($name)));
                $statement->bindValue(':description', "$name description");
                $statement->bindValue(':author_id', $authorId, \PDO::PARAM_INT);
                $statement->execute();
                $postId++;
            }
        }

        $this->numberOfPosts = $postId - 1;
    }

    /**
     * @return void
     */
    private function generateCategories(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO category (`name`, `url`)
                VALUES (:name, :url);
            SQL
            );
        for ($i = 1; $i <= self::CATEGORY_COUNT; $i++) {
            $name = "Category $i";
            $statement->bindValue(':name', $name);
            $statement->bindValue(':url', str_replace(' ', '-', strtolower($name)));
            $statement->execute();
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function generateCategoryPosts(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO category_post (`post_id`, `category_id`)
                VALUES (:post_id, :category_id);
            SQL
            );
        $categoryIds = array_rand(array_flip(range(1, self::CATEGORY_COUNT)), self::CATEGORY_WITH_POSTS_COUNT);

        for ($i = 1; $i <= $this->numberOfPosts; $i++) {
            $postCategories = (array)array_rand(array_flip($categoryIds), random_int(1, 3));

            foreach ($postCategories as $categoryId) {
                $statement->bindValue(':post_id', $i, \PDO::PARAM_INT);
                $statement->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
                $statement->execute();
            }
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function generateDailyStatistics(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO `daily_statistics` (`post_id`, `statistics_date`, `views`)
                VALUES (:post_id, :statistics_date, :views);
            SQL
            );

        for ($day = self::STATISTIC_DAYS; $day >= 1; $day--) {
            $statistics_date = date('Y-m-d', strtotime("-$day days"));

            for ($postId = 1; $postId <= $this->numberOfPosts; $postId++) {
                $statement->bindValue(':post_id', $postId, \PDO::PARAM_INT);
                $statement->bindValue(':statistics_date', $statistics_date);
                $statement->bindValue(':views', random_int(0, 100), \PDO::PARAM_INT);
                $statement->execute();
            }
        }
    }

    /**
     * @return string
     */
    private function getRandomName(): string
    {
        static $randomNames = [
            'Roy',
            'Jayson',
            'Efrain',
            'Ryker',
            'Gustavo',
            'Derek',
            'Brendan',
            'Omari',
            'Trevor',
            'Everett',
            'Jorge',
            'Allen',
            'Francis',
            'Terrance',
            'Johnathan',
            'Jordan',
            'Adolfo',
            'Walter',
            'Rylan',
            'Roman'
        ];

        return $randomNames[array_rand($randomNames)];
    }

    /**
     * @return string
     */
    private function getRandomLastName(): string
    {
        static $randomLastNames = [
            'Ewing',
            'Rocha',
            'Petersen',
            'Glover',
            'Olson',
            'Riddle',
            'Maynard',
            'Robbins',
            'Lowery',
            'Kirk',
            'Lee',
            'Valencia',
            'Briggs',
            'Adkins',
            'Mccoy',
            'Shea',
            'Chavez',
            'Huber',
            'Oconnell',
            'Vega'
        ];

        return $randomLastNames[array_rand($randomLastNames)];
    }

    /**
     * @param callable $callback
     * @return void
     */
    private function profile(callable $callback): void
    {
        $start = microtime(true);
        $callback();
        $totalTime = number_format(microtime(true) - $start, 4);
        $this->output->writeln("Executing <info>$callback[1]</info> took <info>$totalTime</info>");
    }
}
