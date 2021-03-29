<?php
class M_pemasukan extends CI_Model
{

	function hapus_retur($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur()
	{
		$hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar, $nabar, $satuan, $harjul, $qty, $keterangan)
	{
		$hsl = $this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}

	function simpan_pemasukan($id_pemasukan, $tgl, $total, $ket_pemasukan)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO pemasukan (id_pemasukan, tanggal_pemasukan, nominal, ket_pemasukan, id_user) VALUES ('$id_pemasukan','$tgl','$total','$ket_pemasukan','$idadmin')");
		$id_pemasukan = $this->db->insert_id();
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'id_detail_pemasukan' 	=>	"",
				'id_barang'				=>	$item['id'],
				'harga_jual'			=>	$item['amount'],
				'jml_barang'			=>	$item['qty'],
				'diskon'				=>	$item['disc'],
				'total_pemasukan'		=>	$item['subtotal'],
				'id_pemasukan'			=>	$id_pemasukan
			);
			$this->db->insert('detail_pemasukan', $data);
			$this->db->query("update barang set stok=stok-'$item[qty]' where id_barang='$item[id]'");
		}
		return true;
	}
	function get_nofak()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM pemasukan WHERE DATE(jual_tanggal)=CURDATE()");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return date('dmy') . $kd;
	}

	//=====================Penjualan grosir================================
	function simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO pemasukan (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	function cetak_faktur()
	{
		$nofak = $this->session->userdata('nofak');
		$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM pemasukan JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
		return $hsl;
	}
}
