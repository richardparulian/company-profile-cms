<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Static Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Management</li>
                <li class="breadcrumb-item active">Static Page</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("page-add-static-pages"); ?>" role="button" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-square"></i>
                                Add Static Page
                            </a>
                        </div>

                        <table id="staticPageTable" class="table table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light small">
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th class="text-center" style="width: 30%;">Main Banner</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getStaticPage as $page) : ?>
                                    <tr class="small">
                                        <td><?= $page['static_page_title']; ?></td>
                                        <td><?= $page['slug']; ?></td>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/website/images/banner-page/' . $page['static_page_banner']); ?>" class="w-100" />
                                        </td>
                                        <td class="text-center">
                                            <?php if ($page['category_id'] == 0) : ?>
                                                <span class="badge rounded-pill bg-success">available</span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-danger">not available</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= base_url("page-edit-static-pages/" . $page['static_page_id']); ?>" role="button" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="getStaticPageId(<?= $page['static_page_id']; ?>)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletestaticpage"><i class="bi bi-trash3-fill"></i></button>
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