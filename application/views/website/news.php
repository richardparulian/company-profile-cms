<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url('./assets/website/images/banner-page/<?= $configuration['banner_default']; ?>');">
    <!-- Container -->
    <div class="container">
        <h3>News</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li class="active">News</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Menu Section -->
    <div class="container-fluid no-left-padding no-right-padding menu-section menu-cards">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>News</h3>
                <h4>DON'T MISS IT</h4>
            </div><!-- Section Header /- -->

            <!-- Row -->
            <div class="row">
                <?php foreach ($getNews as $blog) : ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="type-post">
                            <div class="entry-cover">
                                <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' . $blog['slug']); ?>" style="width: 100%;">
                                    <img src="" alt="<?= $blog['blog_image']; ?>" class="bttrlazyloading" data-bttrlazyloading-sm-src="<?= base_url('assets/website/images/blog/' . $blog['blog_image']); ?>" style="border-radius: 10px;" />
                                </a>
                            </div>
                            <div class="entry-content">
                                <div class="post-date">
                                    <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' . $blog['slug']); ?>"> <?= date("d", strtotime($blog['blog_publish'])); ?>
                                        <span class="text-sm"><?= date('M', strtotime($blog['blog_publish'])); ?></span>
                                    </a>
                                </div>
                                <h3 class="entry-title">
                                    <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' . $blog['slug']); ?>" title="<?= $blog['blog_title']; ?>">
                                        <?= $blog['blog_title']; ?>
                                    </a>
                                </h3>
                                <div class="entry-meta">
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Posted <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' . $blog['slug']); ?>"><?= date('Y', strtotime($blog['blog_publish'])); ?>,<?= date(' H:i a', strtotime($blog['blog_created_at'])); ?></a></span>
                                    <span class="post-date"><i class="fa fa-user"></i>Author: <?= $blog['blog_author']; ?></span>
                                </div>

                                <?php if ($blog['blog_last_update'] != "0000-00-00") : ?>
                                    <div class="entry-meta">
                                        <span class="post-date"><i class="fa fa-clock-o"></i>Last Update <?= date("d ", strtotime($blog['blog_last_update'])); ?><?= date('M', strtotime($blog['blog_last_update'])); ?>,<?= date(' Y', strtotime($blog['blog_last_update'])); ?></span>
                                    </div>
                                <?php endif; ?>
                                <p><?= $blog['blog_desc']; ?></p>
                                <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' . $blog['slug']); ?>" title="know More">Know More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div><!-- Row /- -->
            <!-- pagination -->
            <div class="w-100 text-center">
                <?= $this->pagination->create_links(); ?>
            </div>
            <!-- end pagination -->
        </div><!-- Container /- -->
    </div>
</main>