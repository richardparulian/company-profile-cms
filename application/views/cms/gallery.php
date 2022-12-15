<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Gallery</li>
                <li class="breadcrumb-item active">Gallery Image</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-6">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addgallery">
                                        <i class="bi bi-plus-square"></i>
                                        Add Gallery Image
                                    </button>
                                </div>

                                <table id="galleryTable" class="table table-hover table-responsive table-sm" style="width:100%">
                                    <thead>
                                        <tr class="bg-dark text-light small">
                                            <th class="text-center" style="width: 25%;">Gallery Image</th>
                                            <th>Gallery Category</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($getGallery as $gallery) : ?>
                                            <tr class="small">
                                                <td class="text-center">
                                                    <img src="<?= base_url('assets/website/images/gallery/' . $gallery['gallery_image']); ?>" style="width: 50%;" />
                                                </td>
                                                <td><?= $gallery['category_gallery_name']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($gallery['status'] == "Show") : ?>
                                                        <span class="badge rounded-pill bg-success"><?= $gallery['status']; ?></span>
                                                    <?php else : ?>
                                                        <span class="badge rounded-pill bg-secondary"><?= $gallery['status']; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end">
                                                    <a href="<?= base_url("page-edit-gallerys/" . $gallery['gallery_id']); ?>" role="button" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="getGalleryId(<?= $gallery['gallery_id']; ?>)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletegallery"><i class="bi bi-trash3-fill"></i></button>
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
        </div>
        <div class="col-md-6">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addcategorygallery">
                                        <i class="bi bi-plus-square"></i>
                                        Add Category Gallery
                                    </button>
                                </div>

                                <table id="categoryGalleryTable" class="table table-hover table-responsive table-sm" style="width:100%">
                                    <thead>
                                        <tr class="bg-dark text-light small">
                                            <th>Category Name</th>
                                            <th class="text-end">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($getCategoryGallery as $category) : ?>
                                            <tr class="small">
                                                <td><?= $category['category_gallery_name']; ?></td>
                                                <td class="text-end">
                                                    <button role="button" class="btn btn-sm btn-warning" onclick="getCategoryGalleryId(<?= $category['category_gallery_id']; ?>)" data-bs-toggle="modal" data-bs-target="#editcategorygallery"><i class="bi bi-pencil-fill"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="getCategoryGalleryId(<?= $category['category_gallery_id']; ?>)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletecategorygallery"><i class="bi bi-trash3-fill"></i></button>
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
        </div>
    </div>
</main>