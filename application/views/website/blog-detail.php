<style>
    .img-icon {
        width: 17%;
    }

    #copy_tooltip {
        display: block;
        text-align: center;
        font-size: 80%;
        position: absolute;
        background: #c59d5f;
        color: #fff;
        padding: 0;
        border-radius: 4px;
        top: 5px;
        left: -25px;
        right: 0;
        margin: auto;
        opacity: 0;
        width: 80px;
    }

    #copy_tooltip.active {
        -webkit-animation: slide-up 0.15s cubic-bezier(0.51, 0.92, 0.265, 1.55) both;
        animation: slide-up 0.15s cubic-bezier(0.51, 0.92, 0.265, 1.55) both;
    }

    #copy_tooltip.inactive {
        -webkit-animation: slide-up 0.1s cubic-bezier(0.25, 0.46, 0.45, 0.94) reverse both;
        animation: slide-up 0.1s cubic-bezier(0.25, 0.46, 0.45, 0.94) reverse both;
    }

    #copy_tooltip:after {
        content: "";
        position: absolute;
        top: 98%;
        left: 50%;
        margin-left: -8px;
        width: 0;
        height: 0;
        border-top: 8px solid #c59d5f;
        border-right: 8px solid transparent;
        border-left: 8px solid transparent;
    }

    @-webkit-keyframes slide-up {
        0% {
            transform: translateY(0) scale(0.8);
            opacity: 0;
        }

        100% {
            transform: translateY(-35px) scale(1);
            opacity: 1;
        }
    }

    @keyframes slide-up {
        0% {
            transform: translateY(0) scale(0.8);
            opacity: 0;
        }

        100% {
            transform: translateY(-35px) scale(1);
            opacity: 1;
        }
    }


    .social-menu ul {
        position: relative;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .social-menu ul li {
        list-style: none;
        margin: 0 5px;
    }

    .social-menu ul li .fa {
        font-size: 15px;
        line-height: 30px;
        transition: .3s;
        color: #000;
    }

    .social-menu ul li .fa:hover {
        color: #fff;
    }

    .social-menu ul li a {
        position: relative;
        display: block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #fff;
        text-align: center;
        transition: .6s;
        box-shadow: 0 5px 4px rgba(0, 0, 0, .5);
    }

    .social-menu ul li a:hover {
        transform: translate(0, -10%);
    }

    .social-menu ul li:nth-child(1) a:hover {
        background-color: #00a884;
    }

    .social-menu ul li:nth-child(2) a:hover {
        background-color: #3b5998;
    }

    .social-menu ul li:nth-child(3) a:hover {
        background-color: rgb(29, 155, 240);
    }

    .social-menu ul li:nth-child(4) a:hover {
        background-color: #0a66c2;
    }

    .social-menu ul li:nth-child(5) a:hover {
        background-color: #000;
    }
</style>

<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url(<?= base_url('/assets/website/images/banner-page/' . $configuration['banner_default']); ?>">
    <!-- Container -->
    <div class="container">
        <h3><?= $getBlog['blog_title']; ?></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li><a href="<?= base_url('blog'); ?>">Blog</a></li>
            <li><a href="<?= base_url('blog/category/' . $blogCategory['blog_category_slug']); ?>"><?= $blogCategory['blog_category_name']; ?></a></li>
            <li class="active"><?= $getBlog['blog_title']; ?></li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->
<div class="clearfix"></div>

<main class="site-main">

    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">

            <!-- Content Area -->
            <div class="col-md-9 col-sm-8 content-area">

                <article class="type-post">
                    <div class="entry-cover"><img src="<?= base_url('assets/website/images/blog/' . $getBlog['blog_image']); ?>" alt="<?= $getBlog['blog_image']; ?>" style="border-radius: 10px;" /></div>
                    <div class="entry-content">
                        <div class="post-date"><a href="#"> <?= date("d", strtotime($getBlog['blog_publish'])); ?><span><?= date('M', strtotime($getBlog['blog_publish'])); ?></span></a></div>
                        <h3 class="entry-title"><?= $getBlog['blog_title']; ?></h3>
                        <div class="entry-meta">
                            <span class="post-date"><i class="fa fa-clock-o"></i>Posted <a href="#"><?= date('Y', strtotime($getBlog['blog_publish'])); ?>,<?= date(' H:i a', strtotime($getBlog['blog_created_at'])); ?></a></span>
                            <span class="post-date"><i class="fa fa-user"></i>Author: <?= $getBlog['blog_author']; ?></span>
                            <?php if ($getBlog['blog_last_update'] != "0000-00-00") : ?>
                                <span class="post-date"><i class="fa fa-clock-o"></i>Last Update <?= date("d ", strtotime($getBlog['blog_last_update'])); ?><?= date('M', strtotime($getBlog['blog_last_update'])); ?>,<?= date(' Y', strtotime($getBlog['blog_last_update'])); ?></span>
                            <?php endif; ?>
                        </div>
                        <!-- description -->
                        <?= $getBlog['blog_desc']; ?>
                        <!-- end description -->
                    </div>
                    <div class="entry-footer">
                        <div class="row">
                            <div class="col-md-8">
                                <span class="tags-links">Tags:
                                    <?php if ($getBlog['blog_tags'] != '' || $getBlog['blog_tags'] != null) : ?>
                                        <?php foreach ($tagsRelated as $tag) : ?>
                                            <a href="<?= base_url('blog/tag/' . $tag["blog_tag_id"] . '/' . $tag["slug"]); ?>" title="<?= $tag["blog_tag_name"]; ?>"><?= $tag["blog_tag_name"]; ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="col-md-4">
                                <span class="share-this">
                                    <div class="social-menu" style="margin-right: 10px;">
                                        <ul>
                                            <li>
                                                <a href="https://api.whatsapp.com/send?text=<?= $getBlog['blog_title'] . " - " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="img-icon" target="_blank" title="Share Whatsapp"><i class="fa fa-whatsapp"></i></a>
                                            </li>
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="img-icon" target="_blank" title="Share Facebook"><i class="fa fa-facebook-f"></i></a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/share?url=<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>&text=<?= $getBlog['blog_title']; ?>" class="img-icon" target="_blank" title="Share Twitter"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?= base_url('blog/detail/' . $getBlog['slug']); ?>" class="img-icon" target="_blank" title="Share Linkedin"><i class="fa fa-linkedin"></i></a>
                                            </li>
                                            <li>
                                                <a role="button" class="img-icon copyButton" data-clipboard-text="<?= current_url(); ?>" title="Copy Link">
                                                    <i class="fa fa-share-alt"></i>
                                                    <span id="copy_tooltip" aria-live="assertive" role="tooltip"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if ($getBlog['blog_image_author'] != "" && $getBlog['blog_quote_author'] != "") : ?>
                        <div class="about-author">
                            <div class="author-details" style="border-radius: 10px">
                                <i><img src="<?= base_url('assets/website/images/blog/author/' . $getBlog['blog_image_author']); ?>" alt="<?= $getBlog['blog_image_author']; ?>" style="border-radius: 10px" /></i>
                                <p><?= $getBlog['blog_quote_author']; ?></p>
                            </div>
                        </div>
                    <?php elseif ($getBlog['blog_image_author'] != "") : ?>
                        <div class="about-author">
                            <div class="author-details" style="border-radius: 10px">
                                <i><img src="<?= base_url('assets/website/images/blog/author/' . $getBlog['blog_image_author']); ?>" alt="<?= $getBlog['blog_image_author']; ?>" style="border-radius: 10px" /></i>
                            </div>
                        </div>
                    <?php elseif ($getBlog['blog_quote_author'] != "") : ?>
                        <div class="about-author">
                            <div class="author-details" style="padding: 30px 30px 30px 30px; border-radius: 10px">
                                <p><?= $getBlog['blog_quote_author']; ?></p>
                            </div>
                        </div>
                    <?php else : ?>

                    <?php endif; ?>
                </article>

            </div><!-- Content Area /- -->