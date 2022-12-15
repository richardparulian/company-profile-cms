<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Banner Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Banner</li>
                <li class="breadcrumb-item"><a href="<?= base_url("menu-setting"); ?>">Banner Slider</a></li>
                <li class="breadcrumb-item active">Edit Banner Slider</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("banner-slider"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url("edit-banner-slider/" . $getBannerSlider['banner_slider_id']); ?>" class="row g-3" method="post">
                            <div class="col-md-7">
                                <label for="inputNanme4" class="form-label">Upload Banner</label>
                                <input class="form-control form-control-sm" id="formFileSm" name="slider" type="file">
                                <small class="text-secondary">(size: 1920 x 882 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-5 m-auto d-block">
                                <img src="<?= base_url('assets/website/images/banner-slider/' . $getBannerSlider['banner_slider_image']); ?>" class="img-thumbnail" alt="<?= $getBannerSlider['banner_slider_image']; ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Banner Description Top <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="desc_1" value="<?= $getBannerSlider['banner_first_text']; ?>" placeholder="Banner Title">
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Banner Description Middle <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="desc_2" value="<?= $getBannerSlider['banner_second_text']; ?>" placeholder="Description 1">
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Banner Description Bottom <small class="text-danger">(optional)</small></label>
                                <textarea class="form-control" name="desc_3" placeholder="Description 2"><?= $getBannerSlider['banner_third_text']; ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <?php if ($getBannerSlider['status'] == "Show") : ?>
                                        <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                        <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                                    <?php else : ?>
                                        <input class="form-check-input show-hide" type="checkbox" name="status" value="Hide" id="flexSwitchCheckChecked">
                                        <label class="form-check-label shows" for="flexSwitchCheckChecked" style="display: none;">Show</label>
                                        <label class="form-check-label hides" for="flexSwitchCheckChecked">Hide</label>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="<?= base_url("banner-slider"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>