<style>
    .card {
        background: #fff;
        border-radius: 24px;
        display: inline-block;
        min-height: 50px;
        padding-top: 5px;
        padding-bottom: 5px;
        /* margin: 1rem; */
        position: relative;
        min-width: 100%;
        max-width: 100%;
    }

    .card {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .card:hover {
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    a.my-class {
        color: #777777;
    }

    a.my-class:hover {
        color: #c59d5f;
    }

    a.my-class h3 {
        color: #777777;
    }

    a.my-class h3:hover {
        color: #c59d5f;
    }
</style>

<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url(<?= base_url('/assets/website/images/banner-page/' . $configuration['banner_default']); ?>">
    <!-- Container -->
    <div class="container">
        <h3><?= $getCareer['career_title']; ?></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li><a href="<?= base_url('careers'); ?>">Careers</a></li>
            <li class="active"><?= $getCareer['career_title']; ?></li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Menu Section -->
    <div class="container-fluid no-left-padding no-right-padding team-section">
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 25px;">
                    <a href="<?= base_url('careers'); ?>" class="my-class">
                        <i class="fa fa-long-arrow-left"></i> Careers
                    </a>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <img src="<?= base_url('assets/website/images/career/' . $getCareer['career_image']); ?>" alt="<?= $getCareer['career_image']; ?>" style="border-radius: 10px; width: 100%" />
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-top: 15px; padding-bottom: 15px;">
                    <div class="section-header section-header2">
                        <h3><?= $getCareer['career_title']; ?></h3>
                        <h4>South Jakarta, DKI Jakarta</h4>
                    </div>
                    <div class="form-group">
                        <h4><label>Description</label></h4>
                        <h5><?= $getCareer['career_desc']; ?></h4>
                    </div>
                </div>
            </div><!-- Row /- -->
        </div><!-- Container -->
    </div>
</main>