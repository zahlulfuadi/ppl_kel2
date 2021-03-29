<?php
class Welcome extends CI_Controller
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
		$id_user = $this->session->userdata('idadmin');

		$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
		$data['judul'] = "Laman Utama";
		$this->load->view('admin/v_index2', $data);
	}
}
