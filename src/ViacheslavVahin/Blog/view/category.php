<?php
/** * @var \ViacheslavVahin\Blog\Block\Category $block */
?>
<section title="Posts">
    <h1><?= $block->getCategory()->getName() ?></h1>
    <div class="post-list">
        <?php foreach ($block->getCategoryPosts() as $post) : ?>
            <div class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/post-placeholder.png" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <h3><?= $post->getName() ?></h3>
                </a>
                <?php $author = $block->getPostAuthor($post);
                if ($author) : ?>
                    <a href="<?= $author->getUrl() ?>" class="author-name">Author: <?= $author->getName() ?></a>
                <?php else : ?>
                    <span>No author</span>
                <?php endif ?>
                <span><?= $post->getPublicationDate() ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>