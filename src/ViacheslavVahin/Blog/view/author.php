<?php
/** @var \ViacheslavVahin\Blog\Block\Author $block */

$author = $block->getAuthor();

?>
<section title="Author">
    <h1><?= $author->getName() ?></h1>
    <div class="post-list">
        <?php foreach ($block->getAuthorPosts() as $post) : ?>
            <div class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/post-placeholder.png" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>"><?= $post->getName() ?></a>
                <span class="author-name">Author: <?= $post->getAuthorId() ?></span>
                <span><?= $post->getPublicationDate() ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>