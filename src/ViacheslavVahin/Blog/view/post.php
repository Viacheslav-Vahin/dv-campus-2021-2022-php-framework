<?php
/** @var \ViacheslavVahin\Blog\Block\Post $block */

$post = $block->getPost();
$author = $block->getAuthor();

?>
<div class="post-page" title="Post">
    <img src="/post-placeholder.png" alt="<?= $post->getName() ?>" width="300"/>
    <h1><?= $post->getName() ?></h1>
    <p><?= $post->getDescription() ?></p>
    <?php if ($author) : ?>
        <a href="<?= $author->getUrl() ?>" class="author-name">Author: <?= $author->getName() ?></a>
    <?php else : ?>
        <span>No Author</span>
    <?php endif ?>
    <span><?= $post->getCreatedAt() ?></span>
</div>