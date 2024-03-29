<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function cek_user()
    {
        $u = $this->input->post('username');
        $p = $this->input->post('password');
        
        $query = $this->db->join('level', 'level.id_level = admin.id_level')
                          ->where('username', $u)
                          ->where('password', $p)
                          ->get('admin');
        if ($this->db->affected_rows() > 0) {
            $data_login = $query->row();
            $data_session = array(
                                    'id_admin' => $data_login->id_admin,
                                    'username' => $data_login->username,
                                    'password' => $data_login->password,
                                    'logged_in' => TRUE,
                                    'id_level'     => $data_login->id_level
                                 );
            $this->session->set_userdata($data_session);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

/* End of file Login_model.php */

