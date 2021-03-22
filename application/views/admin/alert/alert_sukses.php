<?php
$this->load->view('layout/header');
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success">
            <strong>Transaksi Berhasil Silahkan Cetak Faktur Penjualan!</strong>
            <a class="btn btn-default" href="<?php echo base_url() . 'admin/penjualan' ?>"><span class="fa fa-backward"></span>Kembali</a>
            <a class="btn btn-info" href="<?php echo base_url() . 'admin/penjualan/cetak_faktur' ?>" target="_blank"><span class="fa fa-print"></span>Cetak</a>
        </div>
    </div>
</div>
<!-- /.row -->
<!-- Projects Row -->



<!--END MODAL-->

<?php
$this->load->view('layout/script');
?>

<script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>

<?php
$this->load->view('layout/footer');
?>