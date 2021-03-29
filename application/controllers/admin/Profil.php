<?php
class Profil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_pengguna');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');
			$data['data'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['judul'] = "Profil";
			$this->load->view('admin/v_profil', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function profil()
	{
	}
}
