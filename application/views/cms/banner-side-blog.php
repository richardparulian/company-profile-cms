<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Banner Side Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Configuration</li>
                <li class="breadcrumb-item active">Banner Side Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?= base_url('home-admin'); ?>">
                                        <i class="bi bi-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url('edit-banner-side-blog/' . $configuration['configuration_id']); ?>" method="post">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title Banner</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control config" name="title_side_blog" value="<?= $configuration['title_side_blog']; ?>" placeholder="Title Banner">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Url Banner</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control config" name="url_side_blog" value="<?= $configuration['url_side_blog']; ?>" placeholder="Url Banner">
                                    <small class="text-secondary">(Note: If empty url, content not showing in blog page)</small>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <?php if ($configuration['banner_side_blog'] != "") : ?>
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload Banner</label>
                                    <div class="col-sm-10">
                                        <input class="form-control config" type="file" name="banner_side_blog" id="formFile">
                                        <small class="text-secondary">(size: 287 x 249 px - file image max 2MB)</small>
                                    </div>

                                    <div class="col-sm-4 mt-4">
                                        <img src="<?= base_url('assets/website/images/' . $configuration['banner_side_blog']); ?>" class="img-thumbnail" alt="<?= $configuration['banner_side_blog']; ?>" />
                                    </div>
                                <?php else : ?>
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload Banner</label>
                                    <div class="col-sm-10">
                                        <input class="form-control config" type="file" name="banner_side_blog" id="formFile">
                                        <small class="text-secondary">(size: 287 x 249 px - file image max 2MB)</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Save Change</button>
                                <a role="button" href="<?= base_url('home-admin'); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>