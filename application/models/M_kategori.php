<?php
class M_kategori extends CI_Model
{

	function hapus_kategori($kode)
	{
		$hsl = $this->db->query("DELETE FROM kategori where id_kategori='$kode'");
		return $hsl;
	}

	function update_kategori($kode, $kat, $desk)
	{
		$hsl = $this->db->query("UPDATE kategori set nama_kategori='$kat', deskripsi='$desk' where id_kategori='$kode'");
		return $hsl;
	}

	function tampil_kategori()
	{
		$hsl = $this->db->query("select * from kategori order by id_kategori desc");
		return $hsl;
	}

	function simpan_kategori($kat, $desk)
	{
		$hsl = $this->db->query("INSERT INTO kategori(nama_kategori, deskripsi) VALUES ('$kat', '$desk')");
		return $hsl;
	}
}
