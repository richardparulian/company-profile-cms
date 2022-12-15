<style>
    .type-post {
        margin-bottom: 0;
    }

    .type-post,
    .type-post .entry-cover,
    .type-post .entry-content,
    .type-post .entry-content .entry-meta {
        display: inline-block;
        width: 100%;
    }

    .type-post .entry-cover a.my-class {
        display: inline-block;
        position: relative;
    }

    .type-post .entry-cover a.my-class::before,
    .type-post .entry-cover a.my-class::after,
    .type-post .entry-content .entry-title a,
    .type-post .entry-content>a {
        -webkit-transition: all 1s ease 0s;
        -moz-transition: all 1s ease 0s;
        -o-transition: all 1s ease 0s;
        transition: all 1s ease 0s;
    }

    .type-post .entry-cover a.my-class::before {
        color: #fff;
        content: "\e67b";
        font-family: 'Stroke-Gap-Icons';
        font-size: 25px;
        display: inline-block;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        z-index: 1;
        opacity: 0;
    }

    .type-post .entry-cover a.my-class::after {
        background-color: rgba(0, 0, 0, 0.6);
        bottom: 0;
        content: "";
        display: inline-block;
        left: 0;
        position: absolute;
        right: 0;
        text-align: center;
        top: 0;
        transform: scale(0);
        border-radius: 50%;
        -webkit-transform: scale(0);
        -moz-transform: scale(0);
        -ms-transform: scale(0);
    }

    .type-post .entry-cover a.my-class:hover::before {
        opacity: 1;
    }

    .type-post .entry-cover a.my-class:hover::after {
        transform: scale(1);
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
    }

    .btn {
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
        border: 2px solid #e74c3c;
        border-radius: 0.6em;
        color: #e74c3c;
        cursor: pointer;
        align-self: center;
        font-weight: 400;
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        font-family: "Montserrat", sans-serif;
        font-weight: 700;
    }

    .btn:hover,
    .btn:focus {
        color: #c59d5f;
        outline: 0;
    }

    .third {
        border-color: #c59d5f;
        color: #fff;
        box-shadow: 0 0 0 0 #c59d5f;
        transition: all 150ms ease-in-out;
        background-color: #c59d5f;
    }

    .third:hover {
        box-shadow: 0 0 0 0 #c59d5f;
        background-color: #fff;
    }
</style>

