<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			

	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$data['konten']="v_dashboard_user";
			$this->load->view('template_user',$data);
		} else {
			redirect('login');
		}
	}

}

/* End of file Dashboard_user.php */
/* Location: ./application/controllers/Dashboard_user.php */