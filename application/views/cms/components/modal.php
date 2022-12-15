<!-- add instagram footer -->
<div class="modal fade" id="addig" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Instagram</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="<?= base_url("add-ig-footer"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Instagram Url</label>
                            <input type="text" class="form-control" name="ig_url" placeholder="Instagram Url" required>
                        </div>

                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Instagram Image</label>
                            <input class="form-control form-control-sm" id="formFileSm" name="ig_image" type="file" required>
                            <small class="text-secondary">(size: 80 x 82 px - file image max 1MB)</small>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add instagram footer -->

<!-- edit instagram footer -->
<div class="modal fade" id="editig" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Instagram</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="<?= base_url("edit-ig-footer"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Instagram Url</label>
                            <input type="text" class="form-control" name="ig_url" value="" placeholder="Instagram Url" required>
                        </div>

                        <div class="col-md-10">
                            <label for="formFileSm" class="form-label">Upload Instagram Image</label>
                            <input class="form-control form-control-sm" id="formFileSm" name="ig_image" type="file">
                            <small class="text-secondary">(size: 80 x 82 px - file image max 1MB)</small>
                        </div>

                        <div class="col-md-2">
                            <img id="img-instagram" class="im-thumbnail" alt="" />
                        </div>

                        <div class="col-md-12">
                            <div id="formSwitch" class="form-check form-switch">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="instagram_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit instagram footer -->

