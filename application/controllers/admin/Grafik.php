<?php
class Grafik extends CI_Controller
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
		$this->load->model('m_grafik');
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
			$data['judul'] = "Grafik";
			$this->load->view('admin/v_grafik', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function graf_stok_barang()
	{
		$id_user = $this->session->userdata('idadmin');

		$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
		$data['report'] = $this->m_grafik->statistik_stok();
		$data['judul'] = "Grafik Stok Barang";
		$this->load->view('admin/grafik/v_graf_stok_barang', $data);
	}


	function graf_penjualan_perbulan()
	{
		$bulan = $this->input->post('bln');
		$x['report'] = $this->m_grafik->graf_penjualan_perbulan($bulan);
		$x['bln'] = $bulan;
		$x['judul'] = "Grafik Penjualan Per Bulan";
		$this->load->view('admin/grafik/v_graf_penjualan_perbulan', $x);
	}
	function graf_penjualan_pertahun()
	{
		$tahun = $this->input->post('thn');
		$x['report'] = $this->m_grafik->graf_penjualan_pertahun($tahun);
		$x['thn'] = $tahun;
		$x['judul'] = "Grafik Penjualan Per Tahun";
		$this->load->view('admin/grafik/v_graf_penjualan_pertahun', $x);
	}
}
