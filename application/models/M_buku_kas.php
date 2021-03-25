<?php
class M_buku_kas extends CI_Model
{

	// function hapus_barang($kode)
	// {
	// 	$hsl = $this->db->query("DELETE FROM barang where id_barang='$kode'");
	// 	return $hsl;
	// }

	// function update_barang($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
	// {
	// 	$user_id = $this->session->userdata('idadmin');
	// 	$hsl = $this->db->query("UPDATE barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_harjul_grosir='$harjul_grosir',barang_stok='$stok',barang_min_stok='$min_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat',barang_user_id='$user_id' WHERE id_barang='$kobar'");
	// 	return $hsl;
	// }

	function tampil_buku_kas()
	{
		// $hsl = $this->db->query("SELECT b.id_barang, b.nama_barang, b.satuan_barang, b.harga_pokok, b.harga_jual, b.stok, b.tanggal_input, b.tanggal_update, k.id_kategori, k.nama_kategori FROM barang b, kategori k WHERE b.id_kategori=k.id_kategori");
		$hsl = $this->db->query("SELECT bk.id_buku_kas, bk.id_user, bk.nama, bk.tanggal, bk.pemasukan, bk.pengeluaran, bk.saldo, bk.keterangan FROM buku_kas bk WHERE 1");
		return $hsl;
	}

	// function simpan_barang($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
	// {
	// 	$user_id = $this->session->userdata('idadmin');
	// 	$hsl = $this->db->query("INSERT INTO barang (id_barang, nama_barang, satuan_barang, harga_pokok, harga_jual, stok, tanggal_input, tanggal_update,id_kategori) VALUES ('$kobar','$nabar','$satuan','$harpok','$harjul','$harjul_grosir','$stok','$min_stok','$kat','$user_id')");
	// 	return $hsl;
	// }


	// function get_barang($kobar)
	// {
	// 	$hsl = $this->db->query("SELECT * FROM barang where id_barang='$kobar'");
	// 	return $hsl;
	// }

	// function get_kobar()
	// {
	// 	$q = $this->db->query("SELECT MAX(RIGHT(id_barang,6)) AS kd_max FROM barang");
	// 	$kd = "";
	// 	if ($q->num_rows() > 0) {
	// 		foreach ($q->result() as $k) {
	// 			$tmp = ((int)$k->kd_max) + 1;
	// 			$kd = sprintf("%06s", $tmp);
	// 		}
	// 	} else {
	// 		$kd = "000001";
	// 	}
	// 	return "BR" . $kd;
	// }
}