<!-- delete instagram footer -->
<div class="modal fade" id="deleteig" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url("remove-ig-footer"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Instagram</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-instagram" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="instagram_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete instagram footer -->


<!-- add menu setting -->
<div class="modal fade" id="addmenu">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("add-menu-setting"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="menu-level" class="form-label">Menu Level</label>
                            <select id="category_level_add" class="form-select" name="category_level" required>
                                <option value="Parent" selected>Parent</option>
                                <option value="Child">Child</option>
                            </select>
                        </div>

                        <div id="parent-add" class="col-md-6" hidden>
                            <label for="parent-menu" class="form-label">Parent Menu</label>
                            <select class="form-select" name="parent" id="parent1" required>
                                <option value="" selected>Choose Parent Menu</option>
                                <?php foreach ($getCategory as $category) : ?>
                                    <option value="<?= $category['category_id']; ?>"><?= $category['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="menu-name" class="form-label">Menu Name</label>
                            <input type="text" class="form-control" name="menu_name" placeholder="Menu Name" required>
                        </div>

                        <div class="col-md-12">
                            <label for="category-page" class="form-label">Category Page</label>
                            <select id="category_page_add" class="form-select" name="category_page">
                                <option value="<?= null; ?>" selected disabled>Choose Category</option>
                                <option value="Static Page">Static Page</option>
                                <option value="Module">Module</option>
                            </select>
                        </div>

                        <div id="static-page" class="col-md-12" hidden>
                            <label for="static-page" class="form-label">Static Page</label>
                            <select class="form-select select2-modal" name="static_page">
                                <option value="<?= null; ?>" selected disabled>Choose Static Page</option>
                                <?php foreach ($getStaticPage as $page) : ?>
                                    <option value="<?= $page["static_page_id"]; ?>"><?= $page["static_page_title"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="module" class="col-md-12" hidden>
                            <label for="menu-name" class="form-label">Module</label>
                            <input type="text" class="form-control" name="module" placeholder="Module">
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add menu setting -->

<!-- delete menu setting -->
<div class="modal fade" id="deletemenu" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="<?= base_url("remove-menu-setting"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-category-name" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="category_id" value="" />
                    <input type="hidden" name="parent_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete menu setting -->


<!-- delete static page -->
<div class="modal fade" id="deletestaticpage" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="<?= base_url("remove-static-pages"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Static Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-static-page" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="static_page_id" value="" />
                    <input type="hidden" name="category_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete static page -->


<!-- add banner slider -->
<div class="modal fade" id="addbannerslider" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Banner Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="<?= base_url("add-banner-slider"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Banner</label>
                            <input class="form-control form-control-sm" id="formFileSm" name="slider" type="file" required>
                            <small class="text-secondary">(size: 1920 x 878 px - file image max 2MB)</small>
                        </div>

                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Banner Description Top <small class="text-danger">(optional)</small></label>
                            <input type="text" class="form-control" name="desc_1" placeholder="Description 1">
                        </div>

                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Banner Description Middle <small class="text-danger">(optional)</small></label>
                            <input type="text" class="form-control" name="desc_2" placeholder="Description 1">
                        </div>

                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Banner Description Bottom <small class="text-danger">(optional)</small></label>
                            <textarea class="form-control" name="desc_3" placeholder="Description 1"></textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add banner slider -->

<!-- delete banner slider -->
<div class="modal fade" id="deletebannerslider" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="<?= base_url("remove-banner-slider"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Banner Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-banner-slider" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="banner_slider_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete banner slider -->


<!-- add gallery -->
<div class="modal fade" id="addgallery" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="<?= base_url("add-gallerys"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Gallery Image</label>
                            <input class="form-control form-control-sm" id="formFileSm" name="gallery" type="file" required>
                            <small class="text-secondary">(size: 263 x 290 px - file image max 2MB)</small>
                        </div>

                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Category Gallery</label>
                            <select class="form-select" name="category_gallery" required>
                                <option value="" selected disabled>Choose Category</option>
                                <?php foreach ($getCategoryGallery as $category) : ?>
                                    <option value="<?= $category['category_gallery_id']; ?>"><?= $category['category_gallery_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add gallery -->

<!-- delete gallery -->
<div class="modal fade" id="deletegallery" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="<?= base_url("remove-gallerys"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-gallery" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="gallery_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete gallery -->


<!-- add gallery category -->
<div class="modal fade" id="addcategorygallery" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Gallery Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("add-gallerys-category"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Category Name</label>
                            <input class="form-control" name="category_name" type="text" placeholder="Category Name" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add gallery category -->

<!-- edit gallery category -->
<div class="modal fade" id="editcategorygallery" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gallery Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("edit-gallerys-category"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Category Name</label>
                            <input class="form-control" name="category_name" type="text" value="" placeholder="Category Name" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="category_gallery_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit gallery category -->

<!-- delete gallery category -->
<div class="modal fade" id="deletecategorygallery" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url("remove-gallerys-category"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Gallery Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-category-gallery" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="category_gallery_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete gallery category -->


<!-- delete blog -->
<div class="modal fade" id="deleteblog" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url("remove-blogs"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-blog" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="blog_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete blog -->


<!-- add blog category -->
<div class="modal fade" id="addblogcategory" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Blog Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("add-blogs-category"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="blog_category_name" placeholder="Category Name" required>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add blog category -->

<!-- edit blog category -->
<div class="modal fade" id="editblogcategory" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Blog Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("edit-blogs-category"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="blog_category_name" value="" placeholder="Category Name" required>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch show-status">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="blog_category_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit blog category -->

<!-- delete blog category -->
<div class="modal fade" id="deleteblogcategory" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url("remove-blogs-category"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-blog-category" class="modal-body">

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="blog_category_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete blog category -->


<!-- add blog tag -->
<div class="modal fade" id="addblogtag" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Blog Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("add-blogs-tags"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" name="blog_tag_name" placeholder="Tag Name" required>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add blog tag -->

<!-- edit blog tag -->
<div class="modal fade" id="editblogtag" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Blog Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url("edit-blogs-tags"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" name="blog_tag_name" value="" placeholder="Tag Name" required>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch show-status-tag">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="blog_tag_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit blog tag -->


<!-- delete menu book category -->
<div class="modal fade" id="deletemenubook" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url("remove-menu-book"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Menu Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-menu-book" class="modal-body">

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="menu_book_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete menu book category -->

<!-- add menu book category -->
<div class="modal fade" id="addmenubookcategory" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu Book Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="<?= base_url("add-menu-book-category"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="menu_book_category_name" value="" placeholder="Category Name" required>
                        </div>

                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Top Image <small class="text-danger">(optional)</small></label>
                            <input class="form-control form-control-sm" id="formFileSm" name="top_image_category" type="file">
                            <small class="text-secondary">(Size: 304 x 465 px - file image max 2MB)</small>
                        </div>
                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Bottom Image <small class="text-danger">(optional)</small></label>
                            <input class="form-control form-control-sm" id="formFileSm" name="bottom_image_category" type="file">
                            <small class="text-secondary">(Size: 191 x 217 px - file image max 2MB)</small>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add menu book category -->

<!-- edit menu book category -->
<div class="modal fade" id="editmenubookcategory" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Book Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="<?= base_url("edit-menu-book-category"); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputNanme4" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="menu_book_category_name" value="" placeholder="Category Name" required>
                        </div>

                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Top Image <small class="text-danger">(optional)</small></label>
                            <input class="form-control form-control-sm" id="formFileSm" name="top_image_category" type="file">
                            <small class="text-secondary">(Size: 304 x 465 px - file image max 2MB)</small>
                        </div>

                        <div class="col-md-3 thumbnail-top-image">

                        </div>

                        <div class="col-md-12">
                            <label for="formFileSm" class="form-label">Upload Bottom Image <small class="text-danger">(optional)</small></label>
                            <input class="form-control form-control-sm" id="formFileSm" name="bottom_image_category" type="file">
                            <small class="text-secondary">(Size: 191 x 217 px - file image max 2MB)</small>
                        </div>

                        <div class="col-md-3 thumbnail-bottom-image">

                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label for="formFileSm" class="form-label">Show in Home Page</label>
                            <div class="form-check form-switch show-home-page">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="formFileSm" class="form-label"></label>
                            <div class="form-check form-switch show-status">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="menu_book_category_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit menu book category -->


<!-- delete career -->
<div class="modal fade" id="deletecareer" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url("remove-career"); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Careers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="get-career-title" class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="career_id" value="" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end delete career -->