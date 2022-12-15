<style>
    .btn {
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
        border: 2px solid #e74c3c;
        border-radius: 0.6em;
        color: #e74c3c;
        cursor: pointer;
        align-self: center;
        font-weight: 400;
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        font-family: "Montserrat", sans-serif;
        font-weight: 700;
    }

    .btn:hover,
    .btn:focus {
        color: #c59d5f;
        outline: 0;
    }

    .third {
        border-color: #c59d5f;
        color: #fff;
        box-shadow: 0 0 0 0 #c59d5f;
        transition: all 150ms ease-in-out;
        background-color: #c59d5f;
    }

    .third:hover {
        box-shadow: 0 0 0 0 #c59d5f;
        background-color: #fff;
    }
</style>
<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url('./assets/website/images/banner-page/<?= $configuration['banner_default']; ?>');">
    <!-- Container -->
    <div class="container">
        <h3>Careers</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li class="active">Careers</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Menu Section -->
    <div class="container-fluid no-left-padding no-right-padding team-section">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Careers</h3>
                <h4>Let's join with us</h4>
            </div><!-- Section Header /- -->

            <div class="row">
                <?php if ($countCareer == 0) : ?>
                    <div class="error-block container-fluid row align-items-center" style="display: flex; flex-wrap: wrap">
                        <div class="col-12 col-md-5 text-center">
                            <img src="<?= base_url('assets/website/images/career-not-found.jpg'); ?>" alt="career-not-found.jpg" />
                        </div>
                        <div class="col-12 col-md-7">
                            <h3>There is no opening matching that search right now.</h3>
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach ($getCareer as $career) : ?>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="team-box text-center">
                                <img src="<?= base_url('assets/website/images/career/' . $career['career_image']); ?>" alt="<?= $career['career_image']; ?>" style="border-radius: 10px; width: 100%" />
                                <div class="team-content" style="background-color: #000; border-radius: 10px">
                                    <h4 style="color: #fff;"><?= $career['career_title']; ?></h4>
                                    <h6>South Jakarta, DKI Jakarta</h6>
                                    <ul style="padding-bottom: 10px;">
                                        <a href="<?= base_url('careers/' . $career['career_slug']); ?>" title="Know More" class="btn third" style="border-radius: 24px; font-size: 1rem;">Know More</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div><!-- Row -->
            <!-- pagination -->
            <div class="w-100 text-center">
                <?= $this->pagination->create_links(); ?>
            </div>
            <!-- end pagination -->
        </div><!-- Container /- -->
    </div>
</main>