<main class="site-main">

    <!-- Slider Section 1 -->
    <div id="home-revslider" class="slider-section slider-section2 container-fluid no-padding">
        <!-- START REVOLUTION SLIDER 5.0 -->
        <div class="rev_slider_wrapper">
            <div id="home-slider2" class="rev_slider" data-version="5.3">
                <ul>
                    <?php foreach ($slider as $sliders) : ?>
                        <li>
                            <img src="<?= base_url('assets/website/images/banner-slider/' . $sliders['banner_slider_image']); ?>" alt="<?= $sliders['banner_slider_image']; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption tp-shape tp-shapewrapper" id="slide-1-layer-0" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-basealign="slide" data-height="full" data-hoffset="['0','0','0','0']" data-responsive="off" data-responsive_offset="off" data-start="0" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:500;s:500;" data-voffset="['0','0','0','0']" data-whitespace="nowrap" data-width="full" style="z-index: 5;background-color:rgba(0, 0, 0, 0.6);"></div>
                            <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-1-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['328','240','200','120']" data-fontsize="['65','36','30','26']" data-lineheight="['60','32','60','60']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="x:[-105%];s:1000;e:Power4.slideInRight;" data-transform_out="y:[100%];s:1000;s:1000;e:Power2.slideInRight;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="z-index: 5; text-align: center; letter-spacing: 2.4px; color:#c59d5f; font-weight: 400; font-family: 'Great Vibes', cursive;"><?= ($sliders['banner_first_text']) ? $sliders['banner_first_text'] : ""; ?></div>
                            <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-1-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['410','280','270','170']" data-fontsize="['45','28','22','18']" data-lineheight="['60','32','30','28']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="x:[105%];s:1000;e:Power4.slideInLeft;" data-transform_out="y:[100%];s:1000;s:1000;e:Power2.slideInLeft;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" data-textAlign="['center','center','center','center']" style="z-index: 5; font-weight: 700; font-family: 'Raleway', sans-serif; letter-spacing: 1.8px; color:#ffffff;"><?= ($sliders['banner_second_text']) ? $sliders['banner_second_text'] : ""; ?></div>
                            <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-1-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['548','370','330','230']" data-fontsize="['20','20','18','14']" data-lineheight="['26','26','26','22']" data-width="['809','809','668','420']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="x:[105%];s:1000;e:Power4.slideInLeft;" data-transform_out="y:[100%];s:1000;s:1000;e:Power2.slideInLeft;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" data-textAlign="['center','center','center','center']" style="z-index: 5; white-space: normal; font-weight: 400; font-family: 'Lato', sans-serif; letter-spacing: 0.8px; color:#bbbbbb;"><?= ($sliders['banner_third_text']) ? $sliders['banner_third_text'] : ""; ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Slider Section 2 -->

    <div class="clearfix"></div>

    <!-- Menu Card Section -->
    <div class="container-fluid no-left-padding no-right-padding menu-section">
        <?php if ($menuBookCategory['top_image'] != "") : ?>
            <span class="top-img"><img src="<?= base_url('assets/website/images/menu-book-category/' . $menuBookCategory['top_image']); ?>" alt="<?= $menuBookCategory['top_image']; ?>" /></span>
        <?php endif; ?>

        <?php if ($menuBookCategory['bottom_image'] != "") : ?>
            <span class="bottom-img"><img src="<?= base_url('assets/website/images/menu-book-category/' . $menuBookCategory['bottom_image']); ?>" alt="<?= $menuBookCategory['bottom_image']; ?>" /></span>
        <?php endif; ?>
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3><?= $menuBookCategory['menu_book_category_name']; ?></h3>
                <h4>menu card</h4>
            </div><!-- Section Header /- -->
            <!-- Row -->
            <div class="row">
                <?php foreach (array_slice($menuBook, 0, 10)  as $menu) : ?>
                    <!-- Menu Item -->
                    <div class="col-md-6">
                        <div class="menu-item">
                            <div class="item-thumb">
                                <div class="type-post">
                                    <div class="entry-cover asd">
                                        <a href="<?= base_url('menu/' . $menu['menu_book_category_slug'] . '/' . $menu['slug']); ?>" class="my-class">
                                            <i><img src="<?= base_url('assets/website/images/menu-book/' . $menu['menu_book_image']); ?>" alt="<?= $menu['menu_book_image']; ?>" style="width: 89px;" /></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <h3><?= $menu['menu_book_name']; ?></h3>

                            <span style="color: #777777;"><sup>IDR</sup><?= number_format($menu['menu_book_price'], 0, ',', '.'); ?></span>
                        </div>
                    </div><!-- Menu Item /- -->
                <?php endforeach; ?>
            </div><!-- Row /- -->
        </div><!-- Container /- -->
    </div><!-- Menu Card Section -->

    <div class="clearfix" style="margin-bottom: 10rem;"></div>

    <!-- Gallery Section -->
    <div class="container-fluid no-left-padding no-right-padding gallery-section">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Great Art</h3>
                <h4>GALLERY</h4>
            </div><!-- Section Header /- -->
            <div class="gallery-category">
                <ul id="filters">
                    <li><a data-filter="*" class="active" href="#" title="All">All</a></li>
                    <?php foreach ($categoryGallery as $category) : ?>
                        <li><a data-filter="<?= "." . $category['category_gallery_name']; ?>" href="#" title="<?= $category['category_gallery_name'] ?>"><?= $category['category_gallery_name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="gallery-list gallery-fitrow">
                    <?php foreach ($gallery as $gallerys) : ?>
                        <div class="gallery-box col-md-3 col-sm-4 col-xs-4 <?= $gallerys['category_gallery_name'] ?>">
                            <a href="<?= base_url('assets/website/images/gallery/' . $gallerys['gallery_image']); ?>"><img src="<?= base_url('assets/website/images/gallery/' . $gallerys['gallery_image']); ?>" alt="<?= $gallerys['gallery_image']; ?>" style="border-radius: 10px;" /></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- Row -->
        </div><!-- Container /- -->
    </div><!-- Gallery Section /- -->

    <div class="clearfix"></div>

    <!-- Latest Events -->
    <div class="container-fluid no-left-padding no-right-padding latest-events-section">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Latest Events</h3>
                <h4>DON'T MISS IT</h4>
            </div><!-- Section Header /- -->
            <!-- Row -->
            <div class="row">
                <?php foreach (array_slice($getEvents, 0, 3) as $events) : ?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="events-item">
                            <img src="<?= base_url('assets/website/images/blog/events/' . $events['blog_image_events']); ?>" alt="<?= $events['blog_image']; ?>" style="border-radius: 10px" />
                            <div class="event-content" style="border-radius: 10px">
                                <h4><?= $events['blog_title']; ?></h4>
                                <p><?= $events['blog_desc']; ?></p>
                                <span><i class="fa fa-clock-o"></i> Posted <?= date("d ", strtotime($events['blog_publish'])); ?><?= date('M', strtotime($events['blog_publish'])); ?>, <?= date('Y', strtotime($events['blog_publish'])); ?> - <?= date('H:i a', strtotime($events['blog_created_at'])); ?></span>
                                <a href="<?= base_url('blog/' . $events['blog_category_slug'] . '/' . $events['slug']); ?>" role="button" title="Know More" style="border-radius: 10px; font-size: 1rem;">Know More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div><!-- Row /- -->

            <div class="row">
                <div class="col-md-12 co-sm-12">
                    <a href="<?= base_url('events'); ?>" title="See All Events" class="btn third" style="border-radius: 24px; font-size: 1rem;">See All Events</a>
                </div>
            </div>
        </div><!-- Container /- -->
    </div><!-- Latest Events /- -->

    <div class="clearfix"></div>

    <!-- Testimonial Section -->
    <div class="container-fluid no-left-padding no-right-padding testimonial-section">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Our Customer Says</h3>
                <h4>TESTIMONIALS</h4>
            </div><!-- Section Header /- -->
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10 text-center">
                    <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <p>These days are all Happy and Free. These days are all share them with me oh baby. Come and listen to a story about a man named Jed - a poor mountaineer barely kept his family fed. Here's the story of a lovely lady who was bringing up three very lovely girls.</p>
                                <i><img src="<?= base_url(); ?>assets/website/images/quote.png" alt="Quote" /></i>
                                <h5>- Jhone Dheve</h5>
                            </div>
                            <div class="item">
                                <p>These days are all Happy and Free. These days are all share them with me oh baby. Come and listen to a story about a man named Jed - a poor mountaineer barely kept his family fed. Here's the story of a lovely lady who was bringing up three very lovely girls.</p>
                                <i><img src="<?= base_url(); ?>assets/website/images/quote.png" alt="Quote" /></i>
                                <h5>- Jhone Dheve</h5>
                            </div>
                            <div class="item">
                                <p>These days are all Happy and Free. These days are all share them with me oh baby. Come and listen to a story about a man named Jed - a poor mountaineer barely kept his family fed. Here's the story of a lovely lady who was bringing up three very lovely girls.</p>
                                <i><img src="<?= base_url(); ?>assets/website/images/quote.png" alt="Quote" /></i>
                                <h5>- Jhone Dheve</h5>
                            </div>
                            <div class="item">
                                <p>These days are all Happy and Free. These days are all share them with me oh baby. Come and listen to a story about a man named Jed - a poor mountaineer barely kept his family fed. Here's the story of a lovely lady who was bringing up three very lovely girls.</p>
                                <i><img src="<?= base_url(); ?>assets/website/images/quote.png" alt="Quote" /></i>
                                <h5>- Jhone Dheve</h5>
                            </div>
                        </div>
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#testimonial-carousel" data-slide-to="1"></li>
                            <li data-target="#testimonial-carousel" data-slide-to="2"></li>
                            <li data-target="#testimonial-carousel" data-slide-to="3"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!-- Container /- -->
    </div><!-- Testimonial Section /- -->

    <div class="clearfix"></div>

    <!-- Latest Blog Post -->
    <div class="container-fluid no-left-padding no-right-padding latest-post latest-post2">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Our Latest News</h3>
                <h4>BLOG</h4>
            </div><!-- Section Header /- -->
            <!-- Row -->
            <div class="row">
                <?php foreach (array_slice($getNews, 0, 2) as $blog) : ?>
                    <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
                        <div class="type-post">
                            <div class="entry-cover">
                                <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['slug']); ?>">
                                    <img src="<?= base_url('assets/website/images/blog/' . $blog['blog_image']); ?>" alt="<?= $blog['blog_image']; ?>" style="border-radius: 10px;" />
                                </a>
                            </div>
                            <div class="entry-content">
                                <div class="post-date">
                                    <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['slug']); ?>"> <?= date("d", strtotime($blog['blog_publish'])); ?>
                                        <span class="text-sm"><?= date('M', strtotime($blog['blog_publish'])); ?></span>
                                    </a>
                                </div>
                                <h3 class="entry-title">
                                    <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['slug']); ?>" title="<?= $blog['blog_title']; ?>">
                                        <?= $blog['blog_title']; ?>
                                    </a>
                                </h3>
                                <div class="entry-meta">
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Posted <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['slug']); ?>"><?= date('Y', strtotime($blog['blog_publish'])); ?>,<?= date(' H:i a', strtotime($blog['blog_created_at'])); ?></a></span>
                                    <span class="post-date"><i class="fa fa-user"></i>Author: <?= $blog['blog_author']; ?></span>
                                </div>
                                <?php if ($blog['blog_last_update'] != "0000-00-00") : ?>
                                    <div class="entry-meta">
                                        <span class="post-date"><i class="fa fa-clock-o"></i>Last Update <?= date("d ", strtotime($blog['blog_last_update'])); ?><?= date('M', strtotime($blog['blog_last_update'])); ?>,<?= date(' Y', strtotime($blog['blog_last_update'])); ?></span>
                                    </div>
                                <?php endif; ?>
                                <p><?= $blog['blog_desc']; ?></p>
                                <a href="<?= base_url('blog/' . $blog['blog_category_slug'] . '/' . $blog['slug']); ?>" title="Read More" style="border-radius: 10px; font-size: 1rem;">Know More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div><!-- Row /- -->

            <div class="row">
                <div class="col-md-12 co-sm-12">
                    <a href="<?= base_url('news'); ?>" title="See All News" class="btn third" style="border-radius: 24px; font-size: 1rem;">See All News</a>
                </div>
            </div>
        </div><!-- Container /- -->
    </div><!-- Latest Blog Post /- -->

    <div class="clearfix"></div>
</main>