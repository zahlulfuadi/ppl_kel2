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
	}

	function index()
	{
		$data['judul'] = "Dashboard";
		$this->load->view('admin/v_index2', $data);
	}
}
