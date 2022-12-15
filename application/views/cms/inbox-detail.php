<div class="flash-data-info-read" data-flashdata="<?= $this->session->flashdata('success-read'); ?>"></div>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Inbox Detail</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url("home-admin"); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url("inbox"); ?>">Inbox</a></li>
                <li class="breadcrumb-item active">Inbox Detail</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?= base_url('inbox'); ?>">
                                        <i class="bi bi-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form action="" method="">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="" value="<?= $getInbox['contact_name']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="" value="<?= $getInbox['contact_email']; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="" value="<?= $getInbox['contact_phone']; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea rows="4" class="form-control" name="" readonly><?= $getInbox['contact_address']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Message</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" class="form-control" name="" readonly><?= $getInbox['contact_desc']; ?></textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <a role="button" href="<?= base_url('inbox'); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>