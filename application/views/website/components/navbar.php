<style>
    .logo-milou {
        width: 160px;
        height: 60px;
    }
</style>
<!-- Ownavigation -->
<nav class="navbar ownavigation">
    <!-- Container -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="logo-milou">
                <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url('assets/website/images/' . $configuration['company_logo_home']); ?>" alt="<?= $configuration['company_logo_home']; ?>"></a>
            </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= base_url(); ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                </li>
                <?php foreach ($menu as $menus) : ?>
                    <?php if ($menus['rows'] == 0) : ?>
                        <li>
                            <a href="<?= ($menus['category_url'] != null) ? $menus['category_url'] : "#"; ?>" title="<?= $menus['category_name']; ?>"><?= $menus['category_name']; ?></a>
                        </li>
                    <?php else : ?>
                        <li class="dropdown">
                            <a href="<?= ($menus['category_url'] != null) ? $menus['category_url'] : "#"; ?>" class="dropdown-toggle" title="<?= $menus['category_name']; ?>" role="button" aria-haspopup="true" aria-expanded="false"><?= $menus['category_name']; ?></a>
                            <i class="ddl-switch fa fa-angle-down"></i>
                            <ul class="dropdown-menu">
                                <?php foreach ($menus['child'] as $childs) : ?>
                                    <li><a href="<?= $childs['category_url']; ?>" title="<?= $childs['category_name'] ?>"><?= $childs['category_name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="loginpanel" class="desktop-hide">
            <div class="right" id="toggle">
                <a id="slideit" href="#slidepanel"><i class="fo-icons fa fa-inbox"></i></a>
                <a id="closeit" href="#slidepanel"><i class="fo-icons fa fa-close"></i></a>
            </div>
        </div>
    </div>
    <!-- Container /- -->
</nav>
<!-- Ownavigation /- -->
</header>
<!-- Header Section /- -->