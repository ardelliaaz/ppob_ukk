<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('level_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){

			$data['main_view'] = 'level_view';
			// $data['level'] = $this->pengguna_model->get_pengguna();
			$data['level'] = $this->level_model->get_level();
			$this->load->view('template', $data);

		} else {
			redirect('login/index');
		}
	}