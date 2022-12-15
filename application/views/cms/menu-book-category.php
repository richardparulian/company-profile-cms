<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Menu Book Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Book Management</li>
                <li class="breadcrumb-item active">Menu Book Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addmenubookcategory">
                                <i class="bi bi-plus-square"></i>
                                Add Menu Book Category
                            </button>
                        </div>

                        <table id="menuBookCategoryTable" class="table table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light small">
                                    <th>Category Name</th>
                                    <th class="text-center small" style="width: 15%;">Top Image</th>
                                    <th class="text-center small" style="width: 15%;">Bottom Image</th>
                                    <th class="text-center small">For Home Page</th>
                                    <th class="text-center small">Status</th>
                                    <th class="text-end small">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getMenuBook as $menuBook) : ?>
                                    <tr class="small">
                                        <td class="small"><?= $menuBook['menu_book_category_name']; ?></td>
                                        <td class="text-center small">
                                            <?php if ($menuBook['top_image'] == "") : ?>
                                                <span class="badge rounded-pill bg-danger">Image not found</span>
                                            <?php else : ?>
                                                <img src="<?= base_url('assets/website/images/menu-book-category/' . $menuBook['top_image']); ?>" class="w-100" alt="<?= $menuBook['top_image']; ?>" />
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center small">
                                            <?php if ($menuBook['bottom_image'] == "") : ?>
                                                <span class="badge rounded-pill bg-danger">Image not found</span>
                                            <?php else : ?>
                                                <img src="<?= base_url('assets/website/images/menu-book-category/' . $menuBook['bottom_image']); ?>" class="w-100" alt="<?= $menuBook['bottom_image']; ?>" />
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center small">
                                            <?php if ($menuBook['for_home'] == "True") : ?>
                                                <span class="badge rounded-pill bg-primary"><?= $menuBook['for_home']; ?></span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-dark"><?= $menuBook['for_home']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center small">
                                            <?php if ($menuBook['status'] == "Show") : ?>
                                                <span class="badge rounded-pill bg-success"><?= $menuBook['status']; ?></span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-secondary"><?= $menuBook['status']; ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-end small">
                                            <button type="button" onclick="getMenuBookCategoryId(<?= $menuBook['menu_book_category_id']; ?>)" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editmenubookcategory"><i class="bi bi-pencil-fill"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>