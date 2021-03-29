<?php
class Laporan extends CI_Controller
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
		$this->load->model('m_supplier');
		$this->load->model('m_pengeluaran');
		$this->load->model('m_pemasukan');
		$this->load->model('m_laporan');
		$this->load->model('m_pengguna');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');

			$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['data'] = $this->m_barang->tampil_barang();
			$data['kat'] = $this->m_kategori->tampil_kategori();
			$data['jual_bln'] = $this->m_laporan->get_bulan_jual();
			$data['jual_thn'] = $this->m_laporan->get_tahun_jual();
			$data['judul'] = "Laporan";
			$this->load->view('admin/v_laporan', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function lap_stok_barang()
	{
		$id_user = $this->session->userdata('idadmin');

		$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
		$data['data'] = $this->m_laporan->get_stok_barang();
		$data['judul'] = "Laporan Stok Barang";
		$this->load->view('admin/laporan/v_lap_stok_barang', $data);
	}
	function lap_data_barang()
	{
		$id_user = $this->session->userdata('idadmin');

		$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
		$data['data'] = $this->m_laporan->get_data_barang();
		$data['judul'] = "Laporan Data Barang";
		$this->load->view('admin/laporan/v_lap_barang', $data);
	}
	function lap_data_penjualan()
	{
		$x['data'] = $this->m_laporan->get_data_penjualan();
		$x['jml'] = $this->m_laporan->get_total_penjualan();
		$x['judul'] = "Laporan Data Penjualan";
		$this->load->view('admin/laporan/v_lap_penjualan', $x);
	}
	function lap_penjualan_pertanggal()
	{
		$tanggal = $this->input->post('tgl');
		$x['jml'] = $this->m_laporan->get_data__total_jual_pertanggal($tanggal);
		$x['data'] = $this->m_laporan->get_data_jual_pertanggal($tanggal);
		$x['judul'] = "Laporan Penjualan Per Tanggal";
		$this->load->view('admin/laporan/v_lap_jual_pertanggal', $x);
	}
	function lap_penjualan_perbulan()
	{
		$bulan = $this->input->post('bln');
		$x['jml'] = $this->m_laporan->get_total_jual_perbulan($bulan);
		$x['data'] = $this->m_laporan->get_jual_perbulan($bulan);
		$x['judul'] = "Laporan Penjualan Per Bulan";
		$this->load->view('admin/laporan/v_lap_jual_perbulan', $x);
	}
	function lap_penjualan_pertahun()
	{
		$tahun = $this->input->post('thn');
		$x['jml'] = $this->m_laporan->get_total_jual_pertahun($tahun);
		$x['data'] = $this->m_laporan->get_jual_pertahun($tahun);
		$x['judul'] = "Laporan Penjualan Per Tahun";
		$this->load->view('admin/laporan/v_lap_jual_pertahun', $x);
	}
	function lap_laba_rugi()
	{
		$bulan = $this->input->post('bln');
		$x['jml'] = $this->m_laporan->get_total_lap_laba_rugi($bulan);
		$x['data'] = $this->m_laporan->get_lap_laba_rugi($bulan);
		$x['judul'] = "Laporan Laba Rugi";
		$this->load->view('admin/laporan/v_lap_laba_rugi', $x);
	}
}
