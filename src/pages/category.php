<section title="Posts">
    <h1><?= $data['name'] ?></h1>
    <div class="post-list">
        <?php foreach (blogGetCategorypost($data['category_id']) as $post) : ?>
            <div class="post">
                <a href="/<?= $post['url'] ?>" title="<?= $post['name'] ?>">
                    <img src="/post-placeholder.png" alt="<?= $post['name'] ?>" width="200"/>
                </a>
                <a href="/<?= $post['url'] ?>" title="<?= $post['name'] ?>"><?= $post['name'] ?></a>
                <span class="author-name">Author: <?= $post['author'] ?></span>
                <span><?= $post['publication_date'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>