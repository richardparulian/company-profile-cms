<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url('./assets/website/images/banner-page/<?= $configuration['banner_default']; ?>');">
    <!-- Container -->
    <div class="container">
        <h3>Gallery</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li class="active">Gallery</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">

    <!-- Gallery Section -->
    <div class="container-fluid no-padding gallery-section gallery-page">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Great Art</h3>
                <h4>GALLERY</h4>
            </div><!-- Section Header /- -->
            <div class="gallery-category">
                <ul id="filters">
                    <li><a data-filter="*" class="active" href="#" title="All">All</a></li>
                    <?php foreach ($categoryGallery as $category) : ?>
                        <li><a data-filter="<?= "." . $category['category_gallery_name']; ?>" href="#" title="<?= $category['category_gallery_name'] ?>"><?= $category['category_gallery_name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="gallery-list gallery-fitrow">
                    <?php foreach ($gallery as $gallerys) : ?>
                        <div class="gallery-box col-md-3 col-sm-4 col-xs-4 <?= $gallerys['category_gallery_name'] ?>">
                            <a href="<?= base_url('assets/website/images/gallery/' . $gallerys['gallery_image']); ?>">
                                <img src="<?= base_url('assets/website/images/gallery/' . $gallerys['gallery_image']); ?>" alt="<?= $gallerys['gallery_image']; ?>" />
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- Row -->
        </div><!-- Container /- -->
    </div><!-- Gallery Section /- -->

</main>