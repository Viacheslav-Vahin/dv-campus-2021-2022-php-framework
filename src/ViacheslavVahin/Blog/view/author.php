<?php
/** @var \ViacheslavVahin\Blog\Block\Author $block */

$author = $block->getAuthor();

?>
<section title="Author" class="category-page content-wrapper">
    <h1 class="category-page-title"><?= $author->getName() ?></h1>
    <div class="post-list">
        <?php foreach ($block->getAuthorPosts() as $post) : ?>
            <div class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/images/post-placeholder.png" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <h3><?= $post->getName() ?></h3>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>"><?= $post->getName() ?></a>
                <span class="author-name">Author: <?= $post->getAuthorId() ?></span>
                <span><?= $post->getCreatedAt() ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>