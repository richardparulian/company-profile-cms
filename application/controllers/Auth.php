<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Milou - CMS Authentication";

        $this->load->view('cms/components/header', $data);
        $this->load->view('cms/authentication', $data);
        $this->load->view('cms/components/footer', $data);
    }

    public function login()
    {
        $data           = $this->M_Auth->input_values();
        $user           = $this->M_Auth->getUserByUsername($data['username']);
        $password       = $data['password'];

        if (!empty($user)) {
            //check password
            if ($password == $user['password']) {
                //set user data
                $user_data = array(
                    'r_sess_user_id'            => $user['user_id'],
                    'r_sess_user_first_name'    => $user['first_name'],
                    'r_sess_user_last_name'     => $user['last_name'],
                    'r_sess_user_username'      => $user['username'],
                    'r_sess_user_email'         => $user['email'],
                    'r_sess_user_role'          => $user['role'],
                    'r_sess_logged_in'          => true
                );
                $this->session->set_userdata($user_data);

                if ($this->session->userdata('r_sess_user_role') == 'administrator') {

                    redirect(base_url('home-admin'));
                } else {
                    redirect(base_url('admin-milou'));
                }
            } else {
                $this->session->set_flashdata('form_data', $this->M_Auth->input_values());
                $this->session->set_flashdata(
                    'error',
                    '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    Wrong Password!
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );

                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('form_data', $this->M_Auth->input_values());
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                Username Invalid!
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect($this->agent->referrer());
        }
    }

    public function logout()
    {
        $this->M_Auth->logout();
        redirect(base_url('admin-milou'));
    }
}
