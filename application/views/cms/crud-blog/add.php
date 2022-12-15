<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Blog Management</li>
                <li class="breadcrumb-item"><a href="<?= base_url("blogs"); ?>">Blog</a></li>
                <li class="breadcrumb-item active">Add Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("blogs"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url("add-blogs"); ?>" class="row g-3" method="post">
                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Category</label>
                                <select class="form-control select2" name="blog_category" required>
                                    <option value="" selected disabled>Choose Category</option>
                                    <?php foreach ($blogCategory as $category) : ?>
                                        <option value="<?= $category['blog_category_id']; ?>"><?= $category['blog_category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Title</label>
                                <textarea rows="5" class="form-control" name="blog_title" placeholder="Title" required></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Description</label>
                                <textarea id="ckeditor" class="form-control" name="blog_desc" required></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Keyword <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Description <small class="text-danger">(optional)</small></label>
                                <textarea rows="4" class="form-control" name="meta_desc" placeholder="Meta Description"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Author</label>
                                <input type="text" class="form-control" name="blog_author" placeholder="Author" required />
                            </div>

                            <div class="col-md-6">
                                <label for="inputNanme4" class="form-label">Publish</label>
                                <input type="text" class="form-control datepicker" name="blog_publish" placeholder="Publish" required />
                            </div>

                            <div class="col-md-6">
                                <label for="inputNanme4" class="form-label">Last Update <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control datepicker" name="blog_last_update" placeholder="Last Update" />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Tags</label>
                                <select class="form-control js-example-tokenizer" name="blog_tags[]" multiple="multiple" required>
                                    <?php foreach ($tag as $tags) : ?>
                                        <option value="<?= ($tags['blog_tag_name']) ? $tags['blog_tag_name'] : ""; ?>"><?= ($tags['blog_tag_name']) ? $tags['blog_tag_name'] : ""; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Article</label>
                                <input class="form-control" type="file" name="blog_image" id="formFile" required>
                                <small class="text-secondary">(Size: 851 x 350 px - file image max 2MB)</small>
                            </div>

                            <hr />

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Quote Author <small class="text-danger">(optional)</small></label>
                                <textarea class="form-control" rows="4" name="blog_quote" placeholder="Quote"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Author <small class="text-danger">(optional)</small></label>
                                <input class="form-control" type="file" name="blog_image_author" id="formFile">
                                <small class="text-secondary">(Size: 79 x 90 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Image For Events <small class="text-danger">(optional)</small></label>
                                <input class="form-control" type="file" name="blog_image_events" id="formFile">
                                <small class="text-secondary">(Size: 360 x 532 px - file image max 2MB, note: upload if this article for events)</small>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                    <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="<?= base_url("blogs"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>