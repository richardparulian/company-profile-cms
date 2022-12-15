<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Menu Book</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Book Management</li>
                <li class="breadcrumb-item"><a href="<?= base_url("menu-book"); ?>">Menu Book</a></li>
                <li class="breadcrumb-item active">Add Menu Book</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("menu-book"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form enctype="multipart/form-data" action="<?= base_url("add-menu-book"); ?>" class="row g-3" method="post">
                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Book Category</label>
                                <select id="category_level_edit" class="form-select select2" name="menu_book_category" required>
                                    <option value="" selected disabled>Choose Category</option>
                                    <?php foreach ($getMenuBookCategory as $category) : ?>
                                        <option value="<?= $category['menu_book_category_id']; ?>"><?= $category['menu_book_category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu name</label>
                                <input type="text" class="form-control" name="menu_book_name" placeholder="Menu Name" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Price</label>
                                <input type="text" class="form-control" name="menu_book_price" placeholder="Menu Price" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Description</label>
                                <textarea rows="4" class="form-control" name="menu_book_desc" placeholder="Menu Description" required></textarea>
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
                                <label for="inputNumber" class="col-sm-2 col-form-label">Menu Image</label>
                                <input class="form-control" type="file" name="menu_book_image" id="formFile" required>
                                <small class="text-secondary">(size: 500 x 500 px - file image max 2MB)</small>
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
                                <a href="<?= base_url("menu-book"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>