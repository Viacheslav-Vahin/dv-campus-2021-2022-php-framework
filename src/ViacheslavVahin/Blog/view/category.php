<?php
/** * @var \ViacheslavVahin\Blog\Block\Category $block */
?>
<section title="Posts" class="category-page content-wrapper">
    <h1 class="category-page-title"><?= $block->getCategory()->getName() ?></h1>
    <div class="post-list">
        <?php foreach (array_slice($block->getCategoryPosts(), 0, 36) as $post) : ?>
            <div class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/images/post-placeholder.png" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <h3><?= $post->getName() ?></h3>
                </a>
                <?php $author = $block->getPostAuthor($post);
                if ($author) : ?>
                    <span>Author: </span><a href="<?= $author->getUrl() ?>" class="author-name"><?= $author->getName() ?></a>
                <?php else : ?>
                    <span>No author</span>
                <?php endif ?>
                <span><?= $post->getCreatedAt() ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>