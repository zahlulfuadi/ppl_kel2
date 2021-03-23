<?php
class M_supplier extends CI_Model
{

	function hapus_supplier($kode)
	{
		$hsl = $this->db->query("DELETE FROM supplier where id_supplier='$kode'");
		return $hsl;
	}

	function update_supplier($kode, $nama, $alamat, $notelp)
	{
		$hsl = $this->db->query("UPDATE supplier set nama_supplier='$nama',alamat='$alamat',no_telp='$notelp' where id_supplier='$kode'");
		return $hsl;
	}

	function tampil_supplier()
	{
		$hsl = $this->db->query("select * from supplier order by id_supplier desc");
		return $hsl;
	}

	function simpan_supplier($nama, $alamat, $notelp)
	{
		$hsl = $this->db->query("INSERT INTO supplier(nama_supplier,alamat,no_telp) VALUES ('$nama','$alamat','$notelp')");
		return $hsl;
	}
}
