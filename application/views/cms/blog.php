<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Blog Management</li>
                <li class="breadcrumb-item active">Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url('page-add-blogs'); ?>" role="button" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-square"></i>
                                Add Blog
                            </a>
                        </div>

                        <table id="blogTable" class="table table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light small">
                                    <th style="width: 15%;">Blog Image</th>
                                    <th style="width: 20%;">Title</th>
                                    <th style="width: 15%;">Category</th>
                                    <th>Publish Date</th>
                                    <th>Last Update</th>
                                    <th style="width: 10%;">status</th>
                                    <th style="width: 15%;">#</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>