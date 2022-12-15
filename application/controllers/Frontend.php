<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Frontend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        $data['slider']             = $this->M_Global->getmultiparam("banner_slider", "status = 'Show' ")->result_array();
        $data['menuBookCategory']   = $this->M_Global->get_list("menu_book_category", "for_home = 'True' ")->row_array();
        $menuBookCategoryId         = $data['menuBookCategory']['menu_book_category_id'];
        $data['menuBook']           = $this->M_Global->q2join("menu_book", "menu_book_category", "a.menu_book_category_id", "b.menu_book_category_id", "a.menu_book_category_id = '$menuBookCategoryId' and a.menu_book_status = 'Show' order by a.menu_book_id desc")->result_array();

        $data['categoryGallery']    = $this->M_Global->get_result("category_gallery")->result_array();
        $data['gallery']            = $this->M_Global->q2join("gallery", "category_gallery", "a.category_gallery_id", "b.category_gallery_id", "status = 'Show' ")->result_array();

        $getBlog                    = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' order by a.blog_id desc ")->result_array();
        $event                      = [];
        $news                       = [];

        foreach ($getBlog as $blogs) {
            if ($blogs['blog_category_slug'] == "events" || $blogs['blog_category_slug'] == "event") {
                $blogDesc                   = $blogs['blog_desc'];
                $maxchar                    = 100;
                $end                        = "...";

                if (strlen($blogDesc) > $maxchar || $blogDesc == '') {
                    $words = preg_split('/\s/', $blogDesc);
                    $output = '';
                    $i      = 0;
                    while (1) {
                        $length = strlen($output) + strlen($words[$i]);
                        if ($length > $maxchar) {
                            break;
                        } else {
                            $output .= " " . $words[$i];
                            ++$i;
                        }
                    }
                    $output .= $end;
                } else {
                    $output = $blogDesc;
                }

                $event[] = [
                    "blog_id"               => $blogs['blog_id'],
                    "blog_category_id"      => $blogs['blog_category_id'],
                    "blog_category_slug"    => $blogs['blog_category_slug'],
                    "blog_title"            => $blogs['blog_title'],
                    "blog_author"           => $blogs['blog_author'],
                    "blog_desc"             => $output,
                    "blog_publish"          => $blogs['blog_publish'],
                    "blog_last_update"      => $blogs['blog_last_update'],
                    "blog_tags"             => $blogs['blog_tags'],
                    "blog_image"            => $blogs['blog_image'],
                    "blog_image"            => $blogs['blog_image'],
                    "blog_image_author"     => $blogs['blog_image_author'],
                    "blog_image_events"     => $blogs['blog_image_events'],
                    "slug"                  => $blogs['slug'],
                    "status"                => $blogs['status'],
                    "blog_created_at"       => $blogs['blog_created_at'],
                    "blog_updated_at"       => $blogs['blog_updated_at']
                ];
            } elseif ($blogs['blog_category_slug'] == "news") {

                $blogDesc                   = $blogs['blog_desc'];
                $maxchar                    = 200;
                $end                        = "...";

                if (strlen($blogDesc) > $maxchar || $blogDesc == '') {
                    $words = preg_split('/\s/', $blogDesc);
                    $output = '';
                    $i      = 0;
                    while (1) {
                        $length = strlen($output) + strlen($words[$i]);
                        if ($length > $maxchar) {
                            break;
                        } else {
                            $output .= " " . $words[$i];
                            ++$i;
                        }
                    }
                    $output .= $end;
                } else {
                    $output = $blogDesc;
                }

                $news[] = [
                    "blog_id"               => $blogs['blog_id'],
                    "blog_category_id"      => $blogs['blog_category_id'],
                    "blog_category_slug"    => $blogs['blog_category_slug'],
                    "blog_title"            => $blogs['blog_title'],
                    "blog_author"           => $blogs['blog_author'],
                    "blog_desc"             => $output,
                    "blog_publish"          => $blogs['blog_publish'],
                    "blog_last_update"      => $blogs['blog_last_update'],
                    "blog_tags"             => $blogs['blog_tags'],
                    "blog_quote_author"     => $blogs['blog_quote_author'],
                    "blog_image"            => $blogs['blog_image'],
                    "blog_image_author"     => $blogs['blog_image_author'],
                    "slug"                  => $blogs['slug'],
                    "status"                => $blogs['status'],
                    "blog_created_at"       => $blogs['blog_created_at'],
                    "blog_updated_at"       => $blogs['blog_updated_at']
                ];
            }
        }

        $data['getEvents'] = $event;
        $data['getNews'] = $news;

        ## meta tags
        $data['title']          = ucwords("Home");
        $data['meta_keyword']   = $data['configuration']['company_meta_keyword'];
        $data['meta_desc']      = $data['configuration']['company_meta_desc'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords("Home");
        $data['og_url']         = base_url();
        $data['og_image']       = "";
        $data['twitter_title']  = ucwords("Home");
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/home', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function static_page()
    {
        $slug                   = end($this->uri->segments);
        $staticPageId           = $this->uri->segment(2);

        $data['menu']           = $this->M_Frontend->getMenu();
        $data['staticPage']     = $this->M_Global->getmultiparam("static_page", "slug = '$slug' and static_page_id = '$staticPageId' ")->row_array();
        $data['configuration']  = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']   = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## meta tags
        $data['title']          = ucwords($data['staticPage']['static_page_title']);
        $data['meta_keyword']   = $data['staticPage']['meta_keyword'];
        $data['meta_desc']      = $data['staticPage']['meta_desc'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords($data['staticPage']['static_page_title']);
        $data['og_url']         = base_url("static-page/" . $data['staticPage']['static_page_id'] . "/" . $data['staticPage']['slug']);
        $data['og_image']       = "";
        $data['twitter_title']  = ucwords($data['staticPage']['static_page_title']);
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/static-page', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function gallery()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## gallery
        $data['categoryGallery']    = $this->M_Global->get_result("category_gallery")->result_array();
        $data['gallery']            = $this->M_Global->q2join("gallery", "category_gallery", "a.category_gallery_id", "b.category_gallery_id", "status = 'Show' ")->result_array();
        ## end gallery

        ## meta tags
        $data['title']          = ucwords("Gallery");
        $data['meta_keyword']   = "Gallery, Milou Farm House";
        $data['meta_desc']      = "Gallery - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Gallery - Milou Farm House";
        $data['og_url']         = base_url("gallery");
        $data['og_image']       = "";
        $data['twitter_title']  = "Gallery - Milou Farm House";;
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/gallery', $data);
        $this->load->view('website/components/footer', $data);
    }

    ## blog
    public function blog()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## blog
        $data['getBlog']            = $this->M_Frontend->blog_pagination();
        ## end blog

        ## sidebar blog
        $data['getBlogRecent']      = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' ORDER BY a.blog_id DESC")->result_array();
        $data['tags']               = $this->M_Global->get_list("blog_tag", "blog_tag_status = 'Show' ")->result_array();
        $data['getBlogCategory']    = $this->M_Global->get_list("blog_category", "status = 'Show' ")->result_array();
        ## end sidebar

        ## meta tags
        $data['title']          = ucwords("Blog");
        $data['meta_keyword']   = "Blog, Milou Farm House";
        $data['meta_desc']      = "Blog - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Blog";
        $data['og_url']         = base_url("blog");
        $data['og_image']       = "";
        $data['twitter_title']  = "Blog";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/blog', $data);
        $this->load->view('website/components-blog/sidebar', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function blog_detail()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## blog detail
        $slug                       = end($this->uri->segments);
        $blogId                     = $this->uri->segment(3);
        $data['getBlog']            = $this->M_Global->get_list("blog", "slug = '$slug' and blog_id = '$blogId' ")->row_array();
        $blogCategoryId             = $data['getBlog']['blog_category_id'];
        $data['blogCategory']       = $this->M_Global->get_list("blog_category", "blog_category_id = '$blogCategoryId' ")->row_array();
        $explodeTags                = explode(',', $data['getBlog']["blog_tags"], 20);
        $value                      = [];

        foreach ($explodeTags as $tag) {

            $getsTag = $this->M_Global->get_list("blog_tag", "blog_tag_name = '$tag' ")->result_array();

            foreach ($getsTag as $key) {
                $value[] = [
                    "blog_tag_id"   => $key['blog_tag_id'],
                    "blog_tag_name" => $key['blog_tag_name'],
                    "slug"          => $key['slug'],
                    "created_at"    => $key['created_at']
                ];
            }
        }
        $data['tagsRelated']         = $value;
        ## end blog detail

        ## sidebar blog
        $data['getBlogCategory']    = $this->M_Global->get_list("blog_category", "status = 'Show' ")->result_array();
        $data['getBlogRecent']      = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' ORDER BY a.blog_id DESC")->result_array();
        $data['tags']               = $this->M_Global->get_list("blog_tag", "blog_tag_status = 'Show' ")->result_array();
        ## end sidebar

        ## meta tags
        $data['title']          = ucwords($data['getBlog']['blog_title']);
        $data['meta_keyword']   = $data['getBlog']['blog_meta_keyword'];
        $data['meta_desc']      = $data['getBlog']['blog_meta_desc'];
        $data['og_type']        = "article";
        $data['og_title']       = ucwords($data['getBlog']['blog_title']);
        $data['og_url']         = base_url("blog/" . $data['blogCategory']['blog_category_slug'] . "/" . $data['getBlog']['blog_id'] . "/" . $data['getBlog']['slug']);
        $data['og_image']       = base_url("assets/website/images/blog/" . $data['getBlog']['blog_image']);
        $data['twitter_title']  = ucwords($data['getBlog']['blog_title']);
        $data['twitter_image']  = base_url("assets/website/images/blog/" . $data['getBlog']['blog_image']);;
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/blog-detail', $data);
        $this->load->view('website/components-blog/sidebar', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function blog_tag()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## blog
        $slug                       = end($this->uri->segments);
        $data['countBlogTag']       = $this->M_Frontend->count_blog_tag($slug);
        $data['getBlog']            = $this->M_Frontend->blog_tag_pagination($slug);
        ## end blog

        ## sidebar blog
        $data['getBlogCategory']    = $this->M_Global->get_list("blog_category", "status = 'Show' ")->result_array();
        $data['getBlogRecent']      = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' ORDER BY a.blog_id DESC")->result_array();
        $data['tags']               = $this->M_Global->get_list("blog_tag", "blog_tag_status = 'Show' ")->result_array();
        ## end sidebar

        ## meta tags
        $getTags                = $this->M_Global->get_list("blog_tag", "slug = '$slug' ")->row_array();
        $data['title']          = ucwords($getTags['blog_tag_name']);
        $data['meta_keyword']   = "Tag," . $getTags['blog_tag_name'] . ",Milou Farm House";
        $data['meta_desc']      = "Tag: " . $getTags['blog_tag_name'] . " - Milou Farm House";
        $data['tagName']        = $getTags['blog_tag_name'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords($getTags['blog_tag_name']);
        $data['og_url']         = base_url("blog/tag/" . $getTags['blog_tag_id'] . "/" . $getTags['slug']);
        $data['og_image']       = "";
        $data['twitter_title']  = ucwords($getTags['blog_tag_name']);
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/blog-tag', $data);
        $this->load->view('website/components-blog/sidebar', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function blog_category()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## blog
        $slug                       = end($this->uri->segments);
        $data['getBlog']            = $this->M_Frontend->blog_category_pagination($slug);
        $data['countBlogCategory']  = count($data['getBlog']);
        ## end blog

        ## sidebar blog
        $data['getBlogCategory']    = $this->M_Global->get_list("blog_category", "status = 'Show' ")->result_array();
        $data['getBlogRecent']      = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' ORDER BY a.blog_id DESC")->result_array();
        $data['tags']               = $this->M_Global->get_list("blog_tag", "blog_tag_status = 'Show' ")->result_array();
        ## end sidebar

        ## meta tags
        $getCategory            = $this->M_Global->get_list("blog_category", "blog_category_slug = '$slug' ")->row_array();
        $data['title']          = ucwords($getCategory['blog_category_name']);
        $data['meta_keyword']   = $getCategory['blog_category_name'];
        $data['meta_desc']      = $getCategory['blog_category_name'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords($getCategory['blog_category_name']);
        $data['og_url']         = base_url("blog/category/" . $getCategory['blog_category_id'] . "/" . $getCategory['blog_category_slug']);
        $data['og_image']       = "";
        $data['twitter_title']  = ucwords($getCategory['blog_category_name']);
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/blog-category', $data);
        $this->load->view('website/components-blog/sidebar', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function blog_search_post()
    {
        if ($this->input->post("search_blog_post")) {
            $keywordSearch  = $this->input->post("search_blog_post", true);

            redirect("blog/search?q=" . $keywordSearch);
        }
    }

    public function blog_search_result()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## blog
        $data['getBlog']            = $this->M_Frontend->blog_search_pagination();
        ## end blog

        ## sidebar blog
        $data['getBlogCategory']    = $this->M_Global->get_list("blog_category", "status = 'Show' ")->result_array();
        $data['getBlogRecent']      = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' ORDER BY a.blog_id DESC")->result_array();
        $data['tags']               = $this->M_Global->get_list("blog_tag", "blog_tag_status = 'Show' ")->result_array();
        ## end sidebar

        ## meta tags
        $data['title']          = ucwords("Blog");
        $data['meta_keyword']   = "Blog, Milou Farm House";
        $data['meta_desc']      = "Blog - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Blog";
        $data['og_url']         = base_url("blog");
        $data['og_image']       = "";
        $data['twitter_title']  = "Blog";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/blog-result', $data);
        $this->load->view('website/components-blog/sidebar', $data);
        $this->load->view('website/components/footer', $data);
    }
    ## blog detail

    ## menu book
    public function menu_book()
    {
        $data['menu']                = $this->M_Frontend->getMenu();
        $data['configuration']       = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']        = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## menu book
        $data['getMenuBook']         = $this->M_Frontend->menu_book_pagination();
        ## end menu book

        ## menu book by category
        $data['getMenuBookCategory'] = $this->M_Global->get_list("menu_book_category", "status = 'Show' ")->result_array();
        ## end menu book by category

        ## meta tags
        $data['title']          = ucwords("Menu");
        $data['meta_keyword']   = "Menu, Milou Farm House";
        $data['meta_desc']      = "Menu - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Menu";
        $data['og_url']         = base_url("menu");
        $data['og_image']       = "";
        $data['twitter_title']  = "Menu";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/menu', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function menu_book_detail()
    {
        $data['menu']           = $this->M_Frontend->getMenu();
        $data['configuration']  = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']   = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## menu book
        $slug                           = end($this->uri->segments);
        $menuBookId                     = $this->uri->segment(3);
        $data['getMenuBook']            = $this->M_Global->get_list("menu_book", "slug = '$slug' and menu_book_id = '$menuBookId' ")->row_array();
        $menuBookCategoryId             = $data['getMenuBook']['menu_book_category_id'];
        $data['menuBookCategory']       = $this->M_Global->get_list("menu_book_category", "menu_book_category_id = '$menuBookCategoryId' ")->row_array();
        ## end menu book

        ## menu book by category
        $data['getMenuBookCategory'] = $this->M_Global->get_list("menu_book_category", "status = 'Show' ")->result_array();
        ## end menu book by category

        ## meta tags
        $data['title']          = ucwords($data['getMenuBook']['menu_book_name']);
        $data['meta_keyword']   = $data['getMenuBook']['menu_book_meta_keyword'];
        $data['meta_desc']      = $data['getMenuBook']['menu_book_meta_desc'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords($data['getMenuBook']['menu_book_name']);
        $data['og_url']         = base_url("menu/" . $data['menuBookCategory']['menu_book_category_slug'] . "/" . $data['getMenuBook']['menu_book_id'] . "/" . $data['getMenuBook']['slug']);
        $data['og_image']       = base_url("assets/website/images/menu-book/" . $data['getMenuBook']['menu_book_image']);
        $data['twitter_title']  = ucwords($data['getMenuBook']['menu_book_name']);
        $data['twitter_image']  = base_url("assets/website/images/menu-book/" . $data['getMenuBook']['menu_book_image']);
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/menu-detail', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function menu_book_category()
    {
        $data['menu']           = $this->M_Frontend->getMenu();
        $data['configuration']  = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']   = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## menu book
        $slug                   = end($this->uri->segments);
        $data['getMenuBook']    = $this->M_Frontend->menu_book_category_pagination($slug);
        ## end menu book

        ## menu book by category
        $data['getMenuBookCategory'] = $this->M_Global->get_list("menu_book_category", "status = 'Show' ")->result_array();
        ## end menu book by category

        ## meta tags
        $getCategory            = $this->M_Global->get_list("menu_book_category", "menu_book_category_slug = '$slug' ")->row_array();
        $data['title']          = ucwords($getCategory['menu_book_category_name']);
        $data['meta_keyword']   = $getCategory['menu_book_category_name'];
        $data['meta_desc']      = $getCategory['menu_book_category_name'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords($getCategory['menu_book_category_name']);
        $data['og_url']         = base_url("menu/category/" . $getCategory['menu_book_category_id'] . "/" . $getCategory['menu_book_category_slug']);
        $data['og_image']       = "";
        $data['twitter_title']  = ucwords($getCategory['menu_book_category_name']);
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/menu-category', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function menu_book_search_post()
    {
        if ($this->input->post("search_menu_book")) {
            $keywordSearch  = $this->input->post("search_menu_book", true);

            redirect("menu/search?q=" . $keywordSearch);
        }
    }

    public function menu_book_search_result()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## menu book
        $data['getMenuBook']        = $this->M_Frontend->menu_book_search_pagination();
        ## end menu book

        ## menu book by category
        $data['getMenuBookCategory'] = $this->M_Global->get_list("menu_book_category", "status = 'Show' ")->result_array();
        ## end menu book by category

        ## meta tags
        $data['title']          = ucwords("Menu");
        $data['meta_keyword']   = "Menu, Milou Farm House";
        $data['meta_desc']      = "Menu - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Menu";
        $data['og_url']         = base_url("menu");
        $data['og_image']       = "";
        $data['twitter_title']  = "Menu";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/menu-result', $data);
        $this->load->view('website/components/footer', $data);
    }
    ## end menu book

    ## contact us
    public function contact_us()
    {
        $data['menu']                = $this->M_Frontend->getMenu();
        $data['configuration']       = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']        = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## meta tags
        $data['title']          = ucwords("Contact Us");
        $data['meta_keyword']   = "Contact Us, Milou Farm House";
        $data['meta_desc']      = "Contact Us - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Contact Us";
        $data['og_url']         = base_url("contact-us");
        $data['og_image']       = "";
        $data['twitter_title']  = "Contact Us";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/contact-us', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function send_message()
    {
        $contactName    = $this->input->post("contact_name", true);
        $contactEmail   = $this->input->post("contact_email", true);
        $contactPhone   = $this->input->post("contact_phone", true);
        $contactAddress = $this->input->post("contact_address", true);
        $contactMessage = $this->input->post("contact_message", true);

        $data = [
            "contact_name"      => $contactName,
            "contact_email"     => $contactEmail,
            "contact_phone"     => $contactPhone,
            "contact_address"   => $contactAddress,
            "contact_desc"      => $contactMessage,
            "status"            => "Unread",
            "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $created = $this->M_Global->insert($data, "contact_us");

        if ($created) {
            $this->session->set_flashdata('success', 'sent successfully.');
            redirect("contact-us");
        } else {
            $this->session->set_flashdata('error', 'failed to send, please try again.');
            redirect("contact-us");
        }
    }
    ## end contact us

    ## events
    public function events()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## event
        $data['getEvents']          = $this->M_Frontend->events_pagination();
        ## end event

        ## meta tags
        $data['title']          = ucwords("Events");
        $data['meta_keyword']   = "Events, Milou Farm House";
        $data['meta_desc']      = "Events - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Events";
        $data['og_url']         = base_url("events");
        $data['og_image']       = "";
        $data['twitter_title']  = "Events";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/events', $data);
        $this->load->view('website/components/footer', $data);
    }
    ## end events

    ## news
    public function news()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## news
        $data['getNews']            = $this->M_Frontend->news_pagination();
        ## end news

        ## meta tags
        $data['title']          = ucwords("News");
        $data['meta_keyword']   = "News, Milou Farm House";
        $data['meta_desc']      = "News - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "News";
        $data['og_url']         = base_url("news");
        $data['og_image']       = "";
        $data['twitter_title']  = "News";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/news', $data);
        $this->load->view('website/components/footer', $data);
    }
    ## end news

    ## career
    public function careers()
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## careers
        $data['getCareer']          = $this->M_Frontend->career_pagination();
        $data['countCareer']        = $this->M_Global->get_list("career", "career_status = 'Show' ")->num_rows();
        ## end careers

        ## meta tags
        $data['title']          = ucwords("Careers");
        $data['meta_keyword']   = "Careers, Milou Farm House";
        $data['meta_desc']      = "Careers - Milou Farm House";
        $data['og_type']        = "website";
        $data['og_title']       = "Careers";
        $data['og_url']         = base_url("careers");
        $data['og_image']       = "";
        $data['twitter_title']  = "Careers";
        $data['twitter_image']  = "";
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/career', $data);
        $this->load->view('website/components/footer', $data);
    }

    public function careers_detail($slug)
    {
        $data['menu']               = $this->M_Frontend->getMenu();
        $data['configuration']      = $this->M_Global->get_result("basic_configuration")->row_array();
        $data['getInstagram']       = $this->M_Global->get_list("instagram", "status = 'Show' ")->result_array();

        ## careers
        $data['getCareer']          = $this->M_Global->get_list("career", "career_slug = '$slug' ")->row_array();
        ## end careers

        ## meta tags
        $data['title']          = ucwords($data['getCareer']['career_title']);
        $data['meta_keyword']   = $data['getCareer']['career_meta_keyword'];
        $data['meta_desc']      = $data['getCareer']['career_meta_desc'];
        $data['og_type']        = "website";
        $data['og_title']       = ucwords($data['getCareer']['career_title']);
        $data['og_url']         = base_url("careers/" . $data['getCareer']['career_slug']);
        $data['og_image']       = base_url("assets/website/images/career/" . $data['getCareer']['career_image']);
        $data['twitter_title']  = ucwords($data['getCareer']['career_title']);
        $data['twitter_image']  = base_url("assets/website/images/career/" . $data['getCareer']['career_image']);
        ## end meta tags

        $this->load->view('website/components/header', $data);
        $this->load->view('website/components/navbar', $data);
        $this->load->view('website/career-detail', $data);
        $this->load->view('website/components/footer', $data);
    }
    ## end career
}
