<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Frontend extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function query($query)
    {
        return $this->db->query($query);
    }

    function getMenu()
    {
        $parent =  $this->db->query("SELECT * FROM category WHERE category_level = 'Parent' AND status = 'show' ORDER BY category_position ASC")->result();
        $data   = [];

        foreach ($parent as $parents) {
            $catID  = $parents->category_id;
            $array  = (array)$catID;
            $datas  = [];

            foreach ($array as $arrays) {
                $child = $this->db->query("SELECT * FROM category WHERE category_level = 'Child' AND parent_id = '$arrays' AND status = 'show' ORDER BY category_position ASC")->result();

                foreach ($child as $childs) {
                    $datas[] = array(
                        "category_id"       => $childs->category_id,
                        "parent_id"         => $childs->parent_id,
                        "parent_name"       => $childs->parent_name,
                        "category_name"     => $childs->category_name,
                        "category_url"      => $childs->category_url,
                        "category_level"    => $childs->category_level,
                        "status"            => $childs->status
                    );
                }
            }

            $data[] = array(
                "category_id"       => $parents->category_id,
                "parent_id"         => $parents->parent_id,
                "parent_name"       => $parents->parent_name,
                "category_name"     => $parents->category_name,
                "category_url"      => $parents->category_url,
                "category_level"    => $parents->category_level,
                "status"            => $parents->status,
                "child"             => $datas,
                "rows"              => count($datas)
            );
        }

        $query = $data;

        return $query;
    }

    ## all blog
    function blog_pagination()
    {
        $config['base_url']             = base_url('blog');
        $config['total_rows']           = $this->M_Global->get_list('blog', 'blog_status = "Show" ')->num_rows();
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 5;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');
        $this->db->where('blog.blog_status = "Show" ');
        $this->db->order_by('blog.blog_id', 'ASC');
        $this->db->limit($limit, $offset);

        $getBlog    = $this->db->get()->result_array();
        $blog       = [];

        foreach ($getBlog as $blogs) {
            $blogDesc                   = $blogs['blog_desc'];
            $maxchar                    = 350;
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

            $blog[] = [
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
                "blog_image_events"     => $blogs['blog_image_events'],
                "slug"                  => $blogs['slug'],
                "status"                => $blogs['status'],
                "blog_created_at"       => $blogs['blog_created_at'],
                "blog_updated_at"       => $blogs['blog_updated_at']
            ];
        }

        $query = $blog;

        return $query;
    }
    ## end all blog

    ## blog tag
    function blog_tag_pagination($slug)
    {
        $config['base_url']             = base_url('blog/tag/' . $slug);
        $config['total_rows']           = $this->M_Frontend->count_blog_tag($slug);
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 5;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $getsTag                    = $this->M_Global->get_list("blog_tag", "slug = '$slug' ")->row_array();
        $tagName                    = $getsTag['blog_tag_name'];

        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');
        $this->db->where('blog.blog_status = "Show" ');
        $this->db->order_by('blog.blog_id', 'ASC');

        $getBlog        = $this->db->get()->result_array();
        $getBlogByTag   = [];

        foreach ($getBlog as $blog) {
            $explodeTags    = explode(',', $blog["blog_tags"]);

            foreach ($explodeTags as $tags) {

                if ($tags == $tagName) {
                    $blogDesc                   = $blog['blog_desc'];
                    $maxchar                    = 350;
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

                    $getBlogByTag[] = [
                        "blog_id"               => $blog['blog_id'],
                        "blog_category_id"      => $blog['blog_category_id'],
                        "blog_category_slug"    => $blog['blog_category_slug'],
                        "blog_title"            => $blog['blog_title'],
                        "blog_author"           => $blog['blog_author'],
                        "blog_desc"             => $output,
                        "blog_publish"          => $blog['blog_publish'],
                        "blog_last_update"      => $blog['blog_last_update'],
                        "blog_tags"             => $blog['blog_tags'],
                        "blog_image"            => $blog['blog_image'],
                        "slug"                  => $blog['slug'],
                        "status"                => $blog['status'],
                        "blog_created_at"       => $blog['blog_created_at'],
                        "blog_updated_at"       => $blog['blog_updated_at']
                    ];
                }
            }
        }
        $query = array_slice($getBlogByTag, $offset, $limit);

        return $query;
    }

    function count_blog_tag($slug)
    {
        $getsTag                    = $this->M_Global->get_list("blog_tag", "slug = '$slug' ")->row_array();
        $tagName                    = $getsTag['blog_tag_name'];
        $getBlog                    = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' ")->result_array();
        $getBlogByTag               = [];

        foreach ($getBlog as $blog) {
            $explodeTags    = explode(',', $blog["blog_tags"]);

            foreach ($explodeTags as $tags) {

                if ($tags == $tagName) {
                    $blogDesc                   = $blog['blog_desc'];
                    $maxchar                    = 350;
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

                    $getBlogByTag[] = [
                        "blog_id"               => $blog['blog_id'],
                        "blog_category_id"      => $blog['blog_category_id'],
                        "blog_category_slug"    => $blog['blog_category_slug'],
                        "blog_title"            => $blog['blog_title'],
                        "blog_author"           => $blog['blog_author'],
                        "blog_desc"             => $output,
                        "blog_publish"          => $blog['blog_publish'],
                        "blog_last_update"      => $blog['blog_last_update'],
                        "blog_tags"             => $blog['blog_tags'],
                        "blog_image"            => $blog['blog_image'],
                        "slug"                  => $blog['slug'],
                        "status"                => $blog['status'],
                        "blog_created_at"       => $blog['blog_created_at'],
                        "blog_updated_at"       => $blog['blog_updated_at']
                    ];
                }
            }
        }

        return count($getBlogByTag);
    }
    ## end blog tag

    ## blog category
    function blog_category_pagination()
    {
        $slug               = end($this->uri->segments);

        $getBlogCategory    = $this->M_Global->get_list("blog_category", "blog_category_slug = '$slug' ")->row_array();
        $blogCategoryId     = $getBlogCategory['blog_category_id'];
        $countBlog          = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_category_id = '$blogCategoryId' AND a.blog_status = 'Show' ")->num_rows();

        $config['base_url']             = base_url('blog/category/' . $slug);
        $config['total_rows']           = $countBlog;
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 5;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $getBlog            = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_category_id = '$blogCategoryId' AND a.blog_status = 'Show' ")->result_array();

        $query = array_slice($getBlog, $offset, $limit);

        return $query;
    }
    ## end blog category

    ## blog search
    function blog_search_pagination()
    {
        if ($this->input->get('q')) {
            $keywordSearch                  = $this->input->get('q');
            $data['countResult']            = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' AND (a.blog_title LIKE '%$keywordSearch%' OR a.blog_desc LIKE '%$keywordSearch%') ")->num_rows();

            $config['base_url']             = base_url('blog/search?q=' . $keywordSearch);
            $config['total_rows']           = $data['countResult'];
            $config['page_query_string']    = true;
            $config['use_page_numbers']     = true;
            $config['per_page']             = 5;
            $config['uri_segment']          = end($this->uri->segments);
            $choice                         = $config["total_rows"] / $config["per_page"];
            $config["num_links"]            = 3;

            $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
            $config['full_tag_close']       = '</ul></nav>';

            $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
            $config['first_tag_open']       = '<li>';
            $config['first_tag_close']      = '</li>';

            $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
            $config['last_tag_open']        = '<li>';
            $config['last_tag_close']       = '</li>';

            $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
            $config['prev_tag_open']        = '<li>';
            $config['prev_tag_close']       = '</li>';

            $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
            $config['next_tag_open']        = '<li>';
            $config['next_tag_close']       = '</li>';

            $config['cur_tag_open']         = '<li class="active"><a href="#">';
            $config['cur_tag_close']        = '</a></li>';

            $config['num_tag_open']         = '<li>';
            $config['num_tag_close']        = '</li>';


            $this->pagination->initialize($config);

            $limit      = $config['per_page'];
            $page       = $this->input->get('per_page');

            if ($page == 0) {
                $offset = 0;
            } else {
                $offset = ($limit) * ($page - 1);
            }

            $data['keyword']    = $keywordSearch;
            $getBlog            = $this->M_Global->q2join("blog", "blog_category", "a.blog_category_id", "b.blog_category_id", "a.blog_status = 'Show' AND (a.blog_title LIKE '%$keywordSearch%' OR a.blog_desc LIKE '%$keywordSearch%') ")->result_array();

            $data['result']     = array_slice($getBlog, $offset, $limit);

            return $data;
        }
    }
    ## end blog search

    ## menu book pagination
    function menu_book_pagination()
    {
        $config['base_url']             = base_url('menu');
        $config['total_rows']           = $this->M_Global->get_list('menu_book', 'menu_book_status = "Show" ')->num_rows();
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 10;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $this->db->select('*');
        $this->db->from('menu_book');
        $this->db->join('menu_book_category', 'menu_book.menu_book_category_id = menu_book_category.menu_book_category_id');
        $this->db->where('menu_book.menu_book_status = "Show" ');
        $this->db->order_by('menu_book.menu_book_id', 'ASC');
        $this->db->limit($limit, $offset);

        $getMenuBook    = $this->db->get()->result_array();

        return $getMenuBook;
    }
    ## end menu book pagination

    ## menu book category pagination
    function menu_book_category_pagination()
    {
        $slug                       = end($this->uri->segments);
        $data['menuBookCategory']   = $this->M_Global->get_list("menu_book_category", "menu_book_category_slug = '$slug' ")->row_array();
        $menuBookCategoryId         = $data['menuBookCategory']['menu_book_category_id'];
        $countMenuBook              = $this->M_Global->q2join("menu_book", "menu_book_category", "a.menu_book_category_id", "b.menu_book_category_id", "a.menu_book_status = 'Show' AND a.menu_book_category_id = '$menuBookCategoryId' ")->num_rows();

        $config['base_url']             = base_url('menu/category/' . $slug);
        $config['total_rows']           = $countMenuBook;
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 10;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $getMenuBook    = $this->M_Global->q2join("menu_book", "menu_book_category", "a.menu_book_category_id", "b.menu_book_category_id", "a.menu_book_status = 'Show' AND a.menu_book_category_id = '$menuBookCategoryId' ")->result_array();

        $data['query']  = array_slice($getMenuBook, $offset, $limit);

        return $data;
    }
    ## end menu book category pagination

    ## search menu book pagination
    function menu_book_search_pagination()
    {
        if ($this->input->get('q')) {
            $keywordSearch                  = $this->input->get('q');
            $data['countResult']            = $this->M_Global->q2join("menu_book", "menu_book_category", "a.menu_book_category_id", "b.menu_book_category_id", "a.menu_book_status = 'Show' AND (a.menu_book_name LIKE '%$keywordSearch%' OR a.menu_book_desc LIKE '%$keywordSearch%') ")->num_rows();

            $config['base_url']             = base_url('menu/search?q=' . $keywordSearch);
            $config['total_rows']           = $data['countResult'];
            $config['page_query_string']    = true;
            $config['use_page_numbers']     = true;
            $config['per_page']             = 10;
            $config['uri_segment']          = end($this->uri->segments);
            $choice                         = $config["total_rows"] / $config["per_page"];
            $config["num_links"]            = 3;

            $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
            $config['full_tag_close']       = '</ul></nav>';

            $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
            $config['first_tag_open']       = '<li>';
            $config['first_tag_close']      = '</li>';

            $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
            $config['last_tag_open']        = '<li>';
            $config['last_tag_close']       = '</li>';

            $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
            $config['prev_tag_open']        = '<li>';
            $config['prev_tag_close']       = '</li>';

            $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
            $config['next_tag_open']        = '<li>';
            $config['next_tag_close']       = '</li>';

            $config['cur_tag_open']         = '<li class="active"><a href="#">';
            $config['cur_tag_close']        = '</a></li>';

            $config['num_tag_open']         = '<li>';
            $config['num_tag_close']        = '</li>';


            $this->pagination->initialize($config);

            $limit      = $config['per_page'];
            $page       = $this->input->get('per_page');

            if ($page == 0) {
                $offset = 0;
            } else {
                $offset = ($limit) * ($page - 1);
            }

            $data['keyword']    = $keywordSearch;
            $getMenu            = $this->M_Global->q2join("menu_book", "menu_book_category", "a.menu_book_category_id", "b.menu_book_category_id", "a.menu_book_status = 'Show' AND (a.menu_book_name LIKE '%$keywordSearch%' OR a.menu_book_desc LIKE '%$keywordSearch%') ")->result_array();

            $data['result']     = array_slice($getMenu, $offset, $limit);

            return $data;
        }
    }
    ## end search menu book pagination

    ## events pagination
    function events_pagination()
    {
        $getBlogCategory    = $this->M_Global->get_list("blog_category", "blog_category_slug = 'events' OR blog_category_slug = 'event' ")->row_array();
        $blogCategoryId     = $getBlogCategory['blog_category_id'];

        $config['base_url']             = base_url('events');
        $config['total_rows']           = $this->M_Global->get_list("blog", "blog_status = 'Show' AND blog_category_id = '$blogCategoryId' ")->num_rows();
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 6;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');
        $this->db->where("blog.blog_status = 'Show' AND blog.blog_category_id = '$blogCategoryId' ");
        $this->db->order_by('blog.blog_id', 'DESC');
        $this->db->limit($limit, $offset);

        $getBlog    = $this->db->get()->result_array();
        $blog       = [];

        foreach ($getBlog as $blogs) {
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

            $blog[] = [
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
                "blog_image_events"     => $blogs['blog_image_events'],
                "slug"                  => $blogs['slug'],
                "status"                => $blogs['status'],
                "blog_created_at"       => $blogs['blog_created_at'],
                "blog_updated_at"       => $blogs['blog_updated_at']
            ];
        }

        $query = $blog;

        return $query;
    }
    ## end events pagination

    ## news pagination
    function news_pagination()
    {
        $getBlogCategory    = $this->M_Global->get_list("blog_category", "blog_category_slug = 'news' ")->row_array();
        $blogCategoryId     = $getBlogCategory['blog_category_id'];

        $config['base_url']             = base_url('events');
        $config['total_rows']           = $this->M_Global->get_list("blog", "blog_status = 'Show' AND blog_category_id = '$blogCategoryId' ")->num_rows();
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 6;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');
        $this->db->where("blog.blog_status = 'Show' AND blog.blog_category_id = '$blogCategoryId' ");
        $this->db->order_by('blog.blog_id', 'DESC');
        $this->db->limit($limit, $offset);

        $getBlog    = $this->db->get()->result_array();
        $blog       = [];

        foreach ($getBlog as $blogs) {
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

            $blog[] = [
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

        $query = $blog;

        return $query;
    }
    ## end news pagination

    ## career pagination
    function career_pagination()
    {
        $config['base_url']             = base_url('career');
        $config['total_rows']           = $this->M_Global->get_list("career", "career_status = 'Show' ")->num_rows();
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['per_page']             = 12;
        $config['uri_segment']          = end($this->uri->segments);
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = 3;

        $config['full_tag_open']        = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close']       = '</ul></nav>';

        $config['first_link']           = '<span title="First Page" aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';

        $config['last_link']            = '<span title="Last Page" aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['prev_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';

        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';


        $this->pagination->initialize($config);

        $limit      = $config['per_page'];
        $page       = $this->input->get('per_page');

        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($limit) * ($page - 1);
        }

        $getCareer  = $this->M_Global->get_list("career", "career_status = 'Show' ")->result_array();

        $query = array_slice($getCareer, $offset, $limit);

        return $query;
    }
    ## end career pagination
}
