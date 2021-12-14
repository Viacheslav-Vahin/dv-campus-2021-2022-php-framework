<?php
/** @var \ViacheslavVahin\Blog\Block\CategoryList $block */
?>
<ul>
    <?php foreach (array_slice($block->getCategories(), 0, 5) as $category) : ?>
        <li>
            <a href="/<?= $category->getUrl() ?>"><?= $category->getName() ?></a>
        </li>
    <?php endforeach; ?>
</ul>