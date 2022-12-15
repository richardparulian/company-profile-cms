<style>
    .card {
        background: #fff;
        border-radius: 24px;
        display: inline-block;
        padding-top: 5px;
        padding-bottom: 5px;
        position: relative;
        min-width: 100%;
        max-width: 100%;
    }

    .card {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .card:hover {
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    a.my-class {
        color: #777777;
    }

    a.my-class:hover {
        color: #c59d5f;
    }

    a.my-class h3 {
        color: #777777;
    }

    a.my-class h3:hover {
        color: #c59d5f;
    }

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

    .form-control:focus {
        border-color: #c59d5f;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(102 175 233 / 60%);
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(233 169 102 / 60%);
    }

    .btn {
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
        border: 2px solid #e74c3c;
        border-radius: 24px;
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

    .bttrlazyloading-wrapper {
        background-repeat: no-repeat;
        background-position: center;
        display: block;
        border-radius: 50%;
    }

    .bttrlazyloading,
    .bttrlazyloading-clone {
        margin: 0;
        padding: 0;
        border: 0;
        display: block;
        height: 89px;
        max-width: 89px;
    }
</style>

<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url('./assets/website/images/banner-page/<?= $configuration['banner_default']; ?>');">
    <!-- Container -->
    <div class="container">
        <h3>Menu</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li class="active">Menu</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Menu Section -->
    <div class="container-fluid no-left-padding no-right-padding menu-section menu-cards">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center">
                <h3>Our Menu</h3>
                <h4>Make a choice your menu</h4>
            </div><!-- Section Header /- -->

            <form action="<?= base_url('menu-search-post'); ?>" method="post" style="margin-bottom: 7rem;">
                <div class="row">
                    <div class="col-md-6 col-sm-12" style="display: flex;">
                        <input type="text" class="form-control" name="search_menu_book" placeholder="Search by Menu Name or Description..." style="border-radius: 24px; height: 4.5rem; margin-right: 15px;" />
                        <button type="submit" class="btn third" style="line-height: 2em;"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>

            <!-- Row -->
            <div class="row">
                <?php foreach ($getMenuBook as $menu) : ?>
                    <!-- Menu Item -->
                    <div class="col-md-6">
                        <div class="menu-item">
                            <div class="item-thumb">
                                <div class="type-post">
                                    <div class="entry-cover">
                                        <a href="<?= base_url('menu/' . $menu['menu_book_category_slug'] . '/' . $menu['menu_book_id'] . "/" . $menu['slug']); ?>" class="my-class">
                                            <i><img src="" alt="<?= $menu['menu_book_image']; ?>" class="bttrlazyloading" data-bttrlazyloading-sm-src="<?= base_url('assets/website/images/menu-book/' . $menu['menu_book_image']); ?>" style="width: 89px;" /></i>
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

            <!-- pagination -->
            <div class="w-100 text-center">
                <?= $this->pagination->create_links(); ?>
            </div>
            <!-- end pagination -->
        </div><!-- Container -->
    </div>

    <!-- Container -->
    <div class=" container">
        <!-- Section Header -->
        <div class="section-header section-header2">
            <h4>Menu by Category</h4>
        </div><!-- Section Header /- -->

        <!-- Row -->
        <div class="row">
            <?php foreach ($getMenuBookCategory as $category) : ?>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6" style="padding-top: 5px; padding-bottom: 5px">
                    <a href="<?= base_url('menu/category/' . $category['menu_book_category_id'] . "/" . $category['menu_book_category_slug']); ?>" class="my-class" title="<?= $category['menu_book_category_name']; ?>">
                        <div class="card text-center">
                            <h5><?= $category['menu_book_category_name']; ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div><!-- Row /- -->
    </div><!-- Container -->

</main>