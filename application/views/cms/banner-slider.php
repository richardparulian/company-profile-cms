<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Banner Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Banner</li>
                <li class="breadcrumb-item active">Banner Slider</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addbannerslider">
                                <i class="bi bi-plus-square"></i>
                                Add Banner Slider
                            </button>
                        </div>

                        <table id="sliderTable" class="table table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light small">
                                    <th class="small" style="width: 20%;">Banner Image</th>
                                    <th class="small" style="width: 20%;">Title Banner</th>
                                    <th class="small" style="width: 20%;">Banner Desc (1)</th>
                                    <th class="small" style="width: 20%;">Banner Desc (2)</th>
                                    <th class="small">Status</th>
                                    <th class="text-end small">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($slider as $sliders) : ?>
                                    <tr class="small">
                                        <td class="text-center small">
                                            <img src="<?= base_url('assets/website/images/banner-slider/' . $sliders['banner_slider_image']); ?>" style="width: 100%;" alt="<?= $sliders['banner_slider_image']; ?>" />
                                        </td>
                                        <td class="small">
                                            <?= ($sliders['banner_first_text']) ? $sliders['banner_first_text'] : "<span class='badge rounded-pill bg-danger'>no description yet</span>"; ?>
                                        </td>
                                        <td class="small"><?= ($sliders['banner_second_text']) ? $sliders['banner_second_text'] : "<span class='badge rounded-pill bg-danger'>no description yet</span>"; ?></td>
                                        <td class="small"><?= ($sliders['banner_third_text']) ? $sliders['banner_third_text'] : "<span class='badge rounded-pill bg-danger'>no description yet</span>"; ?></td>
                                        <td class="small">
                                            <?php if ($sliders['status'] == "Show") : ?>
                                                <span class="badge rounded-pill bg-success"><?= $sliders['status']; ?></span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-secondary"><?= $sliders['status']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end small">
                                            <a href="<?= base_url("page-edit-banner-slider/" . $sliders['banner_slider_id']); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                            <button type="button" onclick="getBannerSliderId(<?= $sliders['banner_slider_id']; ?>)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletebannerslider"><i class="bi bi-trash3-fill"></i></button>
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