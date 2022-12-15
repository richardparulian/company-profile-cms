<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Custom extends CI_Model
{
    ## datatables serverside menu management
    function getCategory($postData = null)
    {
        $response = array();

        ## Read value
        $draw               = $postData['draw'];
        $start              = $postData['start'];
        $rowperpage         = $postData['length']; // Rows display per page
        $columnIndex        = $postData['order'][0]['column']; // Column index
        $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
        $searchValue        = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";

        if ($searchValue != '') {
            $searchQuery = " (category_name like '%" . $searchValue . "%' or status like'%" . $searchValue . "%' or parent_name like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');

        $records        = $this->db->get('category')->result();
        $totalRecords   = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $records                = $this->db->get('category')->result();
        $totalRecordwithFilter  = $records[0]->allcount;


        ## Fetch records
        $parent = "Parent";
        $this->db->select('*');

        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where("category_level", $parent);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records    = $this->db->get('category')->result();

        $data       = array();

        foreach ($records as $record) {
            $catID      = $record->category_id;
            $array      = (array)$catID;
            $datas      = [];

            foreach ($array as $arr) {
                ## Fetch records
                $dt = array(
                    "category_level"    => "Child",
                    "parent_id"         => $arr
                );

                $this->db->select('*');

                if ($searchQuery != '')
                    $this->db->where($searchQuery);
                $this->db->where($dt);
                $this->db->order_by($columnName, $columnSortOrder);
                $this->db->limit($rowperpage, $start);

                $recordsChild = $this->db->get('category')->result();

                foreach ($recordsChild as $recordChild) {
                    $datas[] = array(
                        "category_id"           => $recordChild->category_id,
                        "parent_id"             => $recordChild->parent_id,
                        "category_name"         => $recordChild->category_name,
                        "parent_name"           => $recordChild->parent_name,
                        "category_url"          => $recordChild->category_url,
                        "category_level"        => $recordChild->category_level,
                        "category_page"         => $recordChild->category_page,
                        "category_position"     => $recordChild->category_position,
                        "status"                => $recordChild->status
                    );
                }
            }

            $data[] = array(
                "category_id"           => $record->category_id,
                "category_name"         => $record->category_name,
                "category_url"          => $record->category_url,
                "category_level"        => $record->category_level,
                "category_page"         => $record->category_page,
                "category_position"     => $record->category_position,
                "status"                => $record->status,
                "child"                 => $datas
            );
        }

        ## Response
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $data
        );

        return $response;
    }
    ## end datatables serverside menu management

    ## datatables serverside contact us
    function getInbox($postData = null)
    {
        $response = array();

        ## Read value
        $draw               = $postData['draw'];
        $start              = $postData['start'];
        $rowperpage         = $postData['length']; // Rows display per page
        $columnIndex        = $postData['order'][0]['column']; // Column index
        $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
        $searchValue        = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";

        if ($searchValue != '') {
            $searchQuery = " (contact_name like '%" . $searchValue . "%' or status like'%" . $searchValue . "%' or contact_email like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');

        $records        = $this->db->get('contact_us')->result();
        $totalRecords   = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $records                = $this->db->get('contact_us')->result();
        $totalRecordwithFilter  = $records[0]->allcount;


        ## Fetch records
        $this->db->select('*');

        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records    = $this->db->get('contact_us')->result();

        ## Response
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $records
        );

        return $response;
    }
    ## end datatables serverside contact us

    ## datatables serverside careers
    function getCareers($postData = null)
    {
        $response = array();

        ## Read value
        $draw               = $postData['draw'];
        $start              = $postData['start'];
        $rowperpage         = $postData['length']; // Rows display per page
        $columnIndex        = $postData['order'][0]['column']; // Column index
        $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
        $searchValue        = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";

        if ($searchValue != '') {
            $searchQuery = " (career_title like '%" . $searchValue . "%' or career_status like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');

        $records        = $this->db->get('career')->result();
        $totalRecords   = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');

        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $records                = $this->db->get('career')->result();
        $totalRecordwithFilter  = $records[0]->allcount;


        ## Fetch records
        $this->db->select('*');

        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records    = $this->db->get('career')->result();

        ## Response
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $records
        );

        return $response;
    }
    ## end datatables serverside careers

    ## datatables serverside blog
    function getBlog($postData = null)
    {
        $response = array();

        ## Read value
        $draw               = $postData['draw'];
        $start              = $postData['start'];
        $rowperpage         = $postData['length']; // Rows display per page
        $columnIndex        = $postData['order'][0]['column']; // Column index
        $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
        $searchValue        = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";

        if ($searchValue != '') {
            $searchQuery = " (blog_title like '%" . $searchValue . "%' or blog_status like'%" . $searchValue . "%' or blog_author like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("blog");
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');

        $records        = $this->db->get()->result();
        $totalRecords   = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("blog");
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');

        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $records                = $this->db->get()->result();
        $totalRecordwithFilter  = $records[0]->allcount;


        ## Fetch records
        $this->db->select('*');
        $this->db->from("blog");
        $this->db->join('blog_category', 'blog.blog_category_id = blog_category.blog_category_id');

        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records    = $this->db->get()->result();

        ## Response
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $records
        );

        return $response;
    }
    ## end datatables serverside blog

    ## datatables serverside menu book management
    function getMenuBook($postData = null)
    {
        $response = array();

        ## Read value
        $draw               = $postData['draw'];
        $start              = $postData['start'];
        $rowperpage         = $postData['length']; // Rows display per page
        $columnIndex        = $postData['order'][0]['column']; // Column index
        $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
        $searchValue        = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";

        if ($searchValue != '') {
            $searchQuery = " (menu_book_name like '%" . $searchValue . "%' or menu_book_status like'%" . $searchValue . "%' or menu_book_category_name like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("menu_book");
        $this->db->join('menu_book_category', 'menu_book.menu_book_category_id = menu_book_category.menu_book_category_id');

        $records        = $this->db->get()->result();
        $totalRecords   = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("menu_book");
        $this->db->join('menu_book_category', 'menu_book.menu_book_category_id = menu_book_category.menu_book_category_id');

        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $records                = $this->db->get()->result();
        $totalRecordwithFilter  = $records[0]->allcount;


        ## Fetch records
        $this->db->select('*');
        $this->db->from("menu_book");
        $this->db->join('menu_book_category', 'menu_book.menu_book_category_id = menu_book_category.menu_book_category_id');

        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records    = $this->db->get()->result();

        ## Response
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $records
        );

        return $response;
    }
    ## end datatables serverside menu book management
}
