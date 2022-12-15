<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Triquetra</span></strong>. All Rights Reserved
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/vendor/php-email-form/validate.js'); ?>"></script>
<script src="<?= base_url('assets/admin/js/jquery-3.6.0.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/js/datatables.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/js/datatables.bootstrap5.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/vendor/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?= base_url('assets/admin/vendor/select2/js/select2.full.min.js'); ?>"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets/admin/js/main.min.js'); ?>"></script>

<!-- Sweet Alert -->
<script type="text/javascript" src="<?= base_url('assets/website/js/sweetalert2.min.js'); ?>"></script>

<script>
    // sidebar active
    var url = window.location.href;

    $('ul.sidebar-nav li a').filter(function() {
        return this.href == url;
    }).removeClass('collapsed');

    $('ul.nav-content li a').filter(function() {
        return this.href == url;
    }).addClass('active');

    $('ul.nav-content li a').filter(function() {
        return this.href == url;
    }).parent().parent().addClass('show');
    // end sidebar active

    // Sweet Alert
    const flashDataSuccess = $('.flash-data-success').data('flashdata');

    if (flashDataSuccess) {
        Swal.fire({
            title: 'Congratulations',
            text: flashDataSuccess,
            icon: 'success'
        });
    }

    // Sweet Alert
    const flashDataError = $('.flash-data-error').data('flashdata');

    if (flashDataError) {
        Swal.fire({
            title: 'Sorry',
            text: flashDataError,
            icon: 'error'
        });
    }

    // Sweet Alert
    const flashDataErrorUpload = $('.flash-data-error-upload').data('flashdata');

    if (flashDataErrorUpload) {
        Swal.fire({
            title: 'Sorry',
            text: flashDataErrorUpload + ' Please try again.',
            icon: 'warning'
        });
    }

    // Sweet Alert
    const flashDataInfo = $('.flash-data-info-read').data('flashdata');

    if (flashDataInfo) {
        Swal.fire({
            title: 'Notification',
            text: flashDataInfo + ' Thank you.',
            icon: 'info'
        });
    }

    // call ckeditor
    $(function() {
        CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: '<?= base_url('assets/admin/vendor/kcfinder/browse.php'); ?>',
            filebrowserImageUploadUrl: '<?= base_url('assets/admin/vendor/kcfinder/upload.php'); ?>',
            filebrowserUploadMethod: "form",
            height: '300px'
        });
    });
    // end call ckeditor


    function format(d) {
        // `d` is the original data object for the row
        var tbody = "";
        var showHide = "";
        var level = "";
        var category = "";
        var urls = "";
        var parent = "";
        var position = "";

        if (d.child.length === 0) {
            return (
                '<div class="card">' +
                '<div class="card-body pb-0 pt-3">' +
                '<table id="menu" class="table table-sm table-dark" style="width:100%">' +
                '<thead>' +
                '<tr>' +
                '<th><small>Position</small></th>' +
                '<th><small>Sub Menu Name</small></th>' +
                '<th><small>Parent</small></th>' +
                '<th><small>Sub Menu Url</small></th>' +
                '<th class="text-center"><small>Menu Level</small></th>' +
                '<th><small>Status</small></th>' +
                '<th class="text-end"><small>#</small></th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<td colspan="7" class="text-center" style="width: 10%"><span class="bagde rounded-pill bg-danger small" style="padding: 0.1rem 0.5rem 0.1rem 0.5rem;">Empty Sub Menu</span></td>' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>'
            );
        } else {

            for (var i = 0; i < d.child.length; i++) {
                if (d.child[i].status == "Show") {
                    showHide = '<span class="badge rounded-pill bg-success">' + d.child[i].status + '</span>';
                } else {
                    showHide = '<span class="badge rounded-pill bg-secondary">' + d.child[i].status + '</span>';
                }

                if (d.child[i].category_level == "parent") {
                    level = '<span class="badge rounded-pill bg-primary">' + d.child[i].category_level + '</span>';
                } else {
                    level = '<span class="badge rounded-pill bg-light text-dark">' + d.child[i].category_level + '</span>';
                }

                if (d.child[i].category_url == null || d.child[i].category_url == "") {
                    urls = '<span class="badge rounded-pill bg-danger">urls not found</span>';
                } else {
                    urls = d.child[i].category_url;
                }

                if (d.child[i].category_page == "Module") {
                    category = '<span class="badge rounded-pill bg-light text-dark">' + d.child[i].category_page + '</span>'
                } else if (d.child[i].category_page == "Static Page") {
                    category = '<span class="badge rounded-pill bg-secondary">' + d.child[i].category_page + '</span>'
                } else {
                    category = '<span class="badge rounded-pill bg-dark">category not found</span>'
                }

                position = `<a href="` + window.location.origin + `/dev_milou/edit-position-down/` + d.child[i].category_id + `" id="down" role="button" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-down"></i></a>
                        <a href="` + window.location.origin + `/dev_milou/edit-position-up/` + d.child[i].category_id + `" id="up" role="button" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-up"></i></a>`;

                tbody +=
                    '<tr>' +
                    '<td class="text-center"><small>' +
                    position +
                    '</small></td>' +
                    '<td><small>' +
                    d.child[i].category_name +
                    '</small></td>' +
                    '<td><small>' +
                    urls +
                    '</small></td>' +
                    '<td><small>' +
                    d.child[i].parent_name +
                    '</small></td>' +
                    '<td class="text-center"><small>' +
                    level +
                    '</small></td>' +
                    '<td class="text-center"><small>' +
                    category +
                    '</small></td>' +
                    '<td><small>' +
                    showHide +
                    '</small></td>' +
                    '<td class="text-end">' +
                    '<a href="' + window.location.origin + '/dev_milou/page-edit-menu-setting/child/' + d.child[i].category_id + '" role="button" class="btn btn-sm btn-warning" style="margin-left: .3rem"><i class="bi bi-pencil-fill"></i></a>' +
                    '<button type="button" onclick="getId(' + d.child[i].category_id + ')" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletemenu" style="margin-left: .3rem"><i class="bi bi-trash3-fill"></i></button>' +
                    '</td>'
            }

            return (
                '<div class="card">' +
                '<div class="card-body pb-0 pt-3">' +
                '<div class="table-responsive">' +
                '<table id="menu" class="table table-sm table-dark" style="width:100%">' +
                '<thead>' +
                '<tr>' +
                '<th class="text-center"><small>Position</small></th>' +
                '<th><small>Sub Menu Name</small></th>' +
                '<th><small>Sub Menu Url</small></th>' +
                '<th><small>Parent</small></th>' +
                '<th class="text-center"><small>Menu Level</small></th>' +
                '<th class="text-center"><small>Category</small></th>' +
                '<th><small>Status</small></th>' +
                '<th class="text-end"><small>#</small></th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                tbody +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
        }
    }

    // updateCareerUntil
    var nIntervId;

    function updateStatusCareer() {
        nIntervId = setInterval(updateCareerUntil, 1000);
    }

    function updateCareerUntil() {
        var url = '<?= base_url('admin/updateUntilCareer'); ?>';
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();

        var output = d.getFullYear() + '-' +
            (('' + month).length < 2 ? '0' : '') + month + '-' +
            (('' + day).length < 2 ? '0' : '') + day;

        $.ajax({
            url: url,
            method: "post",
            data: {
                output: output
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
            }
        });
    }

    $(function() {
        updateStatusCareer();
    });
    // end updateCareerUntil

    // count inbox
    function countInbox() {
        var url = window.location.origin + "/dev_milou/admin/count_inbox";

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                var message = "";

                if (response != 0) {
                    message = response + " New!";
                }
                $("#count-inbox").html(message);
            }
        });
    }

    $(function() {
        countInbox()();
    });
    // end count inbox

    function getId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_category_name/" + id;
        var inputHidden = $("input[name='category_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-category-name").html("Please confirm you want to remove menu <b>" + response.category_name + "</b>");
                $("input[name='parent_id']").val(response.parent_id);
            }
        });
    }

    function getCareerId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_career_title/" + id;
        var inputHidden = $("input[name='career_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-career-title").html("Please confirm you want to remove career <b>" + response.career_title + "</b>");
            }
        });
    }

    function getBannerSliderId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_banner_slider/" + id;
        var inputHidden = $("input[name='banner_slider_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-banner-slider").html("Please confirm you want to remove <b>" + response.banner_slider_image + "</b>");
            }
        });
    }

    function getStaticPageId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_static_pages/" + id;
        var inputHidden = $("input[name='static_page_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-static-page").html("Please confirm you want to remove <b>" + response.static_page_title + "</b>");

                var inputHidden = $("input[name='category_id']").val(response.category_id);
            }
        });
    }

    function getGalleryId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_gallerys/" + id;
        var inputHidden = $("input[name='gallery_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-gallery").html("Please confirm you want to remove <b>" + response.gallery_image + "</b>");
            }
        });
    }

    function getCategoryGalleryId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_category_gallerys/" + id;
        var inputHidden = $("input[name='category_gallery_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-category-gallery").html("Please confirm you want to remove <b>" + response.category_gallery_name + "</b>");
                $("input[name='category_name']").val(response.category_gallery_name);
            }
        });
    }

    function getInstagramId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_instagram/" + id;
        var inputHidden = $("input[name='instagram_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                var html = "";
                $("#get-instagram").html("Please confirm you want to remove <b>" + response.instagram_url + "</b>");
                $("input[name='ig_url']").val(response.instagram_url);
                $("#img-instagram").attr('src', '<?= base_url('assets/website/images/instagram/') ?>' + response.instagram_image);

                if (response.status == "Show") {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>';
                } else {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Hide" id="flexSwitchCheckChecked">' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked" style="display: none;">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked">Hide</label>';
                }

                $("#formSwitch").html(html);
            }
        });
    }

    function getBlogId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_blog/" + id;
        var inputHidden = $("input[name='blog_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-blog").html("Please confirm you want to remove <b>" + response.blog_title + "</b>");
            }
        });
    }

    function getBlogCategoryId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_blog_category/" + id;
        var inputHidden = $("input[name='blog_category_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                //$("#get-blog-category").html("Please confirm you want to remove <b>" + response.blog_category_name + "</b>");
                $("input[name='blog_category_name']").val(response.blog_category_name);

                if (response.status == "Show") {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>';
                } else {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Hide" id="flexSwitchCheckChecked">' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked" style="display: none;">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked">Hide</label>';
                }

                $(".show-status").html(html);
            }
        });
    }

    function getBlogTagId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_blog_tag/" + id;
        var inputHidden = $("input[name='blog_tag_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                //$("#get-blog-category").html("Please confirm you want to remove <b>" + response.blog_category_name + "</b>");
                $("input[name='blog_tag_name']").val(response.blog_tag_name);

                if (response.blog_tag_status == "Show") {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>';
                } else {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Hide" id="flexSwitchCheckChecked">' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked" style="display: none;">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked">Hide</label>';
                }

                $(".show-status-tag").html(html);
            }
        });
    }

    function getMenuBookCategoryId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_menu_book_category/" + id;
        var inputHidden = $("input[name='menu_book_category_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                console.log(response)
                var html = "";
                var topImage = "";
                var bottomImage = "";
                var homePage = "";
                // $("#get-menu-book-category").html("Please confirm you want to remove <b>" + response.menu_book_category_name + "</b>");
                $("input[name='menu_book_category_name']").val(response.menu_book_category_name);

                if (response.top_image == "" || response.bottom_image == "") {
                    topImage = '<span class="badge rounded-pill bg-danger">Image not found</span>';
                    bottomImage = '<span class="badge rounded-pill bg-danger">Image not found</span>';
                } else {
                    topImage = '<img src="<?= base_url('assets/website/images/menu-book-category/'); ?>' + response.top_image + '" alt="' + response.top_image + '" class="img-thumbnail" />';
                    bottomImage = '<img src="<?= base_url('assets/website/images/menu-book-category/'); ?>' + response.bottom_image + '" alt="' + response.bottom_image + '" class="img-thumbnail" />';
                }

                if (response.for_home == "True") {
                    homePage = '<input class="form-check-input true-false" type="checkbox" name="for_home" value="True" id="flexSwitchCheckChecked" checked>' +
                        '<label class="form-check-label showss" for="flexSwitchCheckChecked">True</label>' +
                        '<label class="form-check-label hidess" for="flexSwitchCheckChecked" style="display: none;">False</label>';
                } else {
                    homePage = '<input class="form-check-input true-false" type="checkbox" name="for_home" value="False" id="flexSwitchCheckChecked">' +
                        '<label class="form-check-label showss" for="flexSwitchCheckChecked" style="display: none;">True</label>' +
                        '<label class="form-check-label hidess" for="flexSwitchCheckChecked">False</label>';
                }

                if (response.status == "Show") {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>';
                } else {
                    html = '<input class="form-check-input show-hide" type="checkbox" name="status" value="Hide" id="flexSwitchCheckChecked">' +
                        '<label class="form-check-label shows" for="flexSwitchCheckChecked" style="display: none;">Show</label>' +
                        '<label class="form-check-label hides" for="flexSwitchCheckChecked">Hide</label>';
                }

                $(".show-status").html(html);
                $(".show-home-page").html(homePage);
                $(".thumbnail-top-image").html(topImage);
                $(".thumbnail-bottom-image").html(bottomImage);
            }
        });
    }

    function getMenuBookId(id) {
        var url = window.location.origin + "/dev_milou/admin/get_menu_book/" + id;
        var inputHidden = $("input[name='menu_book_id']").val(id);

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            async: true,
            success: function(response) {
                $("#get-menu-book").html("Please confirm you want to remove menu <b>" + response.menu_book_name + "</b>");
            }
        });
    }


    $(document).ready(function() {

        $(".datepicker").datepicker({
            showAnim: 'slideDown',
            dateFormat: 'yy-mm-dd'
        });

        $('.select2').select2({
            width: '100%'
        });

        $('.select2-modal').select2({
            width: '100%',
            dropdownParent: $('#addmenu')
        });

        $(".js-example-tokenizer").select2({
            width: '100%',
            tags: true
        });

        $('#staticPageTable').DataTable({
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                    "orderable": false,
                    "targets": -1
                },
                {
                    "orderable": false,
                    "targets": 2
                },
                {
                    "orderable": false,
                    "targets": 3
                }
            ]
        });

        $('#sliderTable').DataTable({
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                    "orderable": false,
                    "targets": 0
                }, {
                    "orderable": false,
                    "targets": -1
                },
                {
                    "orderable": false,
                    "targets": 4
                },
            ]
        });

        $("#galleryTable").DataTable({
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                "orderable": false,
                "targets": 2
            }, {
                "orderable": false,
                "targets": -1
            }, {
                "orderable": false,
                "targets": 0
            }],
            info: false,
        });

        $("#categoryGalleryTable").DataTable({
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                "orderable": false,
                "targets": 1
            }],
            info: false,
        });

        $("#instagramTable").DataTable({
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    "orderable": false,
                    "targets": 2
                },
                {
                    "orderable": false,
                    "targets": 3
                },
                {
                    "orderable": false,
                    "targets": -1
                }
            ]
        });

        $("#blogCategoryTable").DataTable({
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    "orderable": false,
                    "targets": -1
                },
                {
                    "orderable": false,
                    "targets": 2
                }
            ]
        });

        $("#menuBookCategoryTable").DataTable({
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    "orderable": false,
                    "targets": -1
                },
                {
                    "orderable": false,
                    "targets": 1
                },
                {
                    "orderable": false,
                    "targets": 2
                },
                {
                    "orderable": false,
                    "targets": 3
                },
                {
                    "orderable": false,
                    "targets": 4
                }
            ]
        });

        // table careers
        var siteTable = $('#careersTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: window.location.origin + "/dev_milou/admin/getCareer",
                type: "post"
            },
            columns: [{
                data: 'career_title',
                orderable: true,
            }, {
                data: 'career_from',
                className: 'text-center align-middle',
                orderable: false
            }, {
                data: 'career_until',
                className: 'text-center align-middle',
                orderable: false
            }, {
                data: 'career_status',
                className: 'text-center align-middle',
                orderable: false,
                render: function(data) {
                    var showHide = "";

                    if (data === "Show") {
                        showHide = `<span class="badge rounded-pill bg-success">${data}</span>`
                    } else {
                        showHide = `<span class="badge rounded-pill bg-secondary">${data}</span>`
                    }
                    return showHide;
                }
            }, {
                data: 'career_id',
                orderable: false,
                className: 'text-end align-middle',
                render: function(data, type, row) {
                    return `<a href="` + window.location.origin + `/dev_milou/page-edit-career/` + data + `" role="button" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <button type="button" onclick="getCareerId(` + data + `)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletecareer"><i class="bi bi-trash3-fill"></i></button>`;
                }
            }],
            order: [
                [0, 'desc']
            ],
        });
        // end table careers

        // table blog
        var siteTable = $('#blogTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: window.location.origin + "/dev_milou/admin/blog",
                type: "post"
            },
            columns: [{
                data: 'blog_image',
                className: 'text-center align-middle small',
                orderable: false,
                render: function(data, type, row) {
                    var image = '<img src="<?= base_url('assets/website/images/blog/'); ?>' + data + '" alt="' + data + '" style="width: 100%"/>';

                    return image;
                }
            }, {
                data: 'blog_title',
                className: 'align-middle small',
                orderable: false,
            }, {
                data: 'blog_category_name',
                className: 'align-middle small',
                orderable: true
            }, {
                data: 'blog_publish',
                className: 'align-middle small',
                orderable: true
            }, {
                data: 'blog_last_update',
                className: 'align-middle small',
                orderable: true
            }, {
                data: 'blog_status',
                className: 'text-center align-middle small',
                orderable: false,
                render: function(data) {
                    var showHide = "";

                    if (data === "Show") {
                        showHide = `<span class="badge rounded-pill bg-success">${data}</span>`
                    } else {
                        showHide = `<span class="badge rounded-pill bg-secondary">${data}</span>`
                    }
                    return showHide;
                }
            }, {
                data: 'blog_id',
                orderable: false,
                className: 'text-end align-middle small',
                render: function(data, type, row) {
                    return `<a href="` + window.location.origin + `/dev_milou/page-edit-blogs/` + data + `" role="button" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <button type="button" onclick="getBlogId(` + data + `)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteblog"><i class="bi bi-trash3-fill"></i></button>`;
                }
            }],
            order: [
                [1, 'desc']
            ],
        });
        // end table blog


        // table menu book management
        var siteTable = $('#menuBookTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: window.location.origin + "/dev_milou/admin/menuBook",
                type: "post"
            },
            columns: [{
                data: 'menu_book_image',
                className: 'text-center align-middle small',
                orderable: false,
                render: function(data, type, row) {
                    var image = '<img src="<?= base_url('assets/website/images/menu-book/'); ?>' + data + '" alt="' + data + '" style="width: 100%"/>';

                    return image;
                }
            }, {
                data: 'menu_book_category_name',
                className: 'text-center align-middle small',
                orderable: false,
            }, {
                data: 'menu_book_name',
                className: 'align-middle small',
                orderable: true,
            }, {
                data: 'menu_book_desc',
                className: 'align-middle small',
                orderable: true,
            }, {
                data: 'menu_book_price',
                className: 'align-middle small text-center',
                orderable: true,
                render: function(data, type, row) {
                    var price = new Intl.NumberFormat("id-ID", {
                        currency: "IDR"
                    }).format(data) + " IDR";

                    return price;
                }
            }, {
                data: 'menu_book_status',
                className: 'text-center align-middle small',
                orderable: false,
                render: function(data) {
                    var showHide = "";

                    if (data === "Show") {
                        showHide = `<span class="badge rounded-pill bg-success">${data}</span>`
                    } else {
                        showHide = `<span class="badge rounded-pill bg-secondary">${data}</span>`
                    }
                    return showHide;
                }
            }, {
                data: 'menu_book_id',
                orderable: false,
                className: 'text-end align-middle small',
                render: function(data, type, row) {
                    return `<a href="` + window.location.origin + `/dev_milou/page-edit-menu-book/` + data + `" role="button" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <button type="button" onclick="getMenuBookId(` + data + `)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletemenubook"><i class="bi bi-trash3-fill"></i></button>`;
                }
            }],
            order: [
                [2, 'desc']
            ],
        });
        // end table menu book management


        // table contact us
        var siteTable = $('#inboxTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: window.location.origin + "/dev_milou/admin/getContactUs",
                type: "post"
            },
            columns: [{
                className: 'text-center',
                orderable: false,
                data: "status",
                defaultContent: '',
                width: '15%',
                render: function(data) {
                    var statusRead = "";

                    if (data === "Read") {
                        statusRead = `<span class="badge rounded-pill bg-success">${data}</span>`
                    } else {
                        statusRead = `<span class="badge rounded-pill bg-warning">${data}</span>`
                    }
                    return statusRead;
                }
            }, {
                data: 'contact_name',
                orderable: true,
                width: '25%',
            }, {
                data: 'contact_phone',
                orderable: true,
            }, {
                data: 'contact_address',
                orderable: true,
                width: '25%',
            }, {
                data: 'contact_email',
                orderable: true
            }, {
                data: 'contact_id',
                orderable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    return `<a href="` + window.location.origin + `/dev_milou/inbox-detail/` + data + `" role="button" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>`;
                }
            }],
            order: [
                [1, 'desc']
            ],
        });

        $('#inboxTable').addClass('small');
        // end table menu management


        // table menu management
        var siteTable = $('#menu').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: window.location.origin + "/dev_milou/admin/category",
                type: "post"
            },
            columns: [{
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
                width: '10%'
            }, {
                data: 'category_position',
                orderable: true,
                className: 'text-center',
                render: function(data, type, row) {
                    var html = "";

                    html = `<a href="` + window.location.origin + `/dev_milou/edit-position-down/` + row.category_id + `" id="down" role="button" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-down"></i></a>
                        <a href="` + window.location.origin + `/dev_milou/edit-position-up/` + row.category_id + `" id="up" role="button" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-up"></i></a>`;

                    return html;
                }
            }, {
                data: 'category_name',
                orderable: false,
            }, {
                data: 'category_url',
                orderable: false,
                render: function(data) {
                    var url = "";

                    if (data === null || data === '') {
                        url = `<span class="badge rounded-pill bg-danger">urls not found</span>`
                    } else {
                        url = data;
                    }
                    return url;
                }
            }, {
                data: 'category_page',
                className: 'text-center',
                orderable: false,
                render: function(data) {
                    var category = "";

                    if (data === "Module") {
                        category = `<span class="badge rounded-pill bg-dark">${data}</span>`
                    } else if (data === "Static Page") {
                        category = `<span class="badge rounded-pill bg-secondary">${data}</span>`
                    } else {
                        category = `<span class="badge rounded-pill bg-danger">category not found</span>`
                    }
                    return category;
                }
            }, {
                data: 'status',
                className: 'text-center',
                orderable: false,
                render: function(data) {
                    var showHide = "";

                    if (data === "Show") {
                        showHide = `<span class="badge rounded-pill bg-success">${data}</span>`
                    } else {
                        showHide = `<span class="badge rounded-pill bg-secondary">${data}</span>`
                    }
                    return showHide;
                }
            }, {
                data: 'category_id',
                orderable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    return `<a href="` + window.location.origin + `/dev_milou/page-edit-menu-setting/parent/` + data + `" role="button" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <button type="button" onclick="getId(` + data + `)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletemenu"><i class="bi bi-trash3-fill"></i></button>`;
                }
            }],
            order: [
                [1, 'asc']
            ],
        });

        $('#menu tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = siteTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#menu').addClass('small');
        // end table menu management

        // add menu
        var add = document.getElementById("category_level_add");

        function onChange() {
            var valueAdd = add.value;
            var parentAdd = document.getElementById("parent-add");
            var parent1 = document.getElementById("parent1");

            if (valueAdd === "Child") {
                parentAdd.removeAttribute("hidden");
                parent1.setAttribute("required", "required");
            } else if (valueAdd === "Parent") {
                parentAdd.setAttribute("hidden", "hidden");
                parent1.removeAttribute("required");
                $("#parent-add").val("");
            }
        }
        add.onchange = onChange;
        onChange();


        var page = document.getElementById("category_page_add");

        function onChangePage() {
            var valuePageAdd = page.value;
            var staticPage = document.getElementById("static-page");
            var modules = document.getElementById("module");

            if (valuePageAdd === "Static Page") {
                staticPage.removeAttribute("hidden");
                modules.setAttribute("hidden", "hidden");
            } else if (valuePageAdd === "Module") {
                modules.removeAttribute("hidden");
                staticPage.setAttribute("hidden", "hidden");
            }
        }
        page.onchange = onChangePage;
        onChangePage();
        // end add menu

        $(document).on("click", ".show-hide", function() {
            if ($(this).is(":checked")) {
                $("input[name='status']").val("Show");
                $(".hides").hide();
                $(".shows").show();
            } else {
                $("input[name='status']").val("Hide");
                $(".hides").show();
                $(".shows").hide();
            }
        });

        $(document).on("click", ".true-false", function() {
            if ($(this).is(":checked")) {
                $("input[name='for_home']").val("True");
                $(".hidess").hide();
                $(".showss").show();
            } else {
                $("input[name='for_home']").val("False");
                $(".hidess").show();
                $(".showss").hide();
            }
        });

        $("#configEdit").on("click", function() {
            $(".config").removeAttr("disabled");
            $(".configSave").removeAttr("hidden");

            var edit = document.getElementById("configEdit");

            edit.setAttribute("hidden", "hidden");

            $("#working").removeAttr("hidden");
        });
    });
</script>

</body>

</html>