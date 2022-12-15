<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Static Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Management</li>
                <li class="breadcrumb-item"><a href="<?= base_url("menu-setting"); ?>">Static Page</a></li>
                <li class="breadcrumb-item active">Edit Static Page <?= $getStaticPage['static_page_title']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("static-pages"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url("edit-static-pages/" . $getStaticPage['static_page_id']); ?>" class="row g-3" method="post">
                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $getStaticPage['static_page_title']; ?>" placeholder="Title" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Position Title</label>
                                <select id="" class="form-select" name="position_title" required>
                                    <?php if ($getStaticPage['position_title'] == "text-center") : ?>
                                        <option value="<?= $getStaticPage['position_title']; ?>" selected>Center</option>
                                        <option value="text-left">Left</option>
                                    <?php elseif ($getStaticPage['position_title'] == "text-left") : ?>
                                        <option value="<?= $getStaticPage['position_title']; ?>" selected>Left</option>
                                        <option value="text-center">Center</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Keyword <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="meta_keyword" value="<?= $getStaticPage['meta_keyword']; ?>" placeholder="Meta Keyword" />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Description <small class="text-danger">(optional)</small></label>
                                <textarea rows="4" class="form-control" name="meta_description" placeholder="Meta Description"><?= $getStaticPage['meta_desc']; ?></textarea>
                            </div>

                            <div class="col-md-7">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Main Banner Upload</label>
                                <input class="form-control" type="file" name="banner_page" id="formFile">
                                <small class="text-secondary">(size: 1920 x 320 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-5 m-auto d-block">
                                <img src="<?= base_url('assets/website/images/banner-page/' . $getStaticPage['static_page_banner']); ?>" class="img-thumbnail" alt="<?= $getStaticPage['static_page_banner']; ?>">
                            </div>

                            <div class="col-md-7">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Side Banner Upload <small class="text-danger">(optional)</small></label>
                                <input class="form-control" type="file" name="banner_page_side" id="formFile">
                                <small class="text-secondary">(size: 636 x 565 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-5 m-auto d-block">
                                <img src="<?= base_url('assets/website/images/banner-page/' . $getStaticPage['static_page_banner_side']); ?>" class="img-thumbnail" alt="<?= $getStaticPage['static_page_banner_side']; ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Description</label>
                                <textarea name="content" id="ckeditor" required><?= $getStaticPage['static_page_desc']; ?></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="<?= base_url("static-pages"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>