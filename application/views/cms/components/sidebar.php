<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url("home-admin"); ?>">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "inbox-detail") ? "" : "collapsed"; ?>" href="<?= base_url("inbox"); ?>">
                <i class="bi bi-inbox"></i>
                <span>
                    Inbox (Contact Us)
                    <span class="badge rounded-pill bg-danger" id="count-inbox"></span>
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url("career"); ?>">
                <i class="bi bi-briefcase"></i>
                <span>Carrers</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "basic-configuration" || $this->uri->segment(1) == "instagram-footer") ? "" : "collapsed"; ?>" data-bs-target="#config" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Configuration</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="config" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url("basic-configuration"); ?>">
                        <i class="bi bi-circle"></i><span>Basic Configuration</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("ig-footer"); ?>">
                        <i class="bi bi-circle"></i><span>Instagram (Footer)</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("banner-side-blog"); ?>">
                        <i class="bi bi-circle"></i><span>Banner (Side Blog)</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "menu-setting" || $this->uri->segment(1) == "page-edit-menu-setting" || $this->uri->segment(1) == "static-pages" || $this->uri->segment(1) == "page-add-static-pages" || $this->uri->segment(1) == "page-edit-static-pages") ? "" : "collapsed"; ?>" data-bs-target="#menumanagement" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Menu Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menumanagement" class="nav-content collapse <?= ($this->uri->segment(1) == "page-edit-menu-setting" || $this->uri->segment(1) == "page-add-static-pages" || $this->uri->segment(1) == "page-edit-static-pages") ? "show" : ""; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url("menu-setting"); ?>" class="<?= ($this->uri->segment(1) == "page-edit-menu-setting") ? "active" : ""; ?>">
                        <i class="bi bi-circle"></i><span>Menu Settings</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("static-pages"); ?>" class="<?= ($this->uri->segment(1) == "page-add-static-pages" || $this->uri->segment(1) == "page-edit-static-pages") ? "active" : ""; ?>">
                        <i class="bi bi-circle"></i><span>Static Page</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "banner-slider" || $this->uri->segment(1) == "page-edit-banner-slider") ? "" : "collapsed"; ?>" data-bs-target="#bannergallery" data-bs-toggle="collapse" href="#">
                <i class="bi bi-images"></i><span>Banner & Gallery</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="bannergallery" class="nav-content collapse <?= ($this->uri->segment(1) == "page-edit-banner-slider") ? "show" : ""; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url("banner-slider"); ?>" class="<?= ($this->uri->segment(1) == "page-edit-banner-slider") ? "active" : ""; ?>">
                        <i class="bi bi-circle"></i><span>Banner Slider</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url("gallerys"); ?>" class="<?= ($this->uri->segment(1) == "page-edit-gallerys") ? "active" : ""; ?>">
                        <i class="bi bi-circle"></i><span>Gallery</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "blogs" || $this->uri->segment(1) == "page-add-blogs" || $this->uri->segment(1) == "page-edit-blogs" || $this->uri->segment(1) == "blogs-category") ? "" : "collapsed"; ?>" data-bs-target="#blogmanagement" data-bs-toggle="collapse" href="#">
                <i class="bi bi-newspaper"></i><span>Blog Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="blogmanagement" class="nav-content collapse <?= ($this->uri->segment(1) == "page-add-blogs" || $this->uri->segment(1) == "page-edit-blogs") ? "show" : ""; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url("blogs"); ?>" class="<?= ($this->uri->segment(1) == "page-add-blogs" || $this->uri->segment(1) == "page-edit-blogs") ? "active" : ""; ?>">
                        <i class="bi bi-circle"></i><span>Blog</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("blogs-category"); ?>" class="">
                        <i class="bi bi-circle"></i><span>Blog Category</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("blogs-tags"); ?>" class="">
                        <i class="bi bi-circle"></i><span>Blog Tag</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "menu-book" || $this->uri->segment(1) == "page-add-menu-book" || $this->uri->segment(1) == "page-edit-menu-book" || $this->uri->segment(1) == "menu-book-category") ? "" : "collapsed"; ?>" data-bs-target="#menubookmanagement" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Menu Book Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menubookmanagement" class="nav-content collapse <?= ($this->uri->segment(1) == "page-add-menu-book" || $this->uri->segment(1) == "page-edit-menu-book") ? "show" : ""; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url("menu-book"); ?>" class="<?= ($this->uri->segment(1) == "page-add-menu-book" || $this->uri->segment(1) == "page-edit-menu-book") ? "active" : ""; ?>">
                        <i class="bi bi-circle"></i><span>Menu Book</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("menu-book-category"); ?>" class="">
                        <i class="bi bi-circle"></i><span>Menu Book Category</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->
    </ul>

</aside>
<!-- End Sidebar-->