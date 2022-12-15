<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!is_admin()) {
            redirect('admin-milou');
        }
    }

    ## home
    public function index()
    {
        $data['title']          = "Milou - CMS Home";
        $data['configuration']  = $this->M_Global->get_result("basic_configuration")->row_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/dashboard', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }
    ## end home

    ## inbox
    public function getContactUs()
    {
        $postData   = $this->input->post();
        $data       = $this->M_Custom->getInbox($postData);

        echo json_encode($data);
    }

    public function inbox()
    {
        $data['title']          = "Milou - CMS Inbox";
        $data['getInbox']       = $this->M_Global->get_result("contact_us")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/inbox', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function inbox_detail($contactId)
    {
        $data['title']      = "Milou - CMS Inbox";
        $data['getInbox']   = $this->M_Global->get_list("contact_us", "contact_id = '$contactId' ")->row_array();
        $status             = $data['getInbox']['status'];

        if ($status == "Unread") {
            $update = [
                "status"        => "Read",
                "updated_at"    => date('Y-m-d H:i:s', strtotime('now'))
            ];

            $updated = $this->M_Global->update_data("contact_id = '$contactId' ", $update, "contact_us");
        }

        if ($updated) {
            $this->session->set_flashdata('success-read', '1 Message has been read.');

            $this->load->view('cms/components/header', $data);
            $this->load->view('cms/components/navbar', $data);
            $this->load->view('cms/components/sidebar', $data);
            $this->load->view('cms/inbox-detail', $data);
            $this->load->view('cms/components/footer', $data);
            $this->load->view('cms/components/modal', $data);
        }
    }
    ## end inbox

    ## careers
    public function updateUntilCareer()
    {
        $getCareers = $this->M_Global->get_list("career", "career_status = 'Show' ")->result_array();
        $dateNow    = $this->input->post("output");

        foreach ($getCareers as $careers) {
            $careerId   = $careers['career_id'];
            $dateUntil  = $careers['career_until'];

            if ($dateNow > $dateUntil) {
                $data = [
                    "career_status"     => "Hide",
                    "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
                ];

                $updated = $this->M_Global->update_data("career_id = '$careerId' ", $data, "career");

                echo json_encode($updated);
            }
        }
    }

    public function getCareer()
    {
        $postData   = $this->input->post();
        $data       = $this->M_Custom->getCareers($postData);

        echo json_encode($data);
    }

    public function career()
    {
        $data['title']          = "Milou - CMS Careers";

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/careers', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function page_add_career()
    {
        $data['title']          = "Milou - CMS Careers";

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-careers/add', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_career()
    {
        $uploadImage    = $_FILES['career_image']['name'];

        $careerTitle    = $this->input->post("career_title", true);
        $careerDesc     = $this->input->post("career_desc", true);
        $careerFrom     = $this->input->post("career_from", true);
        $careerUntil    = $this->input->post("career_until", true);
        $metaKeyword    = $this->input->post("meta_keyword", true);
        $metaDesc       = $this->input->post("meta_desc", true);
        $status         = $this->input->post("status", true);

        $toSlug         = trim(strtolower($careerTitle));
        $out            = explode(" ", $toSlug);
        $result         = implode("-", $out);
        $slug           = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/career';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 260;
            $config['max_height']           = 424;
            $config['min_width']            = 260;
            $config['min_height']           = 424;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("career_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $dataUpload     = array('upload_data' => $this->upload->data());
                $newImage       = $dataUpload['upload_data']['file_name'];
            }
        }

        $careers  = [
            "career_slug"           => $slug,
            "career_title"          => $careerTitle,
            "career_desc"           => $careerDesc,
            "career_from"           => $careerFrom,
            "career_until"          => $careerUntil,
            "career_image"          => $newImage,
            "career_meta_keyword"   => $metaKeyword,
            "career_meta_desc"      => $metaDesc,
            "career_status"         => $status,
            "created_at"            => date('Y-m-d H:i:s', strtotime('now'))
        ];
        $created = $this->M_Global->insert($careers, "career");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect("career");
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect("career");
        }
    }

    public function page_edit_career($careerId)
    {
        $data['title']          = "Milou - CMS Careers";
        $data['getCareers']     = $this->M_Global->get_list("career", "career_id = '$careerId' ")->row_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-careers/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_career($careerId)
    {
        $uploadImage    = $_FILES['career_image']['name'];

        $careerTitle    = $this->input->post("career_title", true);
        $careerDesc     = $this->input->post("career_desc", true);
        $careerFrom     = $this->input->post("career_from", true);
        $careerUntil    = $this->input->post("career_until", true);
        $metaKeyword    = $this->input->post("meta_keyword", true);
        $metaDesc       = $this->input->post("meta_desc", true);
        $status         = $this->input->post("status", true);

        $toSlug         = trim(strtolower($careerTitle));
        $out            = explode(" ", $toSlug);
        $result         = implode("-", $out);
        $slug           = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/career';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 260;
            $config['max_height']           = 424;
            $config['min_width']            = 260;
            $config['min_height']           = 424;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("career_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $dataUpload     = array('upload_data' => $this->upload->data());
                $newImage       = $dataUpload['upload_data']['file_name'];
            }

            $careers  = [
                "career_slug"           => $slug,
                "career_title"          => $careerTitle,
                "career_desc"           => $careerDesc,
                "career_from"           => $careerFrom,
                "career_until"          => $careerUntil,
                "career_image"          => $newImage,
                "career_meta_keyword"   => $metaKeyword,
                "career_meta_desc"      => $metaDesc,
                "career_status"         => $status,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $careers  = [
                "career_slug"           => $slug,
                "career_title"          => $careerTitle,
                "career_desc"           => $careerDesc,
                "career_from"           => $careerFrom,
                "career_until"          => $careerUntil,
                "career_meta_keyword"   => $metaKeyword,
                "career_meta_desc"      => $metaDesc,
                "career_status"         => $status,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $updated = $this->M_Global->update_data("career_id = '$careerId' ", $careers, "career");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect("career");
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect("career");
        }
    }

    public function get_career_title($careerId)
    {
        $getCareers = $this->M_Global->get_list("career", "career_id = '$careerId' ")->row_array();

        echo json_encode($getCareers);
    }

    public function remove_career()
    {
        $careerId   = $this->input->post("career_id", true);

        $delete = $this->M_Global->delete("career", "career_id = '$careerId' ");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }
    ## end careers

    ## basic confifguration
    public function basic_configuration()
    {
        $data['title']          = "Milou - CMS Basic Configuration";
        $data['configuration']  = $this->M_Global->get_result("basic_configuration")->row_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/basic-configuration', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_configuration($configurationId)
    {
        $getConfiguration       = $this->M_Global->get_result("basic_configuration")->row_array();

        $uploadLogoHome         = $_FILES['company_logo_home']['name'];
        $uploadBannerDefault    = $_FILES['banner_default']['name'];

        $companyName        = $this->input->post("company_name", true);
        $companyPhone       = $this->input->post("company_phone", true);
        $companyEmail       = $this->input->post("company_email", true);
        $companyAddress     = $this->input->post("company_address", true);
        $companyCoordinate  = $this->input->post("company_coordinate", true);
        $companyWorkingTime = $this->input->post("company_working_time", true);
        $companyFacebook    = $this->input->post("company_facebook", true);
        $companyTwitter     = $this->input->post("company_twitter", true);
        $companyInstagram   = $this->input->post("company_instagram", true);
        $companyYoutube     = $this->input->post("company_youtube", true);
        $companyLinkedin    = $this->input->post("company_linkedin", true);
        $metaKeyword        = $this->input->post("meta_keyword", true);
        $metaDesc           = $this->input->post("meta_desc", true);

        //Terlebih dahulu kita trim dl
        $companyPhone = trim($companyPhone);
        //bersihkan dari karakter yang tidak perlu
        $companyPhone = strip_tags($companyPhone);
        // Berishkan dari spasi
        $companyPhone = str_replace(" ", "", $companyPhone);
        // bersihkan dari bentuk seperti  (022) 66677788
        $companyPhone = str_replace("(", "", $companyPhone);
        // bersihkan dari format yang ada titik seperti 0811.222.333.4
        $companyPhone = str_replace(".", "", $companyPhone);

        //cek apakah mengandung karakter + dan 0-9
        if (!preg_match('/[^+0-9]/', trim($companyPhone))) {
            // cek apakah no hp karakter 1-3 adalah +62
            if (substr(trim($companyPhone), 0, 3) == '+62') {
                $companyPhone = trim($companyPhone);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif (substr($companyPhone, 0, 1) == '0') {
                $companyPhone = '+62' . substr($companyPhone, 1);
            }

            // cek apakah no hp karakter 1 adalah +
            elseif (substr($companyPhone, 0, 2) == '62') {
                $companyPhone = '+6' . substr($companyPhone, 1);
            }
        }

        if ($uploadLogoHome) {

            ## logo home
            $config['upload_path']          = 'assets/website/images/';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 480;
            $config['max_height']           = 180;
            $config['min_width']            = 480;
            $config['min_height']           = 180;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("company_logo_home")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldLogoHome    = $getConfiguration['company_logo_home'];

                if ($oldLogoHome != "default-logo.png") {
                    unlink(FCPATH . 'assets/website/images/' . $oldLogoHome);
                }

                $dataLogoHome   = array('upload_data' => $this->upload->data());
                $newLogoHome    = $dataLogoHome['upload_data']['file_name'];
            }

            $configuration = [
                "company_name"          => $companyName,
                "company_email"         => $companyEmail,
                "company_phone"         => $companyPhone,
                "company_address"       => $companyAddress,
                "company_coordinate"    => $companyCoordinate,
                "company_logo_home"     => $newLogoHome,
                "company_working_time"  => $companyWorkingTime,
                "company_facebook"      => $companyFacebook,
                "company_twitter"       => $companyTwitter,
                "company_instagram"     => $companyInstagram,
                "company_youtube"       => $companyYoutube,
                "company_linkedin"      => $companyLinkedin,
                "company_meta_keyword"  => $metaKeyword,
                "company_meta_desc"     => $metaDesc,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else if ($uploadBannerDefault) {

            ## banner default
            $config['upload_path']          = 'assets/website/images/banner-page';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 1920;
            $config['max_height']           = 320;
            $config['min_width']            = 1920;
            $config['min_height']           = 320;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_default")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldBannerDefault    = $getConfiguration['banner_default'];

                if ($oldBannerDefault != "default-banner.png") {
                    unlink(FCPATH . 'assets/website/images/banner-page/' . $oldBannerDefault);
                }

                $dataBannerdefault   = array('upload_data' => $this->upload->data());
                $newBannerDefault    = $dataBannerdefault['upload_data']['file_name'];
            }

            $configuration = [
                "company_name"          => $companyName,
                "company_email"         => $companyEmail,
                "company_phone"         => $companyPhone,
                "company_address"       => $companyAddress,
                "company_coordinate"    => $companyCoordinate,
                "company_working_time"  => $companyWorkingTime,
                "banner_default"        => $newBannerDefault,
                "company_facebook"      => $companyFacebook,
                "company_twitter"       => $companyTwitter,
                "company_instagram"     => $companyInstagram,
                "company_youtube"       => $companyYoutube,
                "company_linkedin"      => $companyLinkedin,
                "company_meta_keyword"  => $metaKeyword,
                "company_meta_desc"     => $metaDesc,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $configuration = [
                "company_name"          => $companyName,
                "company_email"         => $companyEmail,
                "company_phone"         => $companyPhone,
                "company_address"       => $companyAddress,
                "company_coordinate"    => $companyCoordinate,
                "company_working_time"  => $companyWorkingTime,
                "company_facebook"      => $companyFacebook,
                "company_twitter"       => $companyTwitter,
                "company_instagram"     => $companyInstagram,
                "company_youtube"       => $companyYoutube,
                "company_linkedin"      => $companyLinkedin,
                "company_meta_keyword"  => $metaKeyword,
                "company_meta_desc"     => $metaDesc,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $update = $this->M_Global->update_data("configuration_id = '$configurationId' ", $configuration, "basic_configuration");

        if ($update) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to update');

            redirect($this->agent->referrer());
        }
    }
    ## end basic configuration

    ## banner side blog
    public function banner_side_blog()
    {
        $data['title']          = "Milou - CMS Banner Side Blog";
        $data['configuration']  = $this->M_Global->get_result("basic_configuration")->row_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/banner-side-blog', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_banner_side_blog($configurationId)
    {
        $getConfiguration   = $this->M_Global->get_list("basic_configuration", "configuration_id = '$configurationId' ")->row_array();

        $titleBanner        = $this->input->post("title_side_blog", true);
        $urlBanner          = $this->input->post("url_side_blog", true);

        $uploadImage        = $_FILES['banner_side_blog']['name'];

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 287;
            $config['max_height']           = 249;
            $config['min_width']            = 287;
            $config['min_height']           = 249;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_side_blog")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldBannerSide    = $getConfiguration['banner_side_blog'];

                if ($oldBannerSide != "banner-side-default.jpg") {
                    unlink(FCPATH . 'assets/website/images/' . $oldBannerSide);
                }

                $uploadData     = array('upload_data' => $this->upload->data());
                $newBanner      = $uploadData['upload_data']['file_name'];
            }

            $configuration = [
                "title_side_blog"       => $titleBanner,
                "url_side_blog"         => $urlBanner,
                "banner_side_blog"      => $newBanner,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $configuration = [
                "title_side_blog"       => $titleBanner,
                "url_side_blog"         => $urlBanner,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $update = $this->M_Global->update_data("configuration_id = '$configurationId' ", $configuration, "basic_configuration");

        if ($update) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to update');

            redirect($this->agent->referrer());
        }
    }
    ## end banner side blog

    ## ig footer
    public function ig_footer()
    {
        $data['title']          = "Milou - CMS Instagram (Footer)";
        $data['getInstagram']   = $this->M_Global->get_result("instagram")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/instagram', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_ig_footer()
    {
        $uploadImage = $_FILES['ig_image']['name'];

        $igUrl  = $this->input->post("ig_url", true);
        $status = $this->input->post("status", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {

            $config['upload_path']          = 'assets/website/images/instagram';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 1024;
            $config['max_width']            = 80;
            $config['max_height']           = 82;
            $config['min_width']            = 80;
            $config['min_height']           = 82;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("ig_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $dataUpload     = array('upload_data' => $this->upload->data());
                $newImage       = $dataUpload['upload_data']['file_name'];
            }

            $instagram  = [
                "instagram_url"     => $igUrl,
                "instagram_image"   => $newImage,
                "status"            => $status,
                "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $instagram  = [
                "instagram_url"     => $igUrl,
                "status"            => $status,
                "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $created = $this->M_Global->insert($instagram, "instagram");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect($this->agent->referrer());
        }
    }

    public function get_instagram($instagramId)
    {
        $getInstagram   = $this->M_Global->get_list("instagram", "instagram_id = '$instagramId' ")->row_array();

        echo json_encode($getInstagram);
    }

    public function edit_ig_footer()
    {
        $uploadImage = $_FILES['ig_image']['name'];

        $instagramId    = $this->input->post("instagram_id", true);
        $instagramUrl   = $this->input->post("ig_url", true);
        $status         = $this->input->post("status", true);

        $getOldImage    = $this->M_Global->get_list("instagram", "instagram_id = '$instagramId' ")->row_array();

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/instagram';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 1024;
            $config['max_width']            = 80;
            $config['max_height']           = 82;
            $config['min_width']            = 80;
            $config['min_height']           = 82;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("ig_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldImage   = $getOldImage['instagram_image'];

                if ($oldImage != "default.png") {
                    unlink(FCPATH . 'assets/website/images/instagram/' . $oldImage);
                }

                $dataUpload     = array('upload_data' => $this->upload->data());
                $newImage       = $dataUpload['upload_data']['file_name'];
            }

            $instagram  = [
                "instagram_url"     => $instagramUrl,
                "instagram_image"   => $newImage,
                "status"            => $status,
                "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $instagram  = [
                "instagram_url"     => $instagramUrl,
                "status"            => $status,
                "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $update = $this->M_Global->update_data("instagram_id = '$instagramId' ", $instagram, "instagram");

        if ($update) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect($this->agent->referrer());
        }
    }

    public function remove_ig_footer()
    {
        $instagramId = $this->input->post("instagram_id", true);

        $delete = $this->M_Global->delete("instagram", "instagram_id = '$instagramId' ");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }
    ## end ig footer

    ## menu setting
    public function category()
    {
        $postData   = $this->input->post();
        $data       = $this->M_Custom->getCategory($postData);

        echo json_encode($data);
    }

    public function menu_setting()
    {
        $data['title']          = "Milou - CMS Menu Settings";
        $data['getCategory']    = $this->M_Global->getmultiparam("category", "parent_id = 0 AND category_level = 'Parent' ")->result_array();
        $data['getStaticPage']  = $this->M_Global->getmultiparam("static_page", "category_id = 0 ")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/menu-setting', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_menu_setting()
    {
        $categoryLevel  = $this->input->post("category_level", true);
        $categoryPage   = $this->input->post("category_page", true);
        $parent         = $this->input->post("parent", true);
        $menuName       = $this->input->post("menu_name", true);
        $categoryUrl    = $this->input->post("static_page", true);
        $modules        = $this->input->post('module', true);
        $toSlug         = trim(strtolower($modules));
        $status         = $this->input->post("status", true);
        $getCategory    = $this->M_Global->getmultiparam("category", "category_id = '$parent' ")->row_array();
        $parentName     = isset($getCategory['category_name']) ? $getCategory['category_name'] : null;
        $getStaticPage  = $this->M_Global->getmultiparam("static_page", "static_page_id = '$categoryUrl' ")->row_array();

        ## position menu
        if ($categoryLevel == "Parent" && $parent == "") {
            $getAllCategory     = $this->M_Global->getmultiparam("category", "category_level = 'Parent' AND parent_id = 0 ")->result_array();
            $numbersPosition    = array_column($getAllCategory, 'category_position');
            $maxNumbers         = max($numbersPosition);
            $categoryPosition   = $maxNumbers + 1;
        } elseif ($categoryLevel == "Child" && $parent != "") {

            $getAllCategory     = $this->M_Global->getmultiparam("category", "category_level = 'Child' AND parent_id = '$parent' ")->result_array();
            $numbersPosition    = array_column($getAllCategory, 'category_position');
            $maxNumbers         = max($numbersPosition);
            $categoryPosition   = $maxNumbers + 1;
        }
        ## end position menu

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($categoryPage == "Static Page") {
            if ($categoryUrl == null) {
                $slug = null;
            } else {
                $slug = base_url("static-page/" . $getStaticPage['static_page_id'] . "/" . $getStaticPage['slug']);
            }
        } else if ($categoryPage == "Module") {
            if ($modules) {
                $out        = explode(" ", $toSlug);
                $result     = implode("-", $out);
                $slug       = base_url($result);
            } else {
                $slug       = null;
            }
        }

        ## insert category
        $data = [
            "parent_id"         => $parent,
            "parent_name"       => $parentName,
            "category_name"     => $menuName,
            "category_url"      => $slug,
            "category_level"    => $categoryLevel,
            "category_page"     => $categoryPage,
            "category_position" => $categoryPosition,
            "status"            => $status,
            "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $createId = $this->M_Global->insert_id($data, "category");

        ## update table static page
        $update = [
            "category_id"   => $createId
        ];

        $updated = $this->M_Global->update_data("static_page_id = '$categoryUrl' ", $update, "static_page");

        if ($createId) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect($this->agent->referrer());
        }

        if (!$updated) {
            $this->session->set_flashdata('error', 'Something error');

            redirect($this->agent->referrer());
        }
    }

    public function page_edit_menu_setting($category_id)
    {
        $data['title']          = "Milou - CMS Menu Settings";
        $data['getCategory1']   = $this->M_Global->getmultiparam("category", "category_id = '$category_id' ")->row_array();
        $categoryUrl            = $data['getCategory1']['category_url'];
        $data['getCategory2']   = $this->M_Global->getmultiparam("category", "parent_id = 0 AND category_level = 'Parent' AND category_id != '$category_id' ")->result_array();
        $parentId               = $data['getCategory1']['parent_id'];
        $data['getParent']      = $this->M_Global->getmultiparam("category", "category_id = '$parentId' ")->row_array();
        $data['getStaticPage1'] = $this->M_Global->getmultiparam("static_page", "category_id = '$category_id' ")->row_array();
        $data['getStaticPage2'] = $this->M_Global->getmultiparam("static_page", "category_id = 0 ")->result_array();

        if ($categoryUrl != null) {
            $parts  = explode("/", $categoryUrl);

            if ($parts[4] != "static-page") {
                $data['modules'] = $parts[4];
            } else {
                $data['modules'] = "";
            }
        } else {
            $data['modules'] = "";
        }

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-menu-setting/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_menu_setting()
    {
        $categoryId         = $this->input->post("category_id", true);
        $categoryLevel      = $this->input->post("category_level", true);
        $categoryPage       = $this->input->post("category_page", true);
        $menuName           = $this->input->post("menu_name", true);
        $status             = $this->input->post("status", true);
        $categoryUrl        = $this->input->post("static_page", true);
        $modules            = $this->input->post('module', true);
        $toSlug             = trim(strtolower($modules));

        $getStaticPage1     = $this->M_Global->get_list("static_page", "static_page_id = '$categoryUrl' ")->row_array();
        $getStaticPage2     = $this->M_Global->get_list("static_page", "category_id = '$categoryId' ")->row_array();
        $staticPageIdOn     = $getStaticPage2['static_page_id'];

        $getCategory        = $this->M_Global->get_list("category", "category_id = '$categoryId' ")->row_array();
        $positionOld        = $getCategory['category_position'];
        $levelOld           = $getCategory['category_level'];

        $checkCategory      = $this->M_Global->get_list("category", "parent_id = '$categoryId' ")->result_array();

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($categoryPage == "Static Page") {
            if ($categoryUrl == null) {
                $slug           = null;
                $categoryPage   = null;
            } else {
                $slug           = base_url("static-page/" . $getStaticPage1['static_page_id'] . "/" . $getStaticPage1['slug']);
            }
        } else if ($categoryPage == "Module") {
            if ($modules != "") {
                $out            = explode(" ", $toSlug);
                $result         = implode("-", $out);
                $slug           = base_url($result);
            } else {
                $slug           = null;
                $categoryPage   = null;
            }
        }

        if ($categoryLevel == "Parent") {
            ## update value if child move to parent
            $parent             = 0;
            $parentName         = null;
            ## end update value if child move to parent

            ## -->
            if ($levelOld == "Child") {
                ## update position parent if child move to parent
                $getCategoryParent  = $this->M_Global->get_list("category", "category_level = 'Parent' ")->result_array();
                $numberPosition     = array_column($getCategoryParent, 'category_position');
                $maxNumber          = max($numberPosition);
                $categoryPosition   = $maxNumber + 1;
                ## end update position parent if child move to parent

                ## update position all child if child move to parent
                $targetChild        = $this->M_Global->getmultiparam("category", "category_position > '$positionOld' and category_level = 'Child' ")->result_array();

                foreach ($targetChild as $target) {
                    $targetId           = $target['category_id'];
                    $positionTarget     = $target['category_position'] - 1;

                    $positionAllChild = [
                        "category_position"     => $positionTarget,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];
                    $this->M_Global->update_data("category_id = '$targetId' ", $positionAllChild, "category");
                }
                ## end update position all child if child move to parent

            } else {
                $categoryPosition   = $this->input->post("category_position", true);
            }
            ## <--


            ## update all child if update parent menu name
            foreach ($checkCategory as $category) {
                $catId  = $category["category_id"];

                $allChild = [
                    "parent_name"       => $menuName,
                    "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
                ];
                $this->M_Global->update_data("category_id = '$catId' ", $allChild, "category");
            }
            ## end update all child if parent update menu name

        } elseif ($categoryLevel == "Child") {

            ## update value if parent move to child
            $parent             = $this->input->post("parent", true);
            $getCategoryName    = $this->M_Global->get_list("category", "category_id = '$parent' ")->row_array();
            $parentName         = isset($getCategoryName['category_name']) ? $getCategoryName['category_name'] : "";
            ## end update value if parent move to child

            ## -->
            if ($levelOld == "Parent") {
                ## update position child if parent move to child
                $getCategoryChild   = $this->M_Global->getmultiparam("category", "parent_id = '$parent' AND category_level = 'Child' ")->result_array();
                $numberPosition     = array_column($getCategoryChild, 'category_position');

                if (empty($numberPosition)) {
                    $categoryPosition   = 1;
                } else {
                    $maxNumber          = max($numberPosition);
                    $categoryPosition   = $maxNumber + 1;
                }
                ## end update position child if parent move to child

                ## update position all parent if parent move to child
                $targetParent   = $this->M_Global->getmultiparam("category", "category_position > '$positionOld' and category_level = 'Parent' ")->result_array();

                foreach ($targetParent as $target) {
                    $targetId           = $target['category_id'];
                    $positionTarget     = $target['category_position'] - 1;

                    $positionAllParent = [
                        "category_position"     => $positionTarget,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];
                    //$this->M_Global->update_data("category_id = '$targetId' ", $positionAllParent, "category");
                }
                ## end update position all parent if parent move to child

                ## update position all child if parent move to child
                $targetChild   = $this->M_Global->getmultiparam("category", "category_position > '$positionOld' and category_level = 'Child' and parent_id = '$parent' ")->result_array();

                foreach ($targetChild as $target) {
                    $targetIdChild           = $target['category_id'];
                    $positionTargetChild     = $target['category_position'] - 1;

                    $positionAllChild = [
                        "category_position"     => $positionTargetChild,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];
                    $this->M_Global->update_data("category_id = '$targetIdChild' ", $positionAllChild, "category");
                }
                ## end update position all parent if parent move to child
            }
            ## <--

            ## check value max category position level parent
            $getCategoryParent      = $this->M_Global->get_list("category", "category_level = 'Parent' ")->result_array();
            $numberPositionParent   = array_column($getCategoryParent, 'category_position');
            $maxNumberParent        = max($numberPositionParent);

            ## update all child if update parent move to child
            foreach ($checkCategory as $category) {
                $targetId  = $category["category_id"];

                $allChild = [
                    "parent_id"         => 0,
                    "parent_name"       => null,
                    "category_level"    => "Parent",
                    "category_position" => $maxNumberParent++,
                    "status"            => "Hide",
                    "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
                ];
                $this->M_Global->update_data("category_id = '$targetId' ", $allChild, "category");
            }
            ## end update all child if update parent move to child
        }

        $data = [
            "parent_id"         => $parent,
            "parent_name"       => $parentName,
            "category_name"     => $menuName,
            "category_level"    => $categoryLevel,
            "category_page"     => $categoryPage,
            "category_position" => $categoryPosition,
            "category_url"      => $slug,
            "status"            => $status,
            "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
        ];
        $updatedMain = $this->M_Global->update_data("category_id = '$categoryId' ", $data, "category");


        ## update static page
        $staticPageNew = [
            "category_id"   => $categoryId
        ];
        $updated3 = $this->M_Global->update_data("static_page_id = '$categoryUrl' ", $staticPageNew, "static_page");

        if (!$updated3) {
            $this->session->set_flashdata('error', 'Something error');

            redirect('menu-setting');
        }

        if ($categoryUrl == null || $categoryPage == "Module" || $categoryUrl != $staticPageIdOn) {
            $staticPageOn = [
                "category_id"   => 0,
                "updated_at"    => date('Y-m-d H:i:s', strtotime('now'))
            ];
            $updated4 = $this->M_Global->update_data("static_page_id = '$staticPageIdOn' ", $staticPageOn, "static_page");

            if (!$updated4) {
                $this->session->set_flashdata('error', 'Something error');

                redirect('menu-setting');
            }
        }
        ## end update static page

        if ($updatedMain) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('menu-setting');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('menu-setting');
        }



        // if (!empty($getTargets)) {
        //     foreach ($getTargets as $target) {
        //         $catTargetId        = $target['category_id'];
        //         $catPositionTargets = $target['category_position'] - 1;

        //         $position = [
        //             "category_position"     => $catPositionTargets,
        //             "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
        //         ];
        //         $updated5 = $this->M_Global->update_data("category_id = '$catTargetId' ", $position, "category");

        //         if (!$updated5) {
        //             $this->session->set_flashdata('error', 'Something error');

        //             redirect('menu-setting');
        //         }
        //     }
        // }
    }

    public function get_category_name($id)
    {
        $getCategory = $this->M_Global->getmultiparam("category", "category_id = '$id' ")->row_array();

        echo json_encode($getCategory);
    }

    public function remove_menu_setting()
    {
        $categoryId         = $this->input->post("category_id", true);

        $getCategory        = $this->M_Global->getmultiparam("category", "category_id = '$categoryId' ")->row_array();
        $categoryLevel      = $getCategory['category_level'];
        $parentId           = $getCategory['parent_id'];

        $getStaticPage      = $this->M_Global->getmultiparam("static_page", "category_id = '$categoryId' ")->row_array();
        $staticPageIdOn     = $getStaticPage['static_page_id'];

        if ($categoryLevel == "Parent" && $getCategory['parent_id'] == 0) {
            $getCategoryChild   = $this->M_Global->getmultiparam("category", "parent_id = '$categoryId' ")->result_array();

            $catPositionOld     = $getCategory['category_position'];
            $getTargets         = $this->M_Global->getmultiparam("category", "category_position > '$catPositionOld' AND category_level = 'Parent' AND parent_id = 0")->result_array();

            $getAllCategory     = $this->M_Global->getmultiparam("category", "category_level = 'Parent' AND parent_id = 0 ")->result_array();
            $numbersPosition    = array_column($getAllCategory, 'category_position');
            $maxNumbers         = max($numbersPosition);

            foreach ($getCategoryChild as $category) {
                $catId  = $category["category_id"];

                $allChild = [
                    "parent_id"         => 0,
                    "parent_name"       => "",
                    "category_level"    => "Parent",
                    "category_position" => $maxNumbers++,
                    "status"            => "Hide",
                    "updated_at"        => date('Y-m-d H:i:s', strtotime('now'))
                ];
                $updated1 = $this->M_Global->update_data("category_id = '$catId' ", $allChild, "category");

                if (!$updated1) {
                    $this->session->set_flashdata('error', 'Something error');

                    redirect('menu-setting');
                }
            }
        } elseif ($getCategory['category_level'] == "Child" && $getCategory['parent_id'] == $parentId) {
            $catPositionOld     = $getCategory['category_position'];
            $getTargets         = $this->M_Global->getmultiparam("category", "category_position > '$catPositionOld' AND category_level = 'Child' AND parent_id = '$parentId' ")->result_array();
        }

        $delete = $this->M_Global->delete("category", "category_id = '$categoryId' ");

        if ($delete) {
            $staticPageOn = [
                "category_id"   => 0
            ];
            $updated2 = $this->M_Global->update_data("static_page_id = '$staticPageIdOn' ", $staticPageOn, "static_page");

            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }

        if (!$updated2) {
            $this->session->set_flashdata('error', 'Something error');

            redirect('menu-setting');
        }

        if ($getTargets) {
            foreach ($getTargets as $target) {
                $catTargetId        = $target['category_id'];
                $catPositionTargets = $target['category_position'] - 1;

                $position = [
                    "category_position"     => $catPositionTargets,
                    "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                ];
                $updated3 = $this->M_Global->update_data("category_id = '$catTargetId' ", $position, "category");

                if (!$updated3) {
                    $this->session->set_flashdata('error', 'Something error');

                    redirect('menu-setting');
                }
            }
        }
    }

    public function edit_position_up($categoryId)
    {
        $getCategory        = $this->M_Global->getmultiparam("category", "category_id = '$categoryId' ")->row_array();
        $parentId           = $getCategory['parent_id'];

        if ($getCategory['category_level'] == "Parent" && $getCategory['parent_id'] == 0) {
            $categoryPosition   = $getCategory['category_position'];
            $countTargets       = $this->M_Global->getmultiparam("category", "category_position < '$categoryPosition' AND parent_id = 0 ")->num_rows();

            if ($categoryPosition == 1) {
                echo "error";
                die;
            } else {
                $moveCategory       = ($categoryPosition - $categoryPosition) + $countTargets;

                $target             = $this->M_Global->getmultiparam("category", "category_position = '$moveCategory' AND category_level = 'Parent' AND parent_id = 0 ")->row_array();
                $categoryIdTargets  = $target['category_id'];
                $catPositionTarget  = $target['category_position'] + 1;

                $target = [
                    "category_position"     => $catPositionTarget,
                    "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                ];

                $updateTargets = $this->M_Global->update_data("category_id = '$categoryIdTargets' ", $target, "category");

                if ($updateTargets) {
                    $positionOld = [
                        "category_position"     => $moveCategory,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];

                    $updatePositionOld = $this->M_Global->update_data("category_id = '$categoryId' ", $positionOld, "category");

                    if ($updatePositionOld) {
                        redirect("menu-setting");
                    } else {
                        echo "error";
                        die;
                    }
                } else {
                    echo "error";
                    die;
                }
            }
        } elseif ($getCategory['category_level'] == "Child" && $getCategory['parent_id'] == $parentId) {
            $categoryPosition   = $getCategory['category_position'];
            $countTargets       = $this->M_Global->getmultiparam("category", "category_position < '$categoryPosition' AND parent_id = '$parentId' ")->num_rows();

            if ($categoryPosition == 1) {
                echo "error";
                die;
            } else {
                $moveCategory       = ($categoryPosition - $categoryPosition) + $countTargets;

                $target             = $this->M_Global->getmultiparam("category", "category_position = '$moveCategory' AND category_level = 'Child' AND parent_id = '$parentId' ")->row_array();
                $categoryIdTargets  = $target['category_id'];
                $catPositionTarget  = $target['category_position'] + 1;

                $targets = [
                    "category_position"     => $catPositionTarget,
                    "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                ];

                $updateTargets = $this->M_Global->update_data("category_id = '$categoryIdTargets' ", $targets, "category");

                if ($updateTargets) {
                    $positionOld = [
                        "category_position"     => $moveCategory,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];

                    $updatePositionOld = $this->M_Global->update_data("category_id = '$categoryId' ", $positionOld, "category");

                    if ($updatePositionOld) {
                        redirect("menu-setting");
                    } else {
                        echo "error";
                        die;
                    }
                } else {
                    echo "error";
                    die;
                }
            }
        }
    }

    public function edit_position_down($categoryId)
    {
        $getCategory1       = $this->M_Global->getmultiparam("category", "category_id = '$categoryId' ")->row_array();
        $parentId           = $getCategory1['parent_id'];

        if ($getCategory1['category_level'] == "Parent" && $getCategory1['parent_id'] == 0) {
            $getCategory2       = $this->M_Global->getmultiparam("category", "category_level = 'Parent' AND parent_id = 0 ")->result_array();
            $categoryPosition   = $getCategory1['category_position'];
            $countTargets       = $this->M_Global->getmultiparam("category", "category_position > '$categoryPosition' AND parent_id = 0 ")->num_rows();

            $numbersPosition    = array_column($getCategory2, 'category_position');
            $maxNumbers         = max($numbersPosition);

            if ($categoryPosition == $maxNumbers) {
                echo "error";
                die;
            } else {
                $moveCategory       = $categoryPosition + $countTargets;

                $target             = $this->M_Global->getmultiparam("category", "category_position = '$moveCategory' AND category_level = 'Parent' AND parent_id = 0 ")->row_array();
                $categoryIdTargets  = $target['category_id'];
                $catPositionTarget  = $target['category_position'] - 1;

                $target = [
                    "category_position"     => $catPositionTarget,
                    "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                ];

                $updateTargets = $this->M_Global->update_data("category_id = '$categoryIdTargets' ", $target, "category");

                if ($updateTargets) {
                    $positionOld = [
                        "category_position"     => $moveCategory,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];

                    $updatePositionOld = $this->M_Global->update_data("category_id = '$categoryId' ", $positionOld, "category");

                    if ($updatePositionOld) {
                        redirect("menu-setting");
                    } else {
                        echo "error";
                        die;
                    }
                } else {
                    echo "error";
                    die;
                }
            }
        } elseif ($getCategory1['category_level'] == "Child" && $getCategory1['parent_id'] == $parentId) {
            $getCategory2       = $this->M_Global->getmultiparam("category", "category_level = 'Child' AND parent_id = '$parentId' ")->result_array();
            $categoryPosition   = $getCategory1['category_position'];
            $countTargets       = $this->M_Global->getmultiparam("category", "category_position > '$categoryPosition' AND parent_id = '$parentId' ")->num_rows();

            $numbersPosition    = array_column($getCategory2, 'category_position');
            $maxNumbers         = max($numbersPosition);

            if ($categoryPosition == $maxNumbers) {
                echo "error";
                die;
            } else {
                $moveCategory       = $categoryPosition + $countTargets;

                $target             = $this->M_Global->getmultiparam("category", "category_position = '$moveCategory' AND category_level = 'Child' AND parent_id = '$parentId' ")->row_array();
                $categoryIdTargets  = $target['category_id'];
                $catPositionTarget  = $target['category_position'] - 1;

                $target = [
                    "category_position"     => $catPositionTarget,
                    "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                ];

                $updateTargets = $this->M_Global->update_data("category_id = '$categoryIdTargets' ", $target, "category");

                if ($updateTargets) {
                    $positionOld = [
                        "category_position"     => $moveCategory,
                        "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
                    ];

                    $updatePositionOld = $this->M_Global->update_data("category_id = '$categoryId' ", $positionOld, "category");

                    if ($updatePositionOld) {
                        redirect("menu-setting");
                    } else {
                        echo "error";
                        die;
                    }
                } else {
                    echo "error";
                    die;
                }
            }
        }
    }
    ## end menu setting


    ## static page
    public function static_pages()
    {
        $data['title']          = "Milou - CMS Static Page";
        $data['getStaticPage']  = $this->M_Global->get_result("static_page")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/static-page', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function page_add_static_pages()
    {
        $data['title']          = "Milou - CMS Static Page";

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-static-page/add', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_static_pages()
    {
        $uploadImage1   = $_FILES['banner_page']['name'];
        $uploadImage2   = $_FILES['banner_page_side']['name'];

        $title          = $this->input->post("title", true);
        $positionTitle  = $this->input->post("position_title", true);
        $metaDesc       = $this->input->post("meta_description", true);
        $metaKey        = $this->input->post("meta_keyword", true);
        $content        = $this->input->post("content", true);
        $toSlug         = trim(strtolower($title));
        $out            = explode(" ", $toSlug);
        $slug           = implode("-", $out);

        ## main banner
        $config['upload_path']          = 'assets/website/images/banner-page';
        $config['allowed_types']        = 'jpg|jpeg|png|gif';
        $config['max_size']             = 2048;
        $config['max_width']            = 1920;
        $config['max_height']           = 320;
        $config['min_width']            = 1920;
        $config['min_height']           = 320;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload("banner_page")) {
            $error          = $this->upload->display_errors();
            $formatted_text = str_replace(['<p>', '</p>'], '', $error);

            $this->session->set_flashdata('error_upload', $formatted_text);

            redirect($this->agent->referrer());
        } else {
            $data       = array('upload_data' => $this->upload->data());
            $newImage   = $data['upload_data']['file_name'];
        }
        ## end main banner

        if ($uploadImage2) {
            ##banner side
            $config['upload_path']          = 'assets/website/images/banner-page';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 636;
            $config['max_height']           = 565;
            $config['min_width']            = 636;
            $config['min_height']           = 565;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_page_side")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData = array('upload_data' => $this->upload->data());
                $newImage2  = $uploadData['upload_data']['file_name'];
            }
            ## end banner side

            $staticPage = [
                "slug"                      => $slug,
                "static_page_title"         => $title,
                "position_title"            => $positionTitle,
                "meta_desc"                 => $metaDesc,
                "meta_keyword"              => $metaKey,
                "static_page_desc"          => $content,
                "static_page_banner"        => $newImage,
                "static_page_banner_side"   => $newImage2,
                "created_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $staticPage = [
                "slug"                      => $slug,
                "static_page_title"         => $title,
                "position_title"            => $positionTitle,
                "meta_desc"                 => $metaDesc,
                "meta_keyword"              => $metaKey,
                "static_page_desc"          => $content,
                "static_page_banner"        => $newImage,
                "created_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }


        $created = $this->M_Global->insert($staticPage, "static_page");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('static-pages');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('static-pages');
        }
    }

    public function page_edit_static_pages($static_page_id)
    {
        $data['title']          = "Milou - CMS Static Page";
        $data['getStaticPage']  = $this->M_Global->get_list("static_page", "static_page_id = '$static_page_id' ")->row_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-static-page/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_static_pages($static_page_id)
    {
        $getStaticPage  = $this->M_Global->get_list("static_page", "static_page_id = '$static_page_id' ")->row_array();
        $uploadImage1   = $_FILES['banner_page']['name'];
        $uploadImage2   = $_FILES['banner_page_side']['name'];

        $title          = $this->input->post('title', true);
        $positionTitle  = $this->input->post("position_title", true);
        $metaDesc       = $this->input->post("meta_description", true);
        $metaKey        = $this->input->post("meta_keyword", true);
        $content        = $this->input->post("content", true);
        $toSlug         = trim(strtolower($title));
        $out            = explode(" ", $toSlug);
        $slug           = implode("-", $out);


        if ($uploadImage1 && $uploadImage2) {
            ## banner main
            $config['upload_path']          = 'assets/website/images/banner-page';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 1920;
            $config['max_height']           = 320;
            $config['min_width']            = 1920;
            $config['min_height']           = 320;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_page")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldData    = $getStaticPage['static_page_banner'];

                if ($oldData != "default.png") {
                    unlink(FCPATH . 'assets/website/images/banner-page/' . $oldData);
                }

                $data       = array('upload_data' => $this->upload->data());
                $newImage   = $data['upload_data']['file_name'];
            }
            ## banner main

            ##banner side
            $config['upload_path']          = 'assets/website/images/banner-page';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 636;
            $config['max_height']           = 565;
            $config['min_width']            = 636;
            $config['min_height']           = 565;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_page_side")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData = array('upload_data' => $this->upload->data());
                $newImage2  = $uploadData['upload_data']['file_name'];
            }
            ## end banner side

            $staticPage = [
                "slug"                      => $slug,
                "static_page_title"         => $title,
                "position_title"            => $positionTitle,
                "meta_desc"                 => $metaDesc,
                "meta_keyword"              => $metaKey,
                "static_page_desc"          => $content,
                "static_page_banner"        => $newImage,
                "static_page_banner_side"   => $newImage2,
                "updated_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImage1) {
            ## banner main
            $config['upload_path']          = 'assets/website/images/banner-page';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 1920;
            $config['max_height']           = 320;
            $config['min_width']            = 1920;
            $config['min_height']           = 320;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_page")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldData    = $getStaticPage['static_page_banner'];

                if ($oldData != "default.png") {
                    unlink(FCPATH . 'assets/website/images/banner-page/' . $oldData);
                }

                $data       = array('upload_data' => $this->upload->data());
                $newImage   = $data['upload_data']['file_name'];
            }
            ## banner main

            $staticPage = [
                "slug"                      => $slug,
                "static_page_title"         => $title,
                "position_title"            => $positionTitle,
                "meta_desc"                 => $metaDesc,
                "meta_keyword"              => $metaKey,
                "static_page_desc"          => $content,
                "static_page_banner"        => $newImage,
                "updated_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImage2) {
            ##banner side
            $config['upload_path']          = 'assets/website/images/banner-page';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 636;
            $config['max_height']           = 565;
            $config['min_width']            = 636;
            $config['min_height']           = 565;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_page_side")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData = array('upload_data' => $this->upload->data());
                $newImage2  = $uploadData['upload_data']['file_name'];
            }
            ## end banner side

            $staticPage = [
                "slug"                      => $slug,
                "static_page_title"         => $title,
                "position_title"            => $positionTitle,
                "meta_desc"                 => $metaDesc,
                "meta_keyword"              => $metaKey,
                "static_page_desc"          => $content,
                "static_page_banner_side"   => $newImage2,
                "updated_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $staticPage = [
                "slug"                  => $slug,
                "static_page_title"     => $title,
                "position_title"        => $positionTitle,
                "meta_desc"             => $metaDesc,
                "meta_keyword"          => $metaKey,
                "static_page_desc"      => $content,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $updated = $this->M_Global->update_data("static_page_id = '$static_page_id' ", $staticPage, "static_page");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('static-pages');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('static-pages');
        }
    }

    public function get_static_pages($id)
    {
        $getStaticPage  = $this->M_Global->getmultiparam("static_page", "static_page_id = '$id' ")->row_array();

        echo json_encode($getStaticPage);
    }

    public function remove_static_pages()
    {
        $staticPageId   = $this->input->post("static_page_id", true);
        $categoryId     = $this->input->post("category_id", true);

        $delete = $this->M_Global->delete("static_page", "static_page_id = '$staticPageId' ");

        if ($delete) {
            $data = [
                "category_url"  => null,
                "updated_at"    => date('Y-m-d H:i:s', strtotime('now'))
            ];
            $update = $this->M_Global->update_data("category_id = '$categoryId' ", $data, "category");

            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }
    # end static page


    ## Banner Slider
    public function banner_slider()
    {
        $data['title']          = "Milou - CMS Static Page";
        $data['slider']         = $this->M_Global->get_result("banner_slider")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/banner-slider', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_banner_slider()
    {
        $uploadImage                    = $_FILES['slider']['name'];

        $desc1  = $this->input->post("desc_1", true);
        $desc2  = $this->input->post("desc_2", true);
        $desc3  = $this->input->post("desc_3", true);
        $status = $this->input->post("status", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/banner-slider';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 1920;
            $config['max_height']           = 878;
            $config['min_width']            = 1920;
            $config['min_height']           = 878;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("slider")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $data       = array('upload_data' => $this->upload->data());
                $newImage   = $data['upload_data']['file_name'];
            }

            $banner = [
                "banner_slider_image"   => $newImage,
                "banner_first_text"     => $desc1,
                "banner_second_text"    => $desc2,
                "banner_third_text"     => $desc3,
                "status"                => $status,
                "created_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $created = $this->M_Global->insert($banner, "banner_slider");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('banner-slider');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('banner-slider');
        }
    }

    public function page_edit_banner_slider($bannerId)
    {
        $data['title']           = "Milou - CMS Banner Slider";
        $data['getBannerSlider'] = $this->M_Global->getmultiparam("banner_slider", "banner_slider_id = '$bannerId' ")->row_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-banner-slider/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_banner_slider($bannerId)
    {
        $getBannerSlider    = $this->M_Global->get_list("banner_slider", "banner_slider_id = '$bannerId' ")->row_array();
        $uploadImage        = $_FILES['slider']['name'];

        $desc1  = $this->input->post("desc_1", true);
        $desc2  = $this->input->post("desc_2", true);
        $desc3  = $this->input->post("desc_3", true);
        $status = $this->input->post("status", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/banner-slider';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 1920;
            $config['max_height']           = 878;
            $config['min_width']            = 1920;
            $config['min_height']           = 878;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("slider")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldData    = $getBannerSlider['banner_slider_image'];

                if ($oldData != "default.png") {
                    unlink(FCPATH . 'assets/website/images/banner-slider/' . $oldData);
                }

                $data       = array('upload_data' => $this->upload->data());
                $newImage   = $data['upload_data']['file_name'];
            }

            $banner = [
                "banner_slider_image"   => $newImage,
                "banner_first_text"     => $desc1,
                "banner_second_text"    => $desc2,
                "banner_third_text"     => $desc3,
                "status"                => $status,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $banner = [
                "banner_first_text"     => $desc1,
                "banner_second_text"    => $desc2,
                "banner_third_text"     => $desc3,
                "status"                => $status,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $updated = $this->M_Global->update_data("banner_slider_id = '$bannerId' ", $banner, "banner_slider");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('banner-slider');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('banner-slider');
        }
    }

    public function get_banner_slider($id)
    {
        $getBannerSlider = $this->M_Global->getmultiparam("banner_slider", "banner_slider_id = '$id' ")->row_array();

        echo json_encode($getBannerSlider);
    }

    public function remove_banner_slider()
    {
        $bannerSliderId = $this->input->post("banner_slider_id", true);

        $delete = $this->M_Global->delete("banner_slider", "banner_slider_id = '$bannerSliderId' ");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }
    ## end banner slider


    ## gallery
    public function gallerys()
    {
        $data['title']              = "Milou - CMS Gallery";
        $data['getGallery']         = $this->M_Global->globalquery("SELECT * FROM gallery LEFT JOIN category_gallery ON gallery.category_gallery_id = category_gallery.category_gallery_id ")->result_array();
        $data['getCategoryGallery'] = $this->M_Global->get_result("category_gallery")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/gallery', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_gallerys()
    {
        $uploadImage        = $_FILES['gallery']['name'];

        $categoryGallery    = $this->input->post("category_gallery", true);
        $status             = $this->input->post("status", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/gallery/';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 263;
            $config['max_height']           = 290;
            $config['min_width']            = 263;
            $config['min_height']           = 290;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("gallery")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $data       = array('upload_data' => $this->upload->data());
                $newImage   = $data['upload_data']['file_name'];
            }

            $gallery = [
                "gallery_image"         => $newImage,
                "category_gallery_id"   => $categoryGallery,
                "status"                => $status,
                "created_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $created = $this->M_Global->insert($gallery, "gallery");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('gallerys');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('gallerys');
        }
    }

    public function page_edit_gallerys($galleryId)
    {
        $data['title']              = "Milou - CMS Gallery";
        $data['getGallery']         = $this->M_Global->q2join("gallery", "category_gallery", "a.category_gallery_id", "b.category_gallery_id", "gallery_id = '$galleryId' ")->row_array();
        $data['getCategoryGallery'] = $this->M_Global->get_result("category_gallery")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-gallery/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_gallerys($galleryId)
    {
        $getGallery     = $this->M_Global->get_list("gallery", "gallery_id = '$galleryId' ")->row_array();
        $uploadImage    = $_FILES['gallery']['name'];

        $categoryGallery    = $this->input->post("category_gallery", true);
        $status             = $this->input->post("status", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            $config['upload_path']          = 'assets/website/images/gallery/';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 263;
            $config['max_height']           = 290;
            $config['min_width']            = 263;
            $config['min_height']           = 290;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("gallery")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldData    = $getGallery['gallery_image'];

                if ($oldData != "default.png") {
                    unlink(FCPATH . 'assets/website/images/gallery/' . $oldData);
                }

                $data       = array('upload_data' => $this->upload->data());
                $newImage   = $data['upload_data']['file_name'];
            }

            $gallery = [
                "gallery_image"         => $newImage,
                "category_gallery_id"   => $categoryGallery,
                "status"                => $status,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $gallery = [
                "category_gallery_id"   => $categoryGallery,
                "status"                => $status,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $updated = $this->M_Global->update_data("gallery_id = '$galleryId' ", $gallery, "gallery");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('gallerys');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('gallerys');
        }
    }

    public function get_gallerys($id)
    {
        $getGallery  = $this->M_Global->get_list("gallery", "gallery_id = '$id' ")->row_array();

        echo json_encode($getGallery);
    }

    public function remove_gallerys()
    {
        $galleryId  = $this->input->post("gallery_id", true);

        $delete = $this->M_Global->delete("gallery", "gallery_id = '$galleryId' ");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }

    public function add_gallerys_category()
    {
        $categoryName   = $this->input->post("category_name", true);

        $data = [
            "category_gallery_name"     => $categoryName,
            "created_at"                => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $created = $this->M_Global->insert($data, "category_gallery");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('gallerys');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('gallerys');
        }
    }

    public function get_category_gallerys($categoryGalleryId)
    {
        $getCategoryGallery  = $this->M_Global->get_list("category_gallery", "category_gallery_id = '$categoryGalleryId' ")->row_array();

        echo json_encode($getCategoryGallery);
    }

    public function edit_gallerys_category()
    {
        $categoryGalleryId  = $this->input->post("category_gallery_id", true);
        $categoryName       = $this->input->post("category_name", true);

        $data = [
            "category_gallery_name"     => $categoryName,
            "updated_at"                => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $updated = $this->M_Global->update_data("category_gallery_id = '$categoryGalleryId' ", $data, "category_gallery");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('gallerys');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('gallerys');
        }
    }

    public function remove_gallerys_category()
    {
        $categoryGalleryId  = $this->input->post("category_gallery_id", true);
        $getGallery         = $this->M_Global->get_list("gallery", "category_gallery_id = '$categoryGalleryId' ")->result_array();

        foreach ($getGallery as $gallery) {
            $galleryId  = $gallery['gallery_id'];

            $gallery = [
                "category_gallery_id"   => 0,
                "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
            ];

            $updated1 = $this->M_Global->update_data("gallery_id = '$galleryId' ", $gallery, "gallery");

            if (!$updated1) {
                $this->session->set_flashdata('error', 'Something error');

                redirect($this->agent->referrer());
            }
        }

        $delete = $this->M_Global->delete("category_gallery", "category_gallery_id = '$categoryGalleryId' ");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }
    ## end gallery


    ## blog
    public function blog()
    {
        $postData   = $this->input->post();
        $data       = $this->M_Custom->getBlog($postData);

        echo json_encode($data);
    }

    public function blogs()
    {
        $data['title']      = "Milou - CMS Blog";
        $data['getBlog']    = $this->M_Global->get_result("blog")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/blog', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function page_add_blogs()
    {
        $data['title']          = "Milou - CMS Blog";
        $data['tag']            = $this->M_Global->get_result("blog_tag")->result_array();
        $data['blogCategory']   = $this->M_Global->get_result("blog_category")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-blog/add', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_blogs()
    {
        $uploadImageAuthor  = $_FILES['blog_image_author']['name'];
        $uploadImageEvents  = $_FILES['blog_image_events']['name'];

        $blogCategory   = $this->input->post("blog_category", true);
        $title          = $this->input->post("blog_title", true);
        $toSlug         = trim(strtolower($title));
        $desc           = $this->input->post("blog_desc", true);
        $author         = $this->input->post("blog_author", true);
        $publish        = $this->input->post("blog_publish", true);
        $lastUpdate     = $this->input->post("blog_last_update", true);
        $tags           = $this->input->post("blog_tags", true);
        $quote          = $this->input->post("blog_quote", true);
        $metaKeyword    = $this->input->post("meta_keyword", true);
        $metaDesc       = $this->input->post("meta_desc", true);
        $tagsImplode    = implode(",", $tags);
        $status         = $this->input->post("status", true);
        $out            = explode(" ", $toSlug);
        $result         = implode("-", $out);
        $slug           = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        ## image blog
        $config['upload_path']          = 'assets/website/images/blog/';
        $config['allowed_types']        = 'jpg|jpeg|png|gif';
        $config['max_size']             = 2048;
        $config['max_width']            = 851;
        $config['max_height']           = 350;
        $config['min_width']            = 851;
        $config['min_height']           = 350;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload("blog_image")) {
            $error          = $this->upload->display_errors();
            $formatted_text = str_replace(['<p>', '</p>'], '', $error);

            $this->session->set_flashdata('error_upload', $formatted_text);

            redirect($this->agent->referrer());
        } else {
            $uploadData1    = array('upload_data' => $this->upload->data());
            $newImage1      = $uploadData1['upload_data']['file_name'];
        }

        if ($uploadImageAuthor && $uploadImageEvents) {
            ## image blog author
            $config['upload_path']          = 'assets/website/images/blog/author';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 79;
            $config['max_height']           = 90;
            $config['min_width']            = 79;
            $config['min_height']           = 90;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_author")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData2    = array('upload_data' => $this->upload->data());
                $newImage2      = $uploadData2['upload_data']['file_name'];
            }

            ## image blog events
            $config['upload_path']          = 'assets/website/images/blog/events';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 360;
            $config['max_height']           = 532;
            $config['min_width']            = 360;
            $config['min_height']           = 532;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_events")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData3    = array('upload_data' => $this->upload->data());
                $newImage3      = $uploadData3['upload_data']['file_name'];
            }

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image"        => $newImage1,
                "blog_image_author" => $newImage2,
                "blog_image_events" => $newImage3,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
                "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImageAuthor) {
            ## image blog author
            $config['upload_path']          = 'assets/website/images/blog/author';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 79;
            $config['max_height']           = 90;
            $config['min_width']            = 79;
            $config['min_height']           = 90;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_author")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData2    = array('upload_data' => $this->upload->data());
                $newImage2      = $uploadData2['upload_data']['file_name'];
            }

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image"        => $newImage1,
                "blog_image_author" => $newImage2,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
                "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImageEvents) {
            ## image blog events
            $config['upload_path']          = 'assets/website/images/blog/events';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 360;
            $config['max_height']           = 532;
            $config['min_width']            = 360;
            $config['min_height']           = 532;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_events")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData3    = array('upload_data' => $this->upload->data());
                $newImage3      = $uploadData3['upload_data']['file_name'];
            }

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image"        => $newImage1,
                "blog_image_events" => $newImage3,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
                "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image"        => $newImage1,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
                "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        foreach ($tags as $tag) {
            $getTags = $this->M_Global->get_list("blog_tag", "blog_tag_name = '$tag' ")->num_rows();

            if ($getTags == 0) {

                $toSlugTag  = trim(strtolower($tag));
                $outTag     = explode(" ", $toSlugTag);
                $resultTag  = implode("-", $outTag);
                $slugTag    = $resultTag;

                $insertTags = [
                    "blog_tag_name"     => $tag,
                    "slug"              => $slugTag,
                    "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
                ];

                $created1 = $this->M_Global->insert($insertTags, "blog_tag");

                if (!$created1) {
                    $this->session->set_flashdata('error', 'Something error');

                    redirect('blogs');
                }
            }
        }

        $createdBlog    = $this->M_Global->insert($blog, "blog");

        if ($createdBlog) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('blogs');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('blogs');
        }
    }

    public function page_edit_blogs($blogId)
    {
        $data['title']          = "Milou - CMS Blog";

        $data['getBlog']        = $this->M_Global->get_list("blog", "blog_id = '$blogId' ")->row_array();
        $blogCategoryId         = $data['getBlog']['blog_category_id'];
        $data['blogCategory1']  = $this->M_Global->get_list("blog_category", "blog_category_id = '$blogCategoryId' ")->row_array();
        $data['blogCategory2']  = $this->M_Global->get_list("blog_category", "blog_category_id != '$blogCategoryId' ")->result_array();
        $blogTags               = explode(',', $data['getBlog']['blog_tags'], 20);
        $getTags                = $this->M_Global->get_result("blog_tag")->result_array();

        foreach ($blogTags as $blog) {
            $tagName[]  = $blog;
        }

        foreach ($getTags as $tag) {
            $blogTagName[] = $tag['blog_tag_name'];
        }

        $containsSearch         = array_diff(isset($blogTagName) ? $blogTagName : "", $tagName);
        $data['tagSelected']    = $tagName;
        $data['tagOption']      = $containsSearch;

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-blog/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_blogs($blogId)
    {
        $getBlog            = $this->M_Global->get_list("blog", "blog_id = '$blogId' ")->row_array();

        $uploadImage        = $_FILES['blog_image']['name'];
        $uploadImageAuthor  = $_FILES['blog_image_author']['name'];
        $uploadImageEvents  = $_FILES['blog_image_events']['name'];

        $blogCategory   = $this->input->post("blog_category", true);
        $title          = $this->input->post("blog_title", true);
        $toSlug         = trim(strtolower($title));
        $desc           = $this->input->post("blog_desc", true);
        $author         = $this->input->post("blog_author", true);
        $publish        = $this->input->post("blog_publish", true);
        $lastUpdate     = $this->input->post("blog_last_update", true);
        $tags           = $this->input->post("blog_tags", true);
        $quote          = $this->input->post("blog_quote", true);
        $metaKeyword    = $this->input->post("meta_keyword", true);
        $metaDesc       = $this->input->post("meta_desc", true);
        $tagsImplode    = implode(",", $tags);
        $status         = $this->input->post("status", true);
        $out            = explode(" ", $toSlug);
        $result         = implode("-", $out);
        $slug           = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage && $uploadImageAuthor && $uploadImageEvents) {
            ## main blog
            $config['upload_path']          = 'assets/website/images/blog/';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 851;
            $config['max_height']           = 350;
            $config['min_width']            = 851;
            $config['min_height']           = 350;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldData    = $getBlog['blog_image'];;

                if ($oldData != "default.png") {
                    unlink(FCPATH . 'assets/website/images/blog/' . $oldData);
                }
                $uploadData = array('upload_data' => $this->upload->data());
                $newImage   = $uploadData['upload_data']['file_name'];
            }
            ## end main blog

            ## image blog author
            $config['upload_path']          = 'assets/website/images/blog/author';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 79;
            $config['max_height']           = 90;
            $config['min_width']            = 79;
            $config['min_height']           = 90;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_author")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData2    = array('upload_data' => $this->upload->data());
                $newImage2      = $uploadData2['upload_data']['file_name'];
            }

            ## image blog events
            $config['upload_path']          = 'assets/website/images/blog/events';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 360;
            $config['max_height']           = 532;
            $config['min_width']            = 360;
            $config['min_height']           = 532;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_events")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData3    = array('upload_data' => $this->upload->data());
                $newImage3      = $uploadData3['upload_data']['file_name'];
            }

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image"        => $newImage,
                "blog_image_author" => $newImage2,
                "blog_image_events" => $newImage3,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
            ];
        } elseif ($uploadImage) {

            ## main blog
            $config['upload_path']          = 'assets/website/images/blog/';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 851;
            $config['max_height']           = 350;
            $config['min_width']            = 851;
            $config['min_height']           = 350;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $oldData    = $getBlog['blog_image'];;

                if ($oldData != "default.png") {
                    unlink(FCPATH . 'assets/website/images/blog/' . $oldData);
                }
                $uploadData = array('upload_data' => $this->upload->data());
                $newImage   = $uploadData['upload_data']['file_name'];
            }
            ## end main blog

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_image"        => $newImage,
                "blog_quote_author" => $quote,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
            ];
        } elseif ($uploadImageAuthor) {
            ## image blog author
            $config['upload_path']          = 'assets/website/images/blog/author';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 79;
            $config['max_height']           = 90;
            $config['min_width']            = 79;
            $config['min_height']           = 90;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_author")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData2    = array('upload_data' => $this->upload->data());
                $newImage2      = $uploadData2['upload_data']['file_name'];
            }

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image_author" => $newImage2,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
            ];
        } elseif ($uploadImageEvents) {
            ## image blog events
            $config['upload_path']          = 'assets/website/images/blog/events';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 360;
            $config['max_height']           = 532;
            $config['min_width']            = 360;
            $config['min_height']           = 532;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("blog_image_events")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData3    = array('upload_data' => $this->upload->data());
                $newImage3      = $uploadData3['upload_data']['file_name'];
            }

            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "blog_image_events" => $newImage3,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
            ];
        } else {
            $blog = [
                "blog_category_id"  => $blogCategory,
                "blog_title"        => $title,
                "blog_desc"         => $desc,
                "blog_author"       => $author,
                "blog_publish"      => $publish,
                "blog_last_update"  => $lastUpdate,
                "blog_tags"         => $tagsImplode,
                "blog_quote_author" => $quote,
                "slug"              => $slug,
                "blog_status"       => $status,
                "blog_meta_keyword" => $metaKeyword,
                "blog_meta_desc"    => $metaDesc,
            ];
        }

        foreach ($tags as $tag) {
            $getTags = $this->M_Global->get_list("blog_tag", "blog_tag_name = '$tag' ")->num_rows();

            if ($getTags == 0) {

                $toSlugTag  = trim(strtolower($tag));
                $outTag     = explode(" ", $toSlugTag);
                $resultTag  = implode("-", $outTag);
                $slugTag    = $resultTag;

                $insertTags = [
                    "blog_tag_name"     => $tag,
                    "slug"              => $slugTag,
                    "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
                ];
                $created1 = $this->M_Global->insert($insertTags, "blog_tag");

                if (!$created1) {
                    $this->session->set_flashdata('error', 'Something error');

                    redirect('blogs');
                }
            }
        }

        $updated = $this->M_Global->update_data("blog_id = '$blogId' ", $blog, "blog");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('blogs');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('blogs');
        }
    }

    public function get_blog($blogId)
    {
        $getBlog = $this->M_Global->get_list("blog", "blog_id = '$blogId' ")->row_array();

        echo json_encode($getBlog);
    }

    public function remove_blogs()
    {
        $blogId = $this->input->post("blog_id", true);

        $delete = $this->M_Global->delete("blog", "blog_id = '$blogId' ");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }
    ## end blog

    ## blog category
    public function blogs_category()
    {
        $data['title']              = "Milou - CMS Blog Category";
        $data['getBlogCategory']    = $this->M_Global->get_result("blog_category")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/blog-category', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_blogs_category()
    {
        $categoryName   = $this->input->post("blog_category_name", true);
        $status         = $this->input->post("status");
        $toSlug         = trim(strtolower($categoryName));
        $out            = explode(" ", $toSlug);
        $result         = implode("-", $out);
        $slug           = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        $data = [
            "blog_category_name"    => $categoryName,
            "blog_category_slug"    => $slug,
            "status"                => $status,
            "created_at"            => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $created = $this->M_Global->insert($data, "blog_category");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('blogs-category');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('blogs-category');
        }
    }

    public function get_blog_category($blogCategoryId)
    {
        $getBlogCategory = $this->M_Global->get_list("blog_category", "blog_category_id = '$blogCategoryId' ")->row_array();

        echo json_encode($getBlogCategory);
    }

    public function edit_blogs_category()
    {
        $blogCategoryId     = $this->input->post("blog_category_id", true);
        $blogCategoryName   = $this->input->post("blog_category_name", true);
        $status             = $this->input->post("status");
        $toSlug             = trim(strtolower($blogCategoryName));
        $out                = explode(" ", $toSlug);
        $result             = implode("-", $out);
        $slug               = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        $data = [
            "blog_category_name"    => $blogCategoryName,
            "blog_category_slug"    => $slug,
            "status"                => $status,
            "updated_at"            => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $updated = $this->M_Global->update_data("blog_category_id = '$blogCategoryId' ", $data, "blog_category");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('blogs-category');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('blogs-category');
        }
    }

    public function remove_blogs_category()
    {
        $blogCategoryId     = $this->input->post("blog_category_id", true);

        $this->M_Global->delete("blog_category", "blog_category_id = '$blogCategoryId' ");

        redirect("blogs-category");
    }
    ## end blog category

    ## blog tag
    public function blogs_tags()
    {
        $data['title']          = "Milou - CMS Blog Tag";
        $data['getBlogTag']     = $this->M_Global->get_result("blog_tag")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/blog-tag', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_blogs_tags()
    {
        $tagName    = $this->input->post("blog_tag_name", true);
        $status     = $this->input->post("status", true);
        $toSlug     = trim(strtolower($tagName));
        $out        = explode(" ", $toSlug);
        $result     = implode("-", $out);
        $slug       = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        $data = [
            "blog_tag_name"     => $tagName,
            "slug"              => $slug,
            "blog_tag_status"   => $status,
            "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $created = $this->M_Global->insert($data, "blog_tag");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('blogs-tags');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('blogs-tags');
        }
    }

    public function get_blog_tag($tagId)
    {
        $getBlogTag = $this->M_Global->get_list("blog_tag", "blog_tag_id = '$tagId' ")->row_array();

        echo json_encode($getBlogTag);
    }

    public function edit_blogs_tags()
    {
        $blogTagId  = $this->input->post("blog_tag_id", true);
        $tagName    = $this->input->post("blog_tag_name", true);
        $status     = $this->input->post("status", true);
        $toSlug     = trim(strtolower($tagName));
        $out        = explode(" ", $toSlug);
        $result     = implode("-", $out);
        $slug       = $result;

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        $data = [
            "blog_tag_name"     => $tagName,
            "slug"              => $slug,
            "blog_tag_status"   => $status,
            "created_at"        => date('Y-m-d H:i:s', strtotime('now'))
        ];

        $updated = $this->M_Global->update_data("blog_tag_id = '$blogTagId' ", $data, "blog_tag");

        if ($updated) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('blogs-tags');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('blogs-tags');
        }
    }
    ## end blog tag

    ## menu book
    public function menuBook()
    {
        $postData   = $this->input->post();
        $data       = $this->M_Custom->getMenuBook($postData);

        echo json_encode($data);
    }

    public function menu_book()
    {
        $data['title']              = "Milou - CMS Menu Book";

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/menu-book', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function page_add_menu_book()
    {
        $data['title']                  = "Milou - CMS Menu Book";
        $data['getMenuBookCategory']    = $this->M_Global->get_list("menu_book_category", "status = 'Show' ")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-menu-book/add', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_menu_book()
    {
        $uploadImage        = $_FILES['menu_book_image']['name'];
        $menuBookCategory   = $this->input->post("menu_book_category", true);
        $menuBookName       = $this->input->post("menu_book_name", true);
        $toSlug             = trim(strtolower($menuBookName));
        $out                = explode(" ", $toSlug);
        $slug               = implode("-", $out);
        $menuBookPrice      = $this->input->post("menu_book_price", true);
        $menuBookDesc       = $this->input->post("menu_book_desc", true);
        $status             = $this->input->post("status", true);
        $metaKeyword        = $this->input->post("meta_keyword", true);
        $metaDesc           = $this->input->post("meta_desc", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            ## image menu book
            $config['upload_path']          = 'assets/website/images/menu-book';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 500;
            $config['max_height']           = 500;
            $config['min_width']            = 500;
            $config['min_height']           = 500;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("menu_book_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData    = array('upload_data' => $this->upload->data());
                $newImage       = $uploadData['upload_data']['file_name'];
            }

            $menuBook = [
                "menu_book_category_id"     => $menuBookCategory,
                "menu_book_name"            => $menuBookName,
                "menu_book_price"           => $menuBookPrice,
                "menu_book_desc"            => $menuBookDesc,
                "menu_book_image"           => $newImage,
                "menu_book_status"          => $status,
                "menu_book_meta_keyword"    => $metaKeyword,
                "menu_book_meta_desc"       => $metaDesc,
                "slug"                      => $slug,
                "created_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $menuBook = [
                "menu_book_category_id"     => $menuBookCategory,
                "menu_book_name"            => $menuBookName,
                "menu_book_price"           => $menuBookPrice,
                "menu_book_desc"            => $menuBookDesc,
                "menu_book_status"          => $status,
                "menu_book_meta_keyword"    => $metaKeyword,
                "menu_book_meta_desc"       => $metaDesc,
                "slug"                      => $slug,
                "created_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $created = $this->M_Global->insert($menuBook, "menu_book");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('menu-book');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('menu-book');
        }
    }

    public function page_edit_menu_book($menuId)
    {

        $data['title']                  = "Milou - CMS Menu Book";
        $data['getMenuBook']            = $this->M_Global->q2join("menu_book", "menu_book_category", "a.menu_book_category_id", "b.menu_book_category_id", "menu_book_id = '$menuId' ")->row_array();
        $data['getMenuBookCategory']    = $this->M_Global->get_list("menu_book_category", "status = 'Show' ")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/crud-menu-book/edit', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function edit_menu_book($menuId)
    {
        $uploadImage        = $_FILES['menu_book_image']['name'];

        $menuBookCategory   = $this->input->post("menu_book_category", true);
        $menuBookName       = $this->input->post("menu_book_name", true);
        $toSlug             = trim(strtolower($menuBookName));
        $out                = explode(" ", $toSlug);
        $slug               = implode("-", $out);
        $menuBookPrice      = $this->input->post("menu_book_price", true);
        $menuBookDesc       = $this->input->post("menu_book_desc", true);
        $status             = $this->input->post("status", true);
        $metaKeyword        = $this->input->post("meta_keyword", true);
        $metaDesc           = $this->input->post("meta_desc", true);

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImage) {
            ## image menu book
            $config['upload_path']          = 'assets/website/images/menu-book';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 500;
            $config['max_height']           = 500;
            $config['min_width']            = 500;
            $config['min_height']           = 500;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("menu_book_image")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadData    = array('upload_data' => $this->upload->data());
                $newImage       = $uploadData['upload_data']['file_name'];
            }

            $menuBook = [
                "menu_book_category_id"     => $menuBookCategory,
                "menu_book_name"            => $menuBookName,
                "menu_book_price"           => $menuBookPrice,
                "menu_book_desc"            => $menuBookDesc,
                "menu_book_image"           => $newImage,
                "menu_book_status"          => $status,
                "menu_book_meta_keyword"    => $metaKeyword,
                "menu_book_meta_desc"       => $metaDesc,
                "slug"                      => $slug,
                "updated_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $menuBook = [
                "menu_book_category_id"     => $menuBookCategory,
                "menu_book_name"            => $menuBookName,
                "menu_book_price"           => $menuBookPrice,
                "menu_book_desc"            => $menuBookDesc,
                "menu_book_status"          => $status,
                "menu_book_meta_keyword"    => $metaKeyword,
                "menu_book_meta_desc"       => $metaDesc,
                "slug"                      => $slug,
                "updated_at"                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $updated = $this->M_Global->update_data("menu_book_id = '$menuId' ", $menuBook, "menu_book");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('menu-book');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('menu-book');
        }
    }

    public function get_menu_book($menuid)
    {
        $getMenuBook    = $this->M_Global->get_list("menu_book", "menu_book_id = '$menuid' ")->row_array();

        echo json_encode($getMenuBook);
    }

    public function remove_menu_book()
    {
        $menuId     = $this->input->post("menu_book_id", true);

        $delete = $this->M_Global->delete("menu_book", "menu_book_id = '$menuId'");

        if ($delete) {
            $this->session->set_flashdata('success', 'Removed successfully');

            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', 'Failed to removed');

            redirect($this->agent->referrer());
        }
    }

    public function menu_book_category()
    {
        $data['title']          = "Milou - CMS Menu Book Category";
        $data['getMenuBook']    = $this->M_Global->get_result("menu_book_category")->result_array();

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/components/navbar', $data);
        $this->load->view('cms/components/sidebar', $data);
        $this->load->view('cms/menu-book-category', $data);
        $this->load->view('cms/components/footer', $data);
        $this->load->view('cms/components/modal', $data);
    }

    public function add_menu_book_category()
    {
        $uploadImageTop     = $_FILES['top_image_category']['name'];
        $uploadImageBottom  = $_FILES['bottom_image_category']['name'];

        $categoryName   = $this->input->post("menu_book_category_name", true);
        $toSlug         = trim(strtolower($categoryName));
        $out            = explode(" ", $toSlug);
        $slug           = implode("-", $out);
        $status         = $this->input->post("status");

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImageTop && $uploadImageBottom) {
            ## top image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 304;
            $config['max_height']           = 465;
            $config['min_width']            = 304;
            $config['min_height']           = 465;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("top_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataTop      = array('upload_data' => $this->upload->data());
                $newImageTop        = $uploadDataTop['upload_data']['file_name'];
            }
            ## end top image menu book category

            ## bottom image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 191;
            $config['max_height']           = 217;
            $config['min_width']            = 191;
            $config['min_height']           = 217;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("bottom_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataBottom   = array('upload_data' => $this->upload->data());
                $newImageBottom     = $uploadDataBottom['upload_data']['file_name'];
            }
            ## end bottom image menu book category

            $data = [
                'menu_book_category_name'   => $categoryName,
                'top_image'                 => $newImageTop,
                'bottom_image'              => $newImageBottom,
                'menu_book_category_slug'   => $slug,
                'status'                    => $status,
                'created_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImageTop) {
            ## top image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 304;
            $config['max_height']           = 465;
            $config['min_width']            = 304;
            $config['min_height']           = 465;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("top_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataTop      = array('upload_data' => $this->upload->data());
                $newImageTop        = $uploadDataTop['upload_data']['file_name'];
            }
            ## end top image menu book category

            $data = [
                'menu_book_category_name'   => $categoryName,
                'top_image'                 => $newImageTop,
                'menu_book_category_slug'   => $slug,
                'status'                    => $status,
                'created_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImageBottom) {
            ## bottom image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 191;
            $config['max_height']           = 217;
            $config['min_width']            = 191;
            $config['min_height']           = 217;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("bottom_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataBottom   = array('upload_data' => $this->upload->data());
                $newImageBottom     = $uploadDataBottom['upload_data']['file_name'];
            }

            $data = [
                'menu_book_category_name'   => $categoryName,
                'bottom_image'              => $newImageBottom,
                'menu_book_category_slug'   => $slug,
                'status'                    => $status,
                'created_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $data = [
                'menu_book_category_name'   => $categoryName,
                'menu_book_category_slug'   => $slug,
                'status'                    => $status,
                'created_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }

        $created = $this->M_Global->insert($data, "menu_book_category");

        if ($created) {
            $this->session->set_flashdata('success', 'Added successfully');

            redirect('menu-book-category');
        } else {
            $this->session->set_flashdata('error', 'Failed to add');

            redirect('menu-book-category');
        }
    }

    public function get_menu_book_category($categoryId)
    {
        $getMenuBookCategory    = $this->M_Global->get_list("menu_book_category", "menu_book_category_id = '$categoryId' ")->row_array();

        echo json_encode($getMenuBookCategory);
    }

    public function edit_menu_book_category()
    {
        $checkMenuBookCategory  = $this->M_Global->getmultiparam("menu_book_category", "for_home = 'True' ")->row_array();
        $catId                  = $checkMenuBookCategory['menu_book_category_id'];

        $uploadImageTop         = $_FILES['top_image_category']['name'];
        $uploadImageBottom      = $_FILES['bottom_image_category']['name'];

        $categoryId     = $this->input->post("menu_book_category_id");
        $categoryName   = $this->input->post("menu_book_category_name");
        $toSlug         = trim(strtolower($categoryName));
        $out            = explode(" ", $toSlug);
        $slug           = implode("-", $out);
        $forHome        = $this->input->post("for_home");
        $status         = $this->input->post("status");



        if ($forHome == "True") {
            $forHome = "True";

            $updateOld = [
                'for_home'                  => "False",
                'updated_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];

            $this->M_Global->update_data("menu_book_category_id = '$catId' ", $updateOld, "menu_book_category");
        } else {
            $forHome = "False";
        }

        if ($status == "Show") {
            $status = "Show";
        } else {
            $status = "Hide";
        }

        if ($uploadImageTop && $uploadImageBottom) {
            ## top image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 304;
            $config['max_height']           = 465;
            $config['min_width']            = 304;
            $config['min_height']           = 465;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("top_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataTop      = array('upload_data' => $this->upload->data());
                $newImageTop        = $uploadDataTop['upload_data']['file_name'];
            }
            ## end top image menu book category

            ## bottom image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 191;
            $config['max_height']           = 217;
            $config['min_width']            = 191;
            $config['min_height']           = 217;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("bottom_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataBottom   = array('upload_data' => $this->upload->data());
                $newImageBottom     = $uploadDataBottom['upload_data']['file_name'];
            }
            ## end bottom image menu book category

            $data = [
                'menu_book_category_name'   => $categoryName,
                'top_image'                 => $newImageTop,
                'bottom_image'              => $newImageBottom,
                'menu_book_category_slug'   => $slug,
                'for_home'                  => $forHome,
                'status'                    => $status,
                'updated_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImageTop) {
            ## top image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 304;
            $config['max_height']           = 465;
            $config['min_width']            = 304;
            $config['min_height']           = 465;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("top_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataTop      = array('upload_data' => $this->upload->data());
                $newImageTop        = $uploadDataTop['upload_data']['file_name'];
            }
            ## end top image menu book category

            $data = [
                'menu_book_category_name'   => $categoryName,
                'top_image'                 => $newImageTop,
                'menu_book_category_slug'   => $slug,
                'for_home'                  => $forHome,
                'status'                    => $status,
                'updated_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } elseif ($uploadImageBottom) {
            ## bottom image menu book category
            $config['upload_path']          = 'assets/website/images/menu-book-category';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max_size']             = 2048;
            $config['max_width']            = 191;
            $config['max_height']           = 217;
            $config['min_width']            = 191;
            $config['min_height']           = 217;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("bottom_image_category")) {
                $error          = $this->upload->display_errors();
                $formatted_text = str_replace(['<p>', '</p>'], '', $error);

                $this->session->set_flashdata('error_upload', $formatted_text);

                redirect($this->agent->referrer());
            } else {
                $uploadDataBottom   = array('upload_data' => $this->upload->data());
                $newImageBottom     = $uploadDataBottom['upload_data']['file_name'];
            }
            ## end bottom image menu book category

            $data = [
                'menu_book_category_name'   => $categoryName,
                'bottom_image'              => $newImageBottom,
                'menu_book_category_slug'   => $slug,
                'for_home'                  => $forHome,
                'status'                    => $status,
                'updated_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        } else {
            $data = [
                'menu_book_category_name'   => $categoryName,
                'menu_book_category_slug'   => $slug,
                'for_home'                  => $forHome,
                'status'                    => $status,
                'updated_at'                => date('Y-m-d H:i:s', strtotime('now'))
            ];
        }
        $updated = $this->M_Global->update_data("menu_book_category_id = '$categoryId' ", $data, "menu_book_category");

        if ($updated) {
            $this->session->set_flashdata('success', 'Updated successfully');

            redirect('menu-book-category');
        } else {
            $this->session->set_flashdata('error', 'Failed to updated');

            redirect('menu-book-category');
        }
    }
    ## end menu book
}
