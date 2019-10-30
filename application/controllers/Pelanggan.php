<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelanggan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')!=true){
			redirect(base_url('index.php/logged_in'),'refresh');
		}
	}

	public function index()
	{
		$data['konten']="v_pelanggan";
		$this->load->model('m_pelanggan','pelanggan');
		$data['data_pelanggan']=$this->pelanggan->get_pelanggan();
		$this->load->model('m_tarif','tarif');
		$data['data_tarif']=$this->tarif->get_tarif();
		$this->load->view('template', $data, FALSE);
	}
	public function simpan_pelanggan()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'Nama pelanggan', 'trim|required',
		array('required' => 'nama pelanggan harus diisi'));
		$this->form_validation->set_rules('username', 'Username', 'trim|required',
		array('required' => 'Username harus diisi'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required',
		array('required' => 'Password harus diisi'));
		$this->form_validation->set_rules('id_tarif', 'Nama tarif', 'trim|required',
		array('required' => 'Nama tarif harus diisi'));
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required',
		array('required' => 'Alamat harus diisi'));
		$this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'trim|required',
		array('required' => 'Nomor KWH harus diisi'));


		if ($this->form_validation->run() == TRUE) {
			$this->load->model('m_pelanggan','pelanggan');
			$masuk=$this->pelanggan->masuk_db();
			if($masuk==true){
				$this->session->set_flashdata('pesan', 'sukses masuk');
			} else {
				//$this->session->set_flashdata('pesan', 'gagal masuk');
			}
			redirect(base_url('index.php/pelanggan'),'refresh');
		} else {
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/pelanggan'),'refresh');

		}
	}
	public function get_detail_pelanggan($id_pelanggan='')
	{
		$this->load->model('m_pelanggan');
		$data_detail=$this->m_pelanggan->detail_pelanggan($id_pelanggan);
		echo json_encode($data_detail);
	}
	public function update_pelanggan()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'nama pelanggan', 'trim|required',array("required"=>"Nama lvel harus diisi"));
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/pelanggan'),'refresh');
		} else {
			$this->load->model('m_pelanggan');
			$proses_update=$this->m_pelanggan->update_pelanggan();
			if($proses_update){
				$this->session->set_flashdata('pesan', 'sukses update');
			} else {
				$this->session->set_flashdata('pesan', 'gagal update');
			}
			redirect(base_url('index.php/pelanggan'),'refresh');
		}
	}
	public function hapus_pelanggan($id_pelanggan='')
	{
		$this->load->model('m_pelanggan','pelanggan');
		$hapus=$this->pelanggan->hapus_pelanggan($id_pelanggan);
		if($hapus){
			$this->session->set_flashdata('pesan', 'sukses hapus data');
			} else {
				$this->session->set_flashdata('pesan', 'gagal hapus data');
			}
			redirect(base_url('index.php/pelanggan'),'refresh');
	}

}

/* End of file pelanggan.php */
/* Location: ./application/controllers/pelanggan.php */