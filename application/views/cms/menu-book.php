<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Menu Book</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Book Management</li>
                <li class="breadcrumb-item active">Menu Book</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("page-add-menu-book"); ?>" type="button" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-square"></i>
                                Add Menu Book
                            </a>
                        </div>

                        <table id="menuBookTable" class="table table-borderless table-hover table-responsive table-sm small" style="width:100%">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th style="width: 10%;">Image</th>
                                    <th style="width: 15%;">Category</th>
                                    <th style="width: 20%;">Menu</th>
                                    <th style="width: 20%;">Description</th>
                                    <th>Price</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">#</th>
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