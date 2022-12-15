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
</style>

<!-- Page Header -->
<div class="container-header no-left-padding no-right-padding page-banner text-center" style="background-image: url(<?= base_url('/assets/website/images/banner-page/' . $configuration['banner_default']); ?>">
    <!-- Container -->
    <div class="container">
        <h3><?= $getMenuBook['menu_book_name']; ?></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li><a href="<?= base_url('menu'); ?>">Menu</a></li>
            <li><a href="<?= base_url('menu/category/' . $menuBookCategory['menu_book_category_slug']); ?>"><?= $menuBookCategory['menu_book_category_name']; ?></a></li>
            <li class="active"><?= $getMenuBook['menu_book_name']; ?></li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Header /- -->

<div class="clearfix"></div>

<main class="site-main">
    <!-- Menu Section -->
    <div class="container-fluid no-left-padding no-right-padding menu-section menu-cards">
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 25px;">
                    <a href="<?= base_url('menu'); ?>" class="my-class">
                        <i class="fa fa-long-arrow-left"></i> Menu
                    </a>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="<?= base_url('assets/website/images/menu-book/' . $getMenuBook['menu_book_image']); ?>" alt="<?= $getMenuBook['menu_book_image']; ?>" style="border-radius: 10px; width: 100%" />
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding-top: 15px; padding-bottom: 15px;">
                    <div class="section-header section-header2">
                        <h3><?= $getMenuBook['menu_book_name']; ?></h3>
                        <h4><?= $menuBookCategory['menu_book_category_name']; ?></h4>
                    </div>
                    <div class="form-group">
                        <h4><label>Description</label></h4>
                        <h5><?= $getMenuBook['menu_book_desc']; ?></h4>
                    </div>
                    <div class="form-group">
                        <h4>
                            <span class="label label-default" title="Price">
                                IDR <?= number_format($getMenuBook['menu_book_price'], 0, ',', '.'); ?>
                            </span>
                        </h4>
                    </div>
                </div>
            </div><!-- Row /- -->
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
                    <a href="<?= base_url('menu/category/' . $category['menu_book_category_id'] . "/"  . $category['menu_book_category_slug']); ?>" class="my-class" title="<?= $category['menu_book_category_name']; ?>">
                        <div class="card text-center">
                            <h5><?= $category['menu_book_category_name']; ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div><!-- Row /- -->
    </div><!-- Container -->

</main>