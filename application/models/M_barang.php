<?php
class M_barang extends CI_Model
{

	function hapus_barang($id_barang)
	{
		$hsl = $this->db->query("DELETE FROM barang where id_barang='$id_barang'");
		return $hsl;
	}

	function update_barang($id_barang, $nabar, $kat, $satuan, $harpok, $harjul, $stok, $tgl_update)
	{
		// $user_id = $this->session->userdata('idadmin');
		$hsl = $this->db->query("UPDATE barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_stok='$stok',tanggal_update=$tgl_update,id_kategori='$kat' WHERE id_barang='$id_barang'");
		return $hsl;
	}

	function tampil_barang()
	{
		$hsl = $this->db->query("SELECT b.id_barang, b.nama_barang, b.satuan_barang, b.harga_pokok, b.harga_jual, b.stok, b.tanggal_input, b.tanggal_update, k.id_kategori, k.nama_kategori FROM barang b, kategori k WHERE b.id_kategori=k.id_kategori");
		return $hsl;
	}

	function simpan_barang($id_barang, $nabar, $kat, $satuan, $harpok, $harjul, $stok, $tgl_input)
	{
		// $user_id = $this->session->userdata('idadmin');
		$hsl = $this->db->query("INSERT INTO barang (id_barang, nama_barang, satuan_barang, harga_pokok, harga_jual, stok, tanggal_input, tanggal_update,id_kategori) VALUES ('$id_barang','$nabar','$satuan','$harpok','$harjul','$stok','$tgl_input','$tgl_input','$kat')");
		return $hsl;
	}


	function get_barang($id_barang)
	{
		$hsl = $this->db->query("SELECT * FROM barang where id_barang='$id_barang'");
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
