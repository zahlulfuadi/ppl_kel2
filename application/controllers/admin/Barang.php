<?php
class Barang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_pengguna');
		$this->load->helper('date');
		// $this->load->library('barcode');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');

			$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['data'] = $this->m_barang->tampil_barang();
			$data['kat'] = $this->m_kategori->tampil_kategori();
			$data['kat2'] = $this->m_kategori->tampil_kategori();
			$data['judul'] = "Data Barang";
			$this->load->view('admin/v_barang', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_barang()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_barang = "";
			$nabar = $this->input->post('nabar');
			$kat = $this->input->post('kategori');
			$satuan = $this->input->post('satuan');
			$harpok = str_replace(',', '', $this->input->post('harpok'));
			$harjul = str_replace(',', '', $this->input->post('harjul'));
			// $harjul_grosir = str_replace(',', '', $this->input->post('harjul_grosir'));
			$stok = $this->input->post('stok');

			date_default_timezone_set('Asia/Jakarta');
			$tgl_input = date('d-m-Y H:i:s');
			// $min_stok = $this->input->post('min_stok');
			$this->m_barang->simpan_barang($id_barang, $nabar, $kat, $satuan, $harpok, $harjul, $stok, $tgl_input);

			redirect('admin/barang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_barang()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_barang = $this->input->post('id_barang');
			$nabar = $this->input->post('nabar');
			$kat = $this->input->post('kategori');
			$satuan = $this->input->post('satuan');
			$harpok = str_replace(',', '', $this->input->post('harpok'));
			$harjul = str_replace(',', '', $this->input->post('harjul'));
			$stok = $this->input->post('stok');

			date_default_timezone_set('Asia/Jakarta');
			$tgl_update = date('d-m-Y H:i:s');
			$this->m_barang->update_barang($id_barang, $nabar, $kat, $satuan, $harpok, $harjul, $stok, $tgl_update);
			redirect('admin/barang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_barang()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_barang = $this->input->post('id_barang');
			$this->m_barang->hapus_barang($id_barang);
			redirect('admin/barang');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
