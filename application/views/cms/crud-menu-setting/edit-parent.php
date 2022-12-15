<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Menu Setting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home-admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Menu Management</li>
                <li class="breadcrumb-item"><a href="<?= base_url("menu-setting"); ?>">Menu Settings</a></li>
                <li class="breadcrumb-item active">Edit Menu <?= $getCategory1['category_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="<?= base_url("menu-setting"); ?>">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>

                        <form action="<?= base_url("edit-menu-setting-parent"); ?>" class="row g-3" method="post">
                            <div class="col-md-6">
                                <label for="inputNanme4" class="form-label">Menu Level</label>
                                <select id="category_level_edit" class="form-select" name="category_level" required>
                                    <option value="<?= $getCategory1['category_level']; ?>" selected><?= $getCategory1['category_level']; ?></option>
                                    <?php if ($getCategory1['category_level'] == "Parent") : ?>
                                        <option value="Child">Child</option>
                                    <?php elseif ($getCategory1['category_level'] == "Child") : ?>
                                        <option value="Parent">Parent</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div id="parent-edit" class="col-md-6">
                                <label for="inputNanme4" class="form-label">Parent Menu</label>
                                <select class="form-select" name="parent" id="parent" required>
                                    <option value="<?= isset($getParent['category_id']) ? $getParent['category_id'] : ""; ?>" selected><?= isset($getParent['category_name']) ? $getParent['category_name'] : "Choose Parent Menu"; ?></option>
                                    <?php foreach ($getCategory2 as $category) : ?>
                                        <option value="<?= $category['category_id']; ?>"><?= $category['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputNanme4" class="form-label">Menu Name</label>
                                <input type="text" class="form-control" name="menu_name" value="<?= $getCategory1['category_name']; ?>" placeholder="Menu Name" required>
                            </div>

                            <div class="col-md-12">
                                <label for="category-page" class="form-label">Category Page</label>
                                <select id="category_page_add" class="form-select" name="category_page">
                                    <?php if ($getCategory1['category_page'] == "Static Page") : ?>
                                        <option value="<?= $getCategory1['category_page']; ?>" selected>Static Page</option>
                                        <option value="Module">Module</option>
                                    <?php elseif ($getCategory1['category_page'] == "Module") : ?>
                                        <option value="Static Page">Static Page</option>
                                        <option value="<?= $getCategory1['category_page']; ?>" selected>Module</option>
                                    <?php else : ?>
                                        <option value="<?= null; ?>" selected disabled>Choose Category</option>
                                        <option value="Static Page">Static Page</option>
                                        <option value="Module">Module</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div id="static-page" class="col-md-12" hidden>
                                <label for="inputNanme4" class="form-label">Static Page</label>
                                <select id="inputState" class="form-select select2" name="static_page">
                                    <?php if ($getStaticPage1['static_page_id']) : ?>
                                        <option value="<?= $getStaticPage1['static_page_id']; ?>" selected><?= $getStaticPage1['static_page_title']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= null; ?>" selected disabled>Choose Static Page</option>
                                    <?php endif; ?>

                                    <option value="<?= null; ?>">No Urls</option>
                                    <?php foreach ($getStaticPage2 as $page) : ?>
                                        <option value="<?= $page['static_page_id']; ?>"><?= $page['static_page_title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div id="module" class="col-md-12" hidden>
                                <label for="menu-name" class="form-label">Module</label>
                                <input type="text" class="form-control" name="module" value="<?= $modules; ?>" placeholder="Module">
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <?php if ($getCategory1['status'] == "Show") : ?>
                                        <input class="form-check-input show-hide" type="checkbox" name="status" value="Show" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label shows" for="flexSwitchCheckChecked">Show</label>
                                        <label class="form-check-label hides" for="flexSwitchCheckChecked" style="display: none;">Hide</label>
                                    <?php else : ?>
                                        <input class="form-check-input show-hide" type="checkbox" name="status" value="Hide" id="flexSwitchCheckChecked">
                                        <label class="form-check-label shows" for="flexSwitchCheckChecked" style="display: none;">Show</label>
                                        <label class="form-check-label hides" for="flexSwitchCheckChecked">Hide</label>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="hidden" name="category_position" value="<?= $getCategory1['category_position']; ?>" />
                                <input type="hidden" name="category_id" value="<?= $getCategory1['category_id']; ?>" />
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="<?= base_url("menu-setting"); ?>" type="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    var edit = document.getElementById("category_level_edit");

    function onChangeEdit() {
        var valueEdit = edit.value;
        var parentEdit = document.getElementById("parent-edit");
        var parent = document.getElementById("parent");

        if (valueEdit === "Child") {
            parentEdit.removeAttribute("hidden");
            parent.setAttribute("required", "required");
        } else if (valueEdit === "Parent") {
            parentEdit.setAttribute("hidden", "hidden");
            parent.removeAttribute("required");
        }
    }
    edit.onchange = onChangeEdit;

    onChangeEdit();
</script>