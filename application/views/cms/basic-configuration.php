<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Basic Configuration</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item active">Basic Configuration</li>
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

                        <form enctype="multipart/form-data" action="<?= base_url('edit-configuration/' . $configuration['configuration_id']); ?>" method="post">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_name" value="<?= $configuration['company_name']; ?>" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="company_email" value="<?= $configuration['company_email']; ?>" placeholder="Company Email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_phone" value="<?= $configuration['company_phone']; ?>" placeholder="Company Phone">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_address" value="<?= $configuration['company_address']; ?>" placeholder="Company Address">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Coordinate Maps</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="4" name="company_coordinate" placeholder="Coordinate Maps"><?= $configuration['company_coordinate']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNanme4" class="col-sm-2 form-label">Meta Keyword</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_keyword" value="<?= $configuration['company_meta_keyword']; ?>" placeholder="Meta Keyword" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNanme4" class="col-sm-2 form-label">Meta Description</label>
                                <div class="col-sm-10">
                                    <textarea rows="4" class="form-control" name="meta_desc" placeholder="Meta Description"><?= $configuration['company_meta_desc']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Logo Home</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="company_logo_home" id="formFile">
                                    <small class="text-secondary">(Size: 480 x 180 px - file image max 2MB)</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img src="<?= base_url('assets/website/images/' . $configuration['company_logo_home']); ?>" class="img-thumbnail" style="background-color: #dee2e6;" />
                                </div>
                            </div>

                            <div class="row mb-3" id="working">
                                <label for="inputDate" class="col-sm-2 col-form-label">Working Time</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="ckeditor" name="company_working_time" placeholder="Working Time"><?= $configuration['company_working_time']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Default Banner</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="banner_default" id="formFile">
                                    <small class="text-secondary">(Size: 1920 x 320 px - file image max 2MB)</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img src="<?= base_url('assets/website/images/banner-page/' . $configuration['banner_default']); ?>" class="img-thumbnail" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_facebook" value="<?= $configuration['company_facebook']; ?>" placeholder="Url Facebook">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_twitter" value="<?= $configuration['company_twitter']; ?>" placeholder="Url Twitter">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputColor" class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_instagram" value="<?= $configuration['company_instagram']; ?>" placeholder="Url Instagram">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Youtube</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_youtube" value="<?= $configuration['company_youtube']; ?>" placeholder="Url Youtube">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Linkedin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_linkedin" value="<?= $configuration['company_linkedin']; ?>" placeholder="Url Linkedin">
                                </div>
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