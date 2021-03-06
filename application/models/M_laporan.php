<?php
class M_laporan extends CI_Model
{
	function get_stok_barang()
	{
		$hsl = $this->db->query("SELECT k.id_kategori,k.nama_kategori,b.nama_barang,b.stok FROM kategori k, barang b WHERE k.id_kategori=b.id_kategori GROUP BY k.id_kategori,b.nama_barang");
		return $hsl;
	}
	function get_data_barang()
	{
		$hsl = $this->db->query("SELECT k.id_kategori,b.id_barang,k.nama_kategori,b.nama_barang,b.satuan_barang,b.harga_jual,b.stok FROM kategori k, barang b WHERE k.id_kategori=b.id_kategori GROUP BY k.id_kategori,b.nama_barang");
		return $hsl;
	}
	function get_data_penjualan()
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_penjualan()
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_data_jual_pertanggal($tanggal)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tanggal_pemasukan)='$tanggal' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_data__total_jual_pertanggal($tanggal)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tanggal_pemasukan)='$tanggal' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_bulan_jual()
	{
		$hsl = $this->db->query("SELECT DISTINCT DATE_FORMAT(tanggal_pemasukan,'%M %Y') AS bulan FROM pemasukan");
		return $hsl;
	}
	function get_tahun_jual()
	{
		$hsl = $this->db->query("SELECT DISTINCT YEAR(tanggal_pemasukan) AS tahun FROM pemasukan");
		return $hsl;
	}
	function get_jual_perbulan($bulan)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%M %Y') AS bulan,DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(tanggal_pemasukan,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_jual_perbulan($bulan)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%M %Y') AS bulan,DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(tanggal_pemasukan,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_jual_pertahun($tahun)
	{
		$hsl = $this->db->query("SELECT YEAR(tanggal_pemasukan) AS tahun,DATE_FORMAT(tanggal_pemasukan,'%M %Y') AS bulan,DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE YEAR(tanggal_pemasukan)='$tahun' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_jual_pertahun($tahun)
	{
		$hsl = $this->db->query("SELECT YEAR(tanggal_pemasukan) AS tahun,DATE_FORMAT(tanggal_pemasukan,'%M %Y') AS bulan,DATE_FORMAT(tanggal_pemasukan,'%d %M %Y') AS tanggal_pemasukan,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE YEAR(tanggal_pemasukan)='$tahun' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	//=========Laporan Laba rugi============
	function get_lap_laba_rugi($bulan)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%d %M %Y %H:%i:%s') as tanggal_pemasukan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon) AS untung_bersih FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(tanggal_pemasukan,'%M %Y')='$bulan'");
		return $hsl;
	}
	function get_total_lap_laba_rugi($bulan)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(tanggal_pemasukan,'%M %Y') AS bulan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM(((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon)) AS total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(tanggal_pemasukan,'%M %Y')='$bulan'");
		return $hsl;
	}
}
