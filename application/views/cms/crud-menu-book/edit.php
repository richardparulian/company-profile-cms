<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Menu Book</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Book Management</li>
                <li class="breadcrumb-item"><a href="<?= base_url("menu-book"); ?>">Menu Book</a></li>
                <li class="breadcrumb-item active">Edit Menu Book</li>
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

                        <form enctype="multipart/form-data" action="<?= base_url("edit-menu-book/" . $getMenuBook['menu_book_id']); ?>" class="row g-3" method="post">
                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Book Category</label>
                                <select class="form-select select2" name="menu_book_category" required>
                                    <option value="<?= $getMenuBook['menu_book_category_id']; ?>" selected><?= $getMenuBook['menu_book_category_name']; ?></option>
                                    <?php foreach ($getMenuBookCategory as $category) : ?>
                                        <?php if ($getMenuBook['menu_book_category_id'] != $category['menu_book_category_id']) : ?>
                                            <option value="<?= $category['menu_book_category_id']; ?>"><?= $category['menu_book_category_name']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu name</label>
                                <input type="text" class="form-control" name="menu_book_name" value="<?= $getMenuBook['menu_book_name']; ?>" placeholder="Menu Name" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Price</label>
                                <input type="text" class="form-control" name="menu_book_price" value="<?= $getMenuBook['menu_book_price']; ?>" placeholder="Menu Price" required />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Description <small class="text-danger">(optional)</small></label>
                                <textarea rows="4" class="form-control" name="menu_book_desc" placeholder="Menu Description" required><?= $getMenuBook['menu_book_desc']; ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Keyword <small class="text-danger">(optional)</small></label>
                                <input type="text" class="form-control" name="meta_keyword" value="<?= $getMenuBook['menu_book_meta_keyword']; ?>" placeholder="Meta Keyword" />
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Meta Description</label>
                                <textarea rows="4" class="form-control" name="meta_desc" placeholder="Meta Description"><?= $getMenuBook['menu_book_meta_desc']; ?></textarea>
                            </div>

                            <div class="col-md-8">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Menu Image</label>
                                <input class="form-control" type="file" name="menu_book_image" id="formFile">
                                <small class="text-secondary">(size: 500 x 500 px - file image max 2MB)</small>
                            </div>

                            <div class="col-md-4">
                                <img src="<?= base_url('assets/website/images/menu-book/' . $getMenuBook['menu_book_image']); ?>" class="img-thumbnail" alt="<?= $getMenuBook['menu_book_image']; ?>" />
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <?php if ($getMenuBook['menu_book_status'] == "Show") : ?>
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
                                <a href="<?= base_url("menu-book"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>