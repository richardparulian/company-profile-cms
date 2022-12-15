<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blog Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Blog Management</li>
                <li class="breadcrumb-item active">Blog Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addblogcategory">
                                <i class="bi bi-plus-square"></i>
                                Add Blog Category
                            </button>
                        </div>

                        <table id="blogCategoryTable" class="table table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light small">
                                    <th class="text-center" style="width: 10%;">No. </th>
                                    <th>Category Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getBlogCategory as $blogCategory) :
                                ?>
                                    <tr class="small">
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $blogCategory['blog_category_name'] ?></td>
                                        <td class="text-center">
                                            <?php if ($blogCategory['status'] == "Show") : ?>
                                                <span class="badge rounded-pill bg-success"><?= $blogCategory['status']; ?></span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-secondary"><?= $blogCategory['status']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" onclick="getBlogCategoryId(<?= $blogCategory['blog_category_id']; ?>)" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editblogcategory"><i class="bi bi-pencil-fill"></i></button>
                                            <!-- off fitur remove -->
                                            <!-- <button type="button" onclick="getBlogCategoryId(<?= $blogCategory['blog_category_id']; ?>)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteblogcategory"><i class="bi bi-trash3-fill"></i></button> -->
                                            <!-- end off fitur remove -->
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