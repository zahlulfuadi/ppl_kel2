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
		$hsl = $this->db->query("INSERT INTO user(nama_user,username,password,user_level,user_status) VALUES ('$nama','$username',md5('$password'),'$level','1')");
		return $hsl;
	}
	function update_pengguna_nopass($kode, $nama, $username, $level)
	{
		$hsl = $this->db->query("UPDATE user SET nama_user='$nama',username='$username',user_level='$level' WHERE id_user='$kode'");
		return $hsl;
	}
	function update_pengguna($kode, $nama, $username, $password, $level)
	{
		$hsl = $this->db->query("UPDATE user SET nama_user='$nama',username='$username',password=md5('$password'),user_level='$level' WHERE id_user='$kode'");
		return $hsl;
	}
	function update_status($kode)
	{
		$hsl = $this->db->query("UPDATE user SET user_status='0' WHERE id_user='$kode'");
		return $hsl;
	}
}
