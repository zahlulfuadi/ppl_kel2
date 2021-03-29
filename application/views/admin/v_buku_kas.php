<?php
$this->load->view('layout/header');
?>

<!-- Page Heading -->
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a></div>
        </h1>
    </div>
</div> -->
<!-- /.row -->
<!-- Projects Row -->
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
            <thead>
                <tr>
                    <th style="text-align:center;width:40px;">No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Saldo</th>
                    <!-- <th style="width:100px;text-align:center;">Aksi</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                // var_dump($data->result_array());
                foreach ($data->result_array() as $a) :
                    $no++;
                    $pemasukan = $a['pemasukan'];
                    $pengeluaran = $a['pengeluaran'];
                    $tgl = $a['tanggal'];
                    if ($pengeluaran == 0) {
                        $ket = $a['ket_pemasukan'];
                    } else if ($pemasukan == 0) {
                        $ket = $a['ket_pengeluaran'];
                    }
                    $saldo = $a['saldo'];
                    // $harjul_grosir = $a['harga_jual_grosir'];
                    // $stok = $a['stok'];
                    // $min_stok = $a['barang_min_stok'];
                    // $kat_id = $a['id_kategori'];
                    // $kat_nama = $a['nama_kategori'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td><?php echo $tgl; ?></td>
                        <td><?php echo $ket; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($pemasukan); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($pengeluaran); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($saldo); ?></td>
                        <!-- <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
                        </td>
                    </tr> -->
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->

<?php
$this->load->view('layout/script');
?>

<script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mydata').DataTable();
    });
</script>
<script type="text/javascript">
    $(function() {
        $('.pengeluaran').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.pemasukan').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.saldo').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
    });
</script>

<?php
$this->load->view('layout/footer');
?>