<?php
class Kategori extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_kategori');
		$this->load->model('m_pengguna');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');

			$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['data'] = $this->m_kategori->tampil_kategori();
			$data['judul'] = "Data Kategori";
			$this->load->view('admin/v_kategori', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_kategori()
	{
		if ($this->session->userdata('masuk') == true) {
			$kat = $this->input->post('kategori');
			$desk = $this->input->post('deskripsi');
			$this->m_kategori->simpan_kategori($kat, $desk);
			redirect('admin/kategori');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_kategori()
	{
		if ($this->session->userdata('masuk') == true) {
			$kode = $this->input->post('kode');
			$kat = $this->input->post('kategori');
			$desk = $this->input->post('deskripsi');
			$this->m_kategori->update_kategori($kode, $kat, $desk);
			redirect('admin/kategori');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_kategori()
	{
		if ($this->session->userdata('masuk') == true) {
			$kode = $this->input->post('kode');
			$this->m_kategori->hapus_kategori($kode);
			redirect('admin/kategori');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
