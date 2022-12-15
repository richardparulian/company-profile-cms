/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.filebrowserBrowseUrl =
		"https://hypercode.id/dev_milou/assets/admin/vendor/kcfinder/browse.php?type=files";
	config.filebrowserImageBrowseUrl =
		"https://hypercode.id/dev_milou/assets/admin/vendor/kcfinder/browse.php?type=images";
	config.filebrowserFlashBrowseUrl =
		"https://hypercode.id/dev_milou/assets/admin/vendor/kcfinder/browse.php?type=flash";
	config.filebrowserUploadUrl =
		"https://hypercode.id/dev_milou/assets/admin/vendor/kcfinder/upload.php?type=files";
	config.filebrowserImageUploadUrl =
		"https://hypercode.id/dev_milou/assets/admin/vendor/kcfinder/upload.php?type=images";
	config.filebrowserFlashUploadUrl =
		"https://hypercode.id/dev_milou/assets/admin/vendor/kcfinder/upload.php?type=flash";
};
