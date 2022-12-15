<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<div class="flash-data-error-upload" data-flashdata="<?= $this->session->flashdata('error_upload'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Instagram (Footer)</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Configuration</li>
                <li class="breadcrumb-item active">Instagram (Footer)</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addig">
                                <i class="bi bi-plus-square"></i>
                                Add Instagram
                            </button>
                        </div>

                        <table id="instagramTable" class="table table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light small">
                                    <th class="text-center" style="width: 10%;">No. </th>
                                    <th>Instagram Url</th>
                                    <th class="text-center" style="width: 15%;">Instagram Image</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getInstagram as $instagram) :
                                ?>
                                    <tr class="small">
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $instagram['instagram_url']; ?></td>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/website/images/instagram/' . $instagram['instagram_image']); ?>" style="width: 50%;" />
                                        </td>
                                        <td class="text-center">
                                            <?php if ($instagram['status'] == "Show") : ?>
                                                <span class="badge rounded-pill bg-success"><?= $instagram['status']; ?></span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-secondary"><?= $instagram['status']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" onclick="getInstagramId(<?= $instagram['instagram_id']; ?>)" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editig"><i class="bi bi-pencil-fill"></i></button>
                                            <button type="button" onclick="getInstagramId(<?= $instagram['instagram_id']; ?>)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteig"><i class="bi bi-trash3-fill"></i></button>
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