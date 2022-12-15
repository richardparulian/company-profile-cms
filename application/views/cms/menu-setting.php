<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<main id="main" class="main">
    <?= $this->session->flashdata('top'); ?>
    <?= $this->session->flashdata('bottom'); ?>
    <div class="pagetitle">
        <h1>Menu Setting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Management</li>
                <li class="breadcrumb-item active">Menu Settings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addmenu">
                                <i class="bi bi-plus-square"></i>
                                Add Menu
                            </button>
                        </div>

                        <table id="menu" class="table table-borderless table-hover table-responsive table-sm" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th></th>
                                    <th>Position</th>
                                    <th>Menu Name</th>
                                    <th>Menu Url</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>#</th>
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