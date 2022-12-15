<!-- Widget Area -->
<div class="col-md-3 col-sm-4 widget-area">

    <!-- Widget: Search -->
    <aside class="widget widget_search">
        <form method="post" class="searchform" action="<?= base_url('blog-search-post'); ?>">
            <div class="input-group">
                <input name="search_blog_post" placeholder="Search Blog Post..." class="form-control" type="text" />
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <?php if (end($this->uri->segments) == 'search') : ?>

            <div style="margin: 10px 0 0 5px; color: #777777; font-size: 1.1em;">
                <span><?= '"' . $getBlog['keyword'] . '" ' . $getBlog['countResult'] . ' results found'; ?></span>
            </div>
        <?php endif; ?>
    </aside><!-- Widget: Search /- -->

    <!-- Widget: Categories -->
    <aside class="widget widget_categories">
        <h3 class="widget-title">Articles by Category</h3>
        <ul>
            <?php foreach ($getBlogCategory as $category) : ?>
                <li class="cat-item"><a href="<?= base_url('blog/category/' . $category['blog_category_id'] . '/' . $category['blog_category_slug']); ?>"><?= $category['blog_category_name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside><!-- Widget: Categories /- -->

    <!-- Widget: Recent Posts -->
    <aside class="widget widget_recentposts">
        <h3 class="widget-title">Recent Posts Articles</h3>
        <?php foreach (array_slice($getBlogRecent, 0, 3) as $recent) : ?>
            <div class="recent-content">
                <a href="<?= base_url('blog/' . $recent['blog_category_slug'] . '/' . $recent['blog_id'] . '/' . $recent['slug']); ?>" title="<?= $recent['blog_title']; ?>"><i><img src="<?= base_url('assets/website/images/blog/' . $recent['blog_image']); ?>" alt="<?= $recent['blog_image']; ?>"></i></a>
                <h5><a title="<?= $recent['blog_title']; ?>" href="<?= base_url('blog/' . $recent['blog_category_slug'] . '/' . $recent['blog_id'] . '/' . $recent['slug']); ?>"><?= $recent['blog_title']; ?></a></h5>
                <span>
                    <a href="<?= base_url('blog/' . $recent['blog_category_slug'] . '/' . $recent['blog_id'] . '/' . $recent['slug']); ?>">
                        <?= date('F ', strtotime($recent['blog_publish'])); ?>
                        <?= date("d", strtotime($recent['blog_publish'])); ?>,
                        <?= date('Y', strtotime($recent['blog_publish'])); ?>
                    </a>
                </span>
            </div>
        <?php endforeach; ?>
    </aside><!-- Widget: Recent Posts /- -->

    <!-- Widget: Offer -->
    <?php if ($configuration['url_side_blog'] != "") : ?>
        <aside class="widget widget_offer">
            <div class="offer-box">
                <img src="<?= base_url('assets/website/images/' . $configuration['banner_side_blog']); ?>" alt="<?= $configuration['banner_side_blog']; ?>" />
                <div class="ofr-cnt">
                    <h5><?= $configuration['title_side_blog']; ?></h5>
                    <a href="<?= $configuration['url_side_blog']; ?>" target="_blank" title="<?= $configuration['title_side_blog']; ?>" style="border-radius: 24px;">View More!</a>
                </div>
            </div>
        </aside>
    <?php endif; ?>
    <!-- Widget: Offer /- -->

    <!-- Widget: Tag Cloud -->
    <aside class="widget widget_tag_cloud">
        <h3 class="widget-title">Tags</h3>
        <div class="tagcloud">
            <?php foreach ($tags as $tag) : ?>
                <a href="<?= base_url('blog/tag/' . $tag['blog_tag_id'] . '/' . $tag['slug']); ?>" title="<?= $tag['blog_tag_name']; ?>"><?= $tag['blog_tag_name']; ?></a>
            <?php endforeach; ?>
        </div>
    </aside><!-- Widget: Tag Cloud /- -->
</div><!-- Widget Area /- -->
</div><!-- Row -->
</div><!-- Container -->

</main>