<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url('./assets/website/images/banner-page/<?= $configuration['banner_default']; ?>');">
    <!-- Container -->
    <div class="container">
        <h3>Events</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li class="active">Events</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Menu Section -->
    <div class="container-fluid no-left-padding no-right-padding latest-events-section">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Events</h3>
                <h4>DON'T MISS IT</h4>
            </div><!-- Section Header /- -->

            <!-- Row -->
            <div class="row">
                <?php foreach ($getEvents as $events) : ?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div>
                            <img src="" alt="<?= $events['blog_image']; ?>" class="bttrlazyloading pd-btm" data-bttrlazyloading-sm-src="<?= base_url('assets/website/images/blog/events/' . $events['blog_image_events']); ?>" style="border-radius: 10px;" />
                        </div>
                        <div class="events-item">

                            <div class="event-content" style="border-radius: 10px">
                                <h4><?= $events['blog_title']; ?></h4>
                                <p><?= $events['blog_desc']; ?></p>
                                <span><i class="fa fa-clock-o"></i>Posted <?= date('Y', strtotime($events['blog_publish'])); ?>,<?= date(' H:i a', strtotime($events['blog_created_at'])); ?></span>
                                <a href="<?= base_url('blog/' . $events['blog_category_slug'] . '/' . $events['blog_id'] . '/' . $events['slug']); ?>" title="Know More" style="border-radius: 10px; font-size: 1rem;">Know More</a>
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