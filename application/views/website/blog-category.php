<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url(<?= base_url('/assets/website/images/banner-page/' . $configuration['banner_default']); ?>">
    <!-- Container -->
    <div class="container">
        <h3>Blog</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li><a href="<?= base_url('blog'); ?>">Blog</a></li>
            <li class="active"><?= $meta_keyword; ?></li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Content Area -->
            <div class="col-md-9 col-sm-8 content-area">
                <?php if ($countBlogCategory == 0) : ?>
                    <div class="error-block container-fluid row align-items-center" style="display: flex; flex-wrap: wrap">
                        <div class="col-12 col-md-5 text-center">
                            <img src="<?= base_url('assets/website/images/career-not-found.jpg'); ?>" alt="career-not-found.jpg" />
                        </div>
                        <div class="col-12 col-md-7">
                            <h3>Service blog not found. Choose category you desire.</h3>
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach ($getBlog as $blog) : ?>
                        <div class="type-post">
                            <div class="entry-cover">
                                <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' .  $blog['slug']); ?>" style="width: 100%;">
                                    <img src="" alt="<?= $blog['blog_image']; ?>" class="bttrlazyloading" data-bttrlazyloading-sm-src="<?= base_url('assets/website/images/blog/' . $blog['blog_image']); ?>" style="border-radius: 10px;" />
                                </a>
                            </div>
                            <div class="entry-content">
                                <div class="post-date">
                                    <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' .  $blog['slug']); ?>"> <?= date("d", strtotime($blog['blog_publish'])); ?>
                                        <span class="text-sm"><?= date('M', strtotime($blog['blog_publish'])); ?></span>
                                    </a>
                                </div>
                                <h3 class="entry-title">
                                    <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' .  $blog['slug']); ?>" title="<?= $blog['blog_title']; ?>">
                                        <?= $blog['blog_title']; ?>
                                    </a>
                                </h3>
                                <div class="entry-meta">
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Posted <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' .  $blog['slug']); ?>"><?= date('Y', strtotime($blog['blog_publish'])); ?>,<?= date(' H:i a', strtotime($blog['blog_created_at'])); ?></a></span>
                                    <span class="post-date"><i class="fa fa-user"></i>Author: <?= $blog['blog_author']; ?></span>
                                    <?php if ($blog['blog_last_update'] != "0000-00-00") : ?>
                                        <span class="post-date"><i class="fa fa-clock-o"></i>Last Update <?= date("d ", strtotime($blog['blog_last_update'])); ?><?= date('M', strtotime($blog['blog_last_update'])); ?>,<?= date(' Y', strtotime($blog['blog_last_update'])); ?></span>
                                    <?php endif; ?>
                                </div>
                                <p><?= $blog['blog_desc']; ?></p>
                                <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['blog_id'] . '/' .  $blog['slug']); ?>" title="Know More">Know More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- pagination -->
                <div class="w-100 text-center">
                    <?= $this->pagination->create_links(); ?>
                </div>
                <!-- end pagination -->
            </div>
            <!-- Content Area /- -->