<?php
class Supplier extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_supplier');
		$this->load->model('m_pengguna');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');

			$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['data'] = $this->m_supplier->tampil_supplier();
			$data['judul'] = "Data Supplier";
			$this->load->view('admin/v_supplier', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_supplier()
	{
		if ($this->session->userdata('masuk') == true) {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$notelp = $this->input->post('notelp');
			$this->m_supplier->simpan_supplier($nama, $alamat, $notelp);
			redirect('admin/supplier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_supplier()
	{
		if ($this->session->userdata('masuk') == true) {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$notelp = $this->input->post('notelp');
			$this->m_supplier->update_supplier($kode, $nama, $alamat, $notelp);
			redirect('admin/supplier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_supplier()
	{
		if ($this->session->userdata('masuk') == true) {
			$kode = $this->input->post('kode');
			$this->m_supplier->hapus_supplier($kode);
			redirect('admin/supplier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
