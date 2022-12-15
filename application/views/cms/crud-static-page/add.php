<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Static Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Management</li>
                <li class="breadcrumb-item"><a href="<?= base_url("menu-setting"); ?>">Static Page</a></li>
                <li class="breadcrumb-item active">Add Static Page</li>
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

                        <form enctype="multipart/form-data" action="<?= base_url("add-static-pages"); ?>" class="row g-3" method="post">
                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Position Title</label>
                                <select id="" class="form-select" name="position_title" required>
                                    <option value="" selected disabled>Choose Position</option>
                                    <option value="text-center">Center</option>
                                    <option value="text-left">Left</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Keyword <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Description <small class="text-danger">(optional)</small></label>
                                <textarea rows="4" class="form-control" name="meta_description" placeholder="Meta Description"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Main Banner Upload</label>
                                <input class="form-control" type="file" name="banner_page" id="formFile" required>
                                <small class="text-secondary">(size: 1920 x 320 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Side Banner Upload <small class="text-danger">(optional)</small></label>
                                <input class="form-control" type="file" name="banner_page_side" id="formFile">
                                <small class="text-secondary">(size: 636 x 565 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Description</label>
                                <textarea name="content" id="ckeditor" required></textarea>
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