<?php
class Mlogin extends CI_Model
{
    function cekadmin($u, $p)
    {
        // $hasil = $this->db->query("select*from user where username='$u'and password=md5('$p')");
        $hasil = $this->db->query("select*from user where username='$u'and password=md5('$p')");
        return $hasil;
    }
}
