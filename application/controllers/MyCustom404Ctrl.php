<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class MyCustom404Ctrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$this->output->set_status_header('404');

        // Make sure you actually have some view file named 404.php
        //$this->load->view('404');
        if ($this->session->userdata("role") == "administrator") {
            redirect("home-admin");
        } else {
            redirect(base_url());
        }
    }
}
