<?php

declare(strict_types=1);

function blogGetCategory(): array
{
    return [
        1 => [
            'category_id' => 1,
            'name' => 'Apple',
            'url' => 'apple',
            'posts' => [1, 2, 3]
        ],
        2 => [
            'category_id' => 2,
            'name' => 'Samsung',
            'url' => 'samsung',
            'posts' => [3, 4, 5]
        ],
        3 => [
            'category_id' => 3,
            'name' => 'Xiaomi',
            'url' => 'xiaomi',
            'posts' => [2, 4, 6]
        ]
    ];
}

function blogGetPost(): array
{
    return [
        1 => [
            'post_id' => 1,
            'name' => 'Post 1',
            'url' => 'post-1',
            'description' => 'Lorem ipsum massa donec risus diam, sit justo curabitur sodales sem in. 1 Description',
            'publication_date' => '14.11.1987',
            'author' => 'Jhon Doe'
        ],
        2 => [
            'post_id' => 2,
            'name' => 'Post 2',
            'url' => 'post-2',
            'description' => 'Lorem ipsum massa donec risus diam, sit justo curabitur sodales sem in. 2 Description',
            'publication_date' => '16.11.1987',
            'author' => 'Jhon Doe 2'
        ],
        3 => [
            'post_id' => 3,
            'name' => 'Post 3',
            'url' => 'post-3',
            'description' => 'Lorem ipsum massa donec risus diam, sit justo curabitur sodales sem in. 3 Description',
            'publication_date' => '20.11.1987',
            'author' => 'Jhon Doe 3'
        ],
        4 => [
            'post_id' => 4,
            'name' => 'Post 4',
            'url' => 'post-4',
            'description' => 'Lorem ipsum massa donec risus diam, sit justo curabitur sodales sem in. 4 Description',
            'publication_date' => '17.11.1987',
            'author' => 'Jhon Doe 4'
        ],
        5 => [
            'post_id' => 5,
            'name' => 'Post 5',
            'url' => 'post-5',
            'description' => 'Lorem ipsum massa donec risus diam, sit justo curabitur sodales sem in. 5 Description',
            'publication_date' => '18.11.1987',
            'author' => 'Jhon Doe 5'
        ],
        6 => [
            'post_id' => 6,
            'name' => 'Post 6',
            'url' => 'post-6',
            'description' => 'Lorem ipsum massa donec risus diam, sit justo curabitur sodales sem in. 6 Description',
            'publication_date' => '19.11.1987',
            'author' => 'Jhon Doe 6'
        ]
    ];
}

function blogGetCategoryPost(int $categoryId): array
{
    $categories = blogGetCategory();

    if (!isset($categories[$categoryId])) {
        throw new InvalidArgumentException("Category with ID $categoryId does not exist");
    }

    $postsForCategory = [];
    $posts = blogGetPost();

    foreach ($categories[$categoryId]['posts'] as $postId) {
        if (!isset($posts[$postId])) {
            throw new InvalidArgumentException("Post with ID $postId from category $categoryId does not exist");
        }

        $postsForCategory[] = $posts[$postId];
    }

    return $postsForCategory;
}

function blogGetCategoryByUrl(string $url): ?array
{
    $data = array_filter(
        blogGetCategory(),
        static function ($category) use ($url) {
            return $category['url'] === $url;
        }
    );

    return array_pop($data);
}

function blogGetPostByUrl(string $url): ?array
{
    $data = array_filter(
        blogGetPost(),
        static function ($post) use ($url) {
            return $post['url'] === $url;
        }
    );

    return array_pop($data);
}

function blogGetNewPosts(): ?array
{
    $postsGetNewPost = [];
    $posts = blogGetPost();

    usort($posts, function ($a, $b) {
        return (strtotime($a['publication_date']) - strtotime($b['publication_date']));
    });

    $postsSlice = array_slice($posts, 0, 3);

    foreach ($postsSlice as $postsNew) {
        $postsGetNewPost[] = $postsNew;
    }

    return $postsGetNewPost;
}