<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Careers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url("careers"); ?>">Careers</a></li>
                <li class="breadcrumb-item active">Edit Careers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("career"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url("edit-career/" . $getCareers['career_id']); ?>" class="row g-3" method="post">

                            <div class="col-md-6">
                                <label for="inputNanme4" class="form-label">Careers From</label>
                                <input type="text" class="form-control datepicker" name="career_from" value="<?= $getCareers['career_from']; ?>" placeholder="From" required />
                            </div>

                            <div class="col-md-6">
                                <label for="inputNanme4" class="form-label">Careers Until</label>
                                <input type="text" class="form-control datepicker" name="career_until" value="<?= $getCareers['career_until']; ?>" placeholder="Until" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Career Title</label>
                                <input type="text" rows="5" class="form-control" name="career_title" value="<?= $getCareers['career_title']; ?>" placeholder="Career Title" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Careers Description</label>
                                <textarea id="ckeditor" class="form-control" name="career_desc" required><?= $getCareers['career_desc']; ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Keyword <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="meta_keyword" value="<?= $getCareers['career_meta_keyword']; ?>" placeholder="Meta Keyword" />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Description <small class="text-danger">(optional)</small></label>
                                <textarea rows="4" class="form-control" name="meta_desc" placeholder="Meta Description"><?= $getCareers['career_meta_desc']; ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Careers Image</label>
                                <input class="form-control" type="file" name="career_image" id="formFile">
                                <small class="text-secondary">(Size: 260 x 424 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-4">
                                <img src="<?= base_url('assets/website/images/career/' . $getCareers['career_image']); ?>" class="img-thumbnail" alt="<?= $getCareers['career_image']; ?>" />
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <?php if ($getCareers['career_status'] == "Show") : ?>
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
                                <a href="<?= base_url("career"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>