<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    // input values
    public function input_values()
    {
        $data = array(
            'username'          => $this->input->post('username', true),
            'email'             => $this->input->post('email', true),
            'first_name'        => $this->input->post('first_name', true),
            'last_name'         => $this->input->post('last_name', true),
            'password'          => $this->input->post('password', true)
        );
        return $data;
    }

    //get user by username
    public function getUserByUsername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->row_array();
    }

    public function is_logged_in()
    {
        //check if user logged in
        if ($this->session->userdata('r_sess_logged_in') == true && $this->session->userdata('r_sess_user_role') == "administrator") {
            $user = $this->get_user($this->session->userdata('r_sess_user_id'));
            if (!empty($user)) {
                if ($user->banned == "registered") {
                    return true;
                }
            }
        }
        return false;
    }

    //get user by id
    public function get_user($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('user');
        return $query->row();
    }

    //logout
    public function logout()
    {
        //unset user data
        $this->session->unset_userdata('r_sess_user_id');
        $this->session->unset_userdata('r_sess_user_email');
        $this->session->unset_userdata('r_sess_user_role');
        $this->session->unset_userdata('r_sess_logged_in');
        $this->session->unset_userdata('r_sess_app_key');
    }
}
