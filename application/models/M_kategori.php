<?php
class M_kategori extends CI_Model
{

	function hapus_kategori($kode)
	{
		$hsl = $this->db->query("DELETE FROM kategori where id_kategori='$kode'");
		return $hsl;
	}

	function update_kategori($kode, $kat)
	{
		$hsl = $this->db->query("UPDATE kategori set kategori_nama='$kat' where id_kategori='$kode'");
		return $hsl;
	}

	function tampil_kategori()
	{
		$hsl = $this->db->query("select * from kategori order by id_kategori desc");
		return $hsl;
	}

	function simpan_kategori($kat)
	{
		$hsl = $this->db->query("INSERT INTO kategori(kategori_nama) VALUES ('$kat')");
		return $hsl;
	}
}
