<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'frontend';
$route['404_override'] = 'MyCustom404Ctrl';
$route['translate_uri_dashes'] = FALSE;

## admin
$route['admin-milou']                           = 'auth';
$route['post-login']                            = 'auth/login';
$route['post-logout']                           = 'auth/logout';
$route['home-admin']                            = 'admin';

$route['inbox']                                 = 'admin/inbox';
$route['inbox-detail/(:any)']                   = 'admin/inbox_detail/$1';

$route['career']                                = 'admin/career';
$route['page-add-career']                       = 'admin/page_add_career';
$route['add-career']                            = 'admin/add_career';
$route['page-edit-career/(:any)']               = 'admin/page_edit_career/$1';
$route['edit-career/(:any)']                    = 'admin/edit_career/$1';
$route['remove-career']                         = 'admin/remove_career';

$route['basic-configuration']                   = 'admin/basic_configuration';
$route['edit-configuration/(:any)']             = 'admin/edit_configuration/$1';

$route['ig-footer']                             = 'admin/ig_footer';
$route['add-ig-footer']                         = 'admin/add_ig_footer';
$route['edit-ig-footer']                        = 'admin/edit_ig_footer';
$route['remove-ig-footer']                      = 'admin/remove_ig_footer';

$route['banner-side-blog']                      = 'admin/banner_side_blog';
$route['edit-banner-side-blog/(:any)']          = 'admin/edit_banner_side_blog/$1';

$route['menu-setting']                          = 'admin/menu_setting';
$route['add-menu-setting']                      = 'admin/add_menu_setting';
$route['page-edit-menu-setting/parent/(:any)']  = 'admin/page_edit_menu_setting_parent/$1';
$route['page-edit-menu-setting/child/(:any)']   = 'admin/page_edit_menu_setting_child/$1';
$route['edit-menu-setting-parent']              = 'admin/edit_menu_setting_parent';
$route['edit-menu-setting-child']               = 'admin/edit_menu_setting_child';
$route['remove-menu-setting']                   = 'admin/remove_menu_setting';
$route['edit-position-down/(:any)']             = 'admin/edit_position_down/$1';
$route['edit-position-up/(:any)']               = 'admin/edit_position_up/$1';

$route['static-pages']                          = 'admin/static_pages';
$route['page-add-static-pages']                 = 'admin/page_add_static_pages';
$route['add-static-pages']                      = 'admin/add_static_pages';
$route['page-edit-static-pages/(:any)']         = 'admin/page_edit_static_pages/$1';
$route['edit-static-pages/(:any)']              = 'admin/edit_static_pages/$1';
$route['remove-static-pages']                   = 'admin/remove_static_pages';

$route['banner-slider']                         = 'admin/banner_slider';
$route['add-banner-slider']                     = 'admin/add_banner_slider';
$route['page-edit-banner-slider/(:any)']        = 'admin/page_edit_banner_slider/$1';
$route['edit-banner-slider/(:any)']             = 'admin/edit_banner_slider/$1';
$route['remove-banner-slider']                  = 'admin/remove_banner_slider';

$route['gallerys']                              = 'admin/gallerys';
$route['add-gallerys']                          = 'admin/add_gallerys';
$route['page-edit-gallerys/(:any)']             = 'admin/page_edit_gallerys/$1';
$route['edit-gallerys/(:any)']                  = 'admin/edit_gallerys/$1';
$route['remove-gallerys']                       = 'admin/remove_gallerys';
$route['add-gallerys-category']                 = 'admin/add_gallerys_category';
$route['edit-gallerys-category']                = 'admin/edit_gallerys_category';
$route['remove-gallerys-category']              = 'admin/remove_gallerys_category';

$route['blogs']                             = 'admin/blogs';
$route['page-add-blogs']                    = 'admin/page_add_blogs';
$route['add-blogs']                         = 'admin/add_blogs';
$route['page-edit-blogs/(:any)']            = 'admin/page_edit_blogs/$1';
$route['edit-blogs/(:any)']                 = 'admin/edit_blogs/$1';
$route['remove-blogs']                      = 'admin/remove_blogs';

$route['blogs-category']                    = 'admin/blogs_category';
$route['add-blogs-category']                = 'admin/add_blogs_category';
$route['edit-blogs-category']               = 'admin/edit_blogs_category';
$route['remove-blogs-category']             = 'admin/remove_blogs_category';

$route['blogs-tags']                        = 'admin/blogs_tags';
$route['add-blogs-tags']                    = 'admin/add_blogs_tags';
$route['edit-blogs-tags']                   = 'admin/edit_blogs_tags';
$route['remove-blogs-tags']                 = 'admin/remove_blogs_tags';

$route['menu-book']                         = 'admin/menu_book';
$route['page-add-menu-book']                = 'admin/page_add_menu_book';
$route['add-menu-book']                     = 'admin/add_menu_book';
$route['page-edit-menu-book/(:any)']        = 'admin/page_edit_menu_book/$1';
$route['edit-menu-book/(:any)']             = 'admin/edit_menu_book/$1';
$route['remove-menu-book']                  = 'admin/remove_menu_book';

$route['menu-book-category']                = 'admin/menu_book_category';
$route['add-menu-book-category']            = 'admin/add_menu_book_category';
$route['edit-menu-book-category']           = 'admin/edit_menu_book_category';
$route['remove-menu-book-category']         = 'admin/remove_menu_book_category';
## end admin



## frontend
$route['static-page/(:num)/(:any)']         = 'frontend/static_page/$1';

$route['gallery']                           = 'frontend/gallery';

$route['contact-us']                        = 'frontend/contact_us';
$route['send-message']                      = 'frontend/send_message';

$route['blog']                              = 'frontend/blog';
$route['blog-search-post']                  = 'frontend/blog_search_post';
$route['blog/search']                       = 'frontend/blog_search_result';
$route['blog/tag/(:num)/(:any)']            = 'frontend/blog_tag/$1/$1';
$route['blog/category/(:num)/(:any)']       = 'frontend/blog_category/$1/$1';
$route['blog/(:any)/(:num)/(:any)']         = 'frontend/blog_detail/$1/$1/$1';

$route['menu']                              = 'frontend/menu_book';
$route['menu-search-post']                  = 'frontend/menu_book_search_post';
$route['menu/search']                       = 'frontend/menu_book_search_result';
$route['menu/category/(:num)/(:any)']       = 'frontend/menu_book_category/$1/$1';
$route['menu/(:any)/(:num)/(:any)']         = 'frontend/menu_book_detail/$1/$1/$1';


$route['news']                              = 'frontend/news';
$route['events']                            = 'frontend/events';

$route['careers']                           = 'frontend/careers';
$route['careers/(:any)']                    = 'frontend/careers_detail/$1';
## end frontend
