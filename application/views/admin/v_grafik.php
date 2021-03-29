<?php
$this->load->view('layout/header');
?>

<!-- Projects Row -->
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-condensed" style="font-size:12px;" id="mydata">
            <thead>
                <tr>
                    <th style="text-align:center;width:40px;">No</th>
                    <th>Grafik</th>
                    <th style="width:100px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="text-align:center;vertical-align:middle">1</td>
                    <td style="vertical-align:middle;">Grafik Stok Barang</td>
                    <td style="text-align:center;">
                        <a class="btn btn-sm btn-default" href="<?php echo base_url() . 'admin/grafik/graf_stok_barang' ?>"><span class="fa fa-eye"></span> Lihat</a>
                    </td>
                </tr>

                <tr>
                    <td style="text-align:center;vertical-align:middle">2</td>
                    <td style="vertical-align:middle;">Grafik Penjualan PerBulan</td>
                    <td style="text-align:center;">
                        <a class="btn btn-sm btn-default" href="#lap_jual_perbulan" data-toggle="modal"><span class="fa fa-eye"></span> Lihat</a>
                    </td>
                </tr>

                <tr>
                    <td style="text-align:center;vertical-align:middle">3</td>
                    <td style="vertical-align:middle;">Grafik Penjualan PerTahun</td>
                    <td style="text-align:center;">
                        <a class="btn btn-sm btn-default" href="#lap_jual_pertahun" data-toggle="modal"><span class="fa fa-eye"></span> Lihat</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->


<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/grafik/graf_penjualan_perbulan' ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3">Bulan</label>
                        <div class="col-xs-9">
                            <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required />
                            <?php foreach ($jual_bln->result_array() as $k) {
                                $bln = $k['bulan'];
                            ?>
                                <option><?php echo $bln; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/grafik/graf_penjualan_pertahun' ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3">Tahun</label>
                        <div class="col-xs-9">
                            <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required />
                            <?php foreach ($jual_thn->result_array() as $t) {
                                $thn = $t['tahun'];
                            ?>
                                <option><?php echo $thn; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--END MODAL-->

<?php
$this->load->view('layout/script');
?>

<script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY HH:mm',
        });

        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#datepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
    });
</script>

<?php
$this->load->view('layout/footer');
?>