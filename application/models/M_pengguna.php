<?php
class M_pengguna extends CI_Model
{
	function get_pengguna()
	{
		$hsl = $this->db->query("SELECT * FROM user");
		return $hsl;
	}
	function get_pengguna_by_id($id)
	{
		$hsl = $this->db->query("SELECT * FROM user WHERE id_user='$id'");
		return $hsl;
	}
	function simpan_pengguna($nama, $username, $password, $level)
	{
		$hsl = $this->db->query("INSERT INTO user(id_user,nama,username,password,foto_profil,user_level,user_status) VALUES ('','$nama','$username',md5('$password'),'','$level','1')");
		return $hsl;
	}
	function update_pengguna_nopass($kode, $nama, $username, $level)
	{
		$hsl = $this->db->query("UPDATE user SET nama='$nama',username='$username',user_level='$level' WHERE id_user='$kode'");
		return $hsl;
	}
	function update_pengguna($kode, $nama, $username, $password, $level)
	{
		$hsl = $this->db->query("UPDATE user SET nama='$nama',username='$username',password=md5('$password'),user_level='$level' WHERE id_user='$kode'");
		return $hsl;
	}
	function nonaktifkan($kode)
	{
		$hsl = $this->db->query("UPDATE user SET user_status='0' WHERE id_user='$kode'");
		return $hsl;
	}
	function aktifkan($kode)
	{
		$hsl = $this->db->query("UPDATE user SET user_status='1' WHERE id_user='$kode'");
		return $hsl;
	}
}
