<?php
class M_pengeluaran extends CI_Model
{

	function simpan_pengeluaran($id_pengeluaran, $tgl, $supplier, $keterangan)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO pengeluaran (id_pengeluaran, tanggal_pengeluaran, id_supplier, id_user, ket_pengeluaran) VALUES ('$id_pengeluaran','$tgl','$supplier','$idadmin','$keterangan')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_id_pengeluaran'	=>	$id_pengeluaran,
				'd_beli_barang_id'	=>	$item['id'],
				'd_beli_harga'		=>	$item['price'],
				'd_beli_jumlah'		=>	$item['qty'],
				'd_beli_total'		=>	$item['subtotal'],
				'd_keterangan'		=>	$keterangan
			);
			$this->db->insert('detail_pengeluaran', $data);
			$this->db->query("update barang set stok=stok+'$item[qty]',harga_pokok='$item[price]',harga_jual='$item[harga]' where id_barang='$item[id]'");
		}
		return true;
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
