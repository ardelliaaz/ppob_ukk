<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {
    
	public function __construct()
	{
        parent::__construct();
		$this->load->model('m_login_user');
    }
    

	public function index()
	{
        if ($this->session->userdata('logged_in')==true)
        {
            redirect('dashboard_user/index');
        }else{
            $this->load->view('v_login_user.php');
        }
    }
    
    public function cek_login()
    {
        if ($this->session->userdata('logged_in')==false) {
            
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');

            if ($this->form_validation->run()== true) {
                if ($this->m_login_user->cek_user()== true) {
                    redirect('dashboard_user/index');
                } else {
                  $this->session->flashdata('notif', 'Login gagal');
                  redirect('login_user/index');
                }
                
            } else {
               $this->session->set_flashdata('notif', validation_errors());
               redirect('login_user/index');
            }
            
        } else {
           redirect('dashboard_user/index');
        } 
    }
    public function logout()
    {  
        $this->session->sess_destroy();
        redirect('login_user');   
    }

}
