<?php
class M_grafik extends CI_Model
{
    function statistik_stok()
    {
        $query = $this->db->query("SELECT k.nama_kategori, SUM(b.stok) AS tot_stok FROM barang b, kategori k WHERE b.id_kategori=k.id_kategori GROUP BY k.nama_kategori");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function graf_penjualan_perbulan($bulan)
    {
        $query = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d') AS tanggal,SUM(jual_total) total FROM pemasukan WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' GROUP BY DAY(jual_tanggal)");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function graf_penjualan_pertahun($tahun)
    {
        $query = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%M') AS bulan,SUM(jual_total) total FROM pemasukan WHERE YEAR(jual_tanggal)='$tahun' GROUP BY MONTH(jual_tanggal)");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}
