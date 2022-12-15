<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Primary Meta Tags -->
    <title><?= $title; ?> - Milou Farm House</title>
    <meta name="title" content="<?= $title . " - Milou Farm House"; ?>">
    <meta name="description" content="<?= $meta_desc; ?>">
    <meta name="keywords" content="<?= $meta_keyword; ?>">
    <meta name="author" content="Milou Farm House">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?= $og_type; ?>">
    <meta property="og:url" content="<?= $og_url; ?>">
    <meta property="og:title" content="<?= $og_title . " - Milou Farm House"; ?>">
    <meta property="og:description" content="<?= $meta_desc; ?>">
    <?php if ($og_image != "") : ?>
        <meta property="og:image" content="<?= $og_image; ?>">
    <?php endif; ?>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $og_url; ?>">
    <meta property="twitter:title" content="<?= $twitter_title . " - Milou Farm House"; ?>">
    <meta property="twitter:description" content="<?= $meta_desc; ?>">
    <?php if ($twitter_image != "") : ?>
        <meta property="twitter:image" content="<?= $og_image; ?>">
    <?php endif; ?>

    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/website/images/favicon.ico'); ?>" />

    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/website/images//apple-touch-icon-114x114-precomposed.png'); ?>">

    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/website/images//apple-touch-icon-72x72-precomposed.png'); ?>">

    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/website/images//apple-touch-icon-57x57-precomposed.png'); ?>">

    <!-- Library - Google Font Familys -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/website/revolution/css/settings.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/website/revolution/fonts/font-awesome/css/font-awesome.min.css'); ?>">

    <!-- RS5.0 Layers and Navigation Styles -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/website/revolution/css/layers.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/website/revolution/css/navigation.css'); ?>">

    <!-- Library -->
    <link href="<?= base_url(''); ?>assets/website/css/lib.css" rel="stylesheet">

    <!-- Custom - Common CSS -->
    <link href="<?= base_url('assets/website/css/plugins.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/website/css/elements.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/website/css/style.css'); ?>">

    <!-- Sweet Alert -->
    <link href="<?= base_url('assets/website/css/sweetalert2.min.css'); ?>" rel="stylesheet">

    <link href="<?= base_url('assets/website/css/bttrlazyloading.min.css'); ?>" rel="stylesheet">

    <!--[if lt IE 9]>
		<script src="js/html5/respond.min.js"></script>
    <![endif]-->

</head>

<body data-offset="200" data-spy="scroll" data-target=".ownavigation">
    <div class="main-container">
        <!-- Loader -->
        <div id="site-loader" class="load-complete">
            <div class="loader">
                <div class="loader-inner ball-clip-rotate">
                    <div></div>
                </div>
            </div>
        </div><!-- Loader /- -->

        <!-- Header Section -->
        <header class="header_s header_s1">
            <!-- SidePanel -->
            <div id="slidepanel">
                <!-- Top Header -->
                <div class="container-fluid no-right-padding no-left-padding top-header1">
                    <!-- Container -->
                    <div class="container">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 top-left">
                                <span>RESERVATION: <a href="tel:<?= $configuration['company_phone']; ?>"><?= (substr($configuration['company_phone'], 0, 5) == '+6221') ? $configuration['company_phone'] = '(021) ' . substr($configuration['company_phone'], 5) : ""; ?></a></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 top-right">
                                <ul class="top-social">
                                    <?php
                                    if ($configuration['company_facebook'] != "") {
                                        echo '<li><a href="' . $configuration['company_facebook'] . '" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
                                    }

                                    if ($configuration['company_twitter'] != "") {
                                        echo '<li><a href="' . $configuration['company_twitter'] . '" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
                                    }

                                    if ($configuration['company_instagram'] != "") {
                                        echo '<li><a href="' . $configuration['company_instagram'] . '" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>';
                                    }

                                    if ($configuration['company_youtube'] != "") {
                                        echo '<li><a href="' . $configuration['company_youtube'] . '" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>';
                                    }

                                    if ($configuration['company_linkedin'] != "") {
                                        echo '<li><a href="' . $configuration['company_linkedin'] . '" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                                    }
                                    ?>
                                </ul>
                                <!-- <div class="search-block">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="icon icon-Search"></i></button>
                                        </span>
                                    </div>
                                </div> -->
                            </div>
                        </div><!-- Row /- -->
                    </div><!-- Container /- -->
                </div><!-- Top Header /- -->
            </div><!-- SidePanel /- -->