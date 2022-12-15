<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url(<?= base_url('assets/website/images/banner-page/' . $staticPage['static_page_banner']); ?>">
    <!-- Container -->
    <div class="container">
        <h3><?= $staticPage['static_page_title']; ?></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li class="active"><?= $staticPage['static_page_title']; ?></li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- About Section -->
    <div class="container-fluid no-left-padding no-right-padding about-section about-section2">

        <?php if ($staticPage['static_page_banner_side'] == "") : ?>
            <!-- Container -->
            <div class="container">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 about-detail <?= $staticPage['position_title']; ?>">
                        <!-- Section Header -->
                        <div class=" section-header section-header2 <?= $staticPage['position_title']; ?>">
                            <h3><?= $staticPage['static_page_title']; ?></h3>
                            <h4>we are the best quality and traeditional restaurant </h4>
                        </div><!-- Section Header /- -->
                        <?= $staticPage['static_page_desc']; ?>
                    </div>
                </div><!-- Row /- -->
            </div><!-- Container /- -->
        <?php else : ?>
            <!-- Container -->
            <div class="container">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-7 about-detail <?= $staticPage['position_title']; ?>">
                        <!-- Section Header -->
                        <div class=" section-header section-header2 <?= $staticPage['position_title']; ?>">
                            <h3><?= $staticPage['static_page_title']; ?></h3>
                            <h4>we are the best quality and traeditional restaurant </h4>
                        </div><!-- Section Header /- -->
                        <?= $staticPage['static_page_desc']; ?>
                    </div>
                </div><!-- Row /- -->
            </div><!-- Container /- -->
            <div class="about-img"><img src="<?= base_url('assets/website/images/banner-page/' . $staticPage['static_page_banner_side']); ?>" alt="<?= $staticPage['static_page_banner_side']; ?>" /></div>
        <?php endif; ?>
    </div><!-- About Section /- -->

    <div class="clearfix"></div>
</main>