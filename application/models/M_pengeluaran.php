<?php
class M_pengeluaran extends CI_Model
{

	function simpan_pengeluaran($id_pengeluaran, $tgl, $total, $id_supplier, $keterangan, $saldo)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO pengeluaran (id_pengeluaran, tanggal_pengeluaran, nominal, id_supplier, id_user, ket_pengeluaran) VALUES ('$id_pengeluaran','$tgl',$total,$id_supplier,$idadmin,'$keterangan')");
		$id_pengeluaran = $this->db->insert_id();
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'id_detail_pengeluaran'	=>	"",
				'id_barang'			=>	$item['id'],
				'harga'				=>	$item['price'],
				'jml_pengeluaran'	=>	$item['qty'],
				'total_pengeluaran'	=>	$item['price'] * $item['qty'],
				'id_pengeluaran'	=>	$id_pengeluaran
			);
			$this->db->insert('detail_pengeluaran', $data);
			$this->db->query("update barang set stok=stok+'$item[qty]',harga_pokok='$item[price]',harga_jual='$item[harga]' where id_barang='$item[id]'");
		}
		$saldo -= $total;
		$this->db->query("INSERT INTO buku_kas (id_buku_kas, id_user, tanggal, id_pemasukan, id_pengeluaran, saldo) VALUES ('','$idadmin','$tgl','','$id_pengeluaran',$saldo)");
		return true;
	}

	function get_user_id($id_pengeluaran)
	{
		$hasil = $this->db->query("SELECT id_user FROM pengeluaran WHERE id_pengeluaran='$id_pengeluaran'");
		return $hasil;
	}

	function get_kobel()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(beli_kode,6)) AS kd_max FROM pengeluaran WHERE DATE(beli_tanggal)=CURDATE()");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return "BL" . date('dmy') . $kd;
	}
}
