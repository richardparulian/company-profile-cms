<style>
    form .form-group input[type="email"] {
        text-transform: lowercase;
    }
</style>

<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url(<?= base_url('/assets/website/images/banner-page/' . $configuration['banner_default']); ?>">
    <!-- Container -->
    <div class="container">
        <h3>Contact Us</h3>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Contact Us</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->
<div class="clearfix"></div>

<main class="site-main">

    <!-- Contact Details -->
    <div class="container-fluid no-left-padding no-right-padding contact-details">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <div class="col-md-4 col-sm-4" style="height: 280px;">
                    <div class="cnt-detail-box">
                        <i><img src="<?= base_url(); ?>assets/website/images/cnt-phone.png" alt="Phone" /></i>
                        <h4>CALL US</h4>
                        <p><a href="tel:<?= $configuration['company_phone']; ?>"><?= (substr($configuration['company_phone'], 0, 5) == '+6221') ? $configuration['company_phone'] = '(021) ' . substr($configuration['company_phone'], 5) : ""; ?></a></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4" style="height: 280px;">
                    <div class="cnt-detail-box">
                        <i><img src="<?= base_url(); ?>assets/website/images/cnt-email.png" alt="EMAIL" /></i>
                        <h4>EMAIL</h4>
                        <p><a href="<?= "mailto:" . $configuration['company_email']; ?>"><?= $configuration['company_email']; ?></a></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="cnt-detail-box">
                        <i><img src="<?= base_url(); ?>assets/website/images/cnt-marker.png" alt="Marker" /></i>
                        <h4>Address</h4>
                        <p><?= $configuration['company_address']; ?></p>
                    </div>
                </div>
            </div><!-- Row /- -->
        </div><!-- Container /- -->
    </div><!-- Contact Details /- -->

    <!-- Map Section -->
    <div class="container-fluid no-left-padding no-right-padding map-section map-section2">
        <iframe src="<?= $configuration['company_coordinate']; ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- Map Section /- -->

    <!-- Contact Form -->
    <div class="container-fluid no-left-padding no-right-padding contact-section">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <div class="col-xs-12 no-left-padding no-right-padding contact-form">
                    <div class="col-xs-12 text-center">
                        <h3>CONTACT US</h3>
                    </div>
                    <form class="col-md-12 col-sm-12 col-xs-12 no-left-padding no-right-padding" action="<?= base_url('send-message'); ?>" method="post">
                        <div class="form-group col-sm-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Name*" name="contact_name" id="input_name" required />
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Phone Number*" name="contact_phone" id="input_phone" required />
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <input type="email" class="form-control" placeholder="Email*" name="contact_email" id="input_email" required />
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <input type="text" class="form-control" placeholder="Address*" name="contact_address" id="input_address" />
                        </div>
                        <div class="form-group col-sm-12 col-xs-12">
                            <textarea class="form-control" placeholder="Enter Your Message Here*" name="contact_message" id="textarea_message" required></textarea>
                        </div>
                        <div class="form-group col-sm-12 col-xs-12">
                            <button title="Send Message" type="submit" name="post">submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- Row /- -->
        </div><!-- Container -->
    </div><!-- Contact Form /- -->

</main>