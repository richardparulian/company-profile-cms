<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Gallery Image</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Gallery</li>
                <li class="breadcrumb-item"><a href="<?= base_url("gallerys"); ?>">Gallery Image</a></li>
                <li class="breadcrumb-item active">Edit Gallery Image</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("gallerys"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url("edit-gallerys/" . $getGallery['gallery_id']); ?>" class="row g-3" method="post">
                            <div class="col-md-9">
                                <label for="inputNanme4" class="form-label">Upload Gallery Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" name="gallery" type="file">
                                <small class="text-secondary">(size: 263 x 290 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-3 m-auto d-block">
                                <img src="<?= base_url('assets/website/images/gallery/' . $getGallery['gallery_image']); ?>" class="img-thumbnail" alt="<?= $getGallery['gallery_image']; ?>">
                            </div>

                            <div class="col-md-9">
                                <label for="inputNanme4" class="form-label">Category Gallery</label>
                                <select id="inputState" class="form-select" name="category_gallery">
                                    <?php if ($getGallery['category_gallery_id']) : ?>
                                        <option value="<?= $getGallery['category_gallery_id']; ?>" selected><?= $getGallery['category_gallery_name']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= null; ?>" selected disabled>Choose Category</option>
                                    <?php endif; ?>
                                    <?php foreach ($getCategoryGallery as $category) : ?>
                                        <option value="<?= $category['category_gallery_id']; ?>"><?= $category['category_gallery_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <?php if ($getGallery['status'] == "Show") : ?>
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
                                <a href="<?= base_url("gallerys"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>