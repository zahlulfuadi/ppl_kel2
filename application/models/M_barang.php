<?php
class M_barang extends CI_Model
{

	function hapus_barang($kode)
	{
		$hsl = $this->db->query("DELETE FROM barang where id_barang='$kode'");
		return $hsl;
	}

	function update_barang($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
	{
		$user_id = $this->session->userdata('idadmin');
		$hsl = $this->db->query("UPDATE barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_harjul_grosir='$harjul_grosir',barang_stok='$stok',barang_min_stok='$min_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat',barang_user_id='$user_id' WHERE id_barang='$kobar'");
		return $hsl;
	}

	function tampil_barang()
	{
		$hsl = $this->db->query("SELECT id_barang, nama_barang, satuan_barang, harga_pokok, harga_jual, stok, tanggal_input, tanggal_update,id_kategori FROM barang JOIN kategori ON id_kategori=id_kategori");
		return $hsl;
	}

	function simpan_barang($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
	{
		$user_id = $this->session->userdata('idadmin');
		$hsl = $this->db->query("INSERT INTO barang (id_barang, nama_barang, satuan_barang, harga_pokok, harga_jual, stok, tanggal_input, tanggal_update,id_kategori) VALUES ('$kobar','$nabar','$satuan','$harpok','$harjul','$harjul_grosir','$stok','$min_stok','$kat','$user_id')");
		return $hsl;
	}


	function get_barang($kobar)
	{
		$hsl = $this->db->query("SELECT * FROM barang where id_barang='$kobar'");
		return $hsl;
	}

	function get_kobar()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(id_barang,6)) AS kd_max FROM barang");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return "BR" . $kd;
	}
}
