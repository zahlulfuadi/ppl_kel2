<?php
$this->load->view('layout/header');
?>

<p class="text-center"><?php echo $this->session->flashdata('msg'); ?></p>

<!-- /.row -->
<!-- Projects Row -->
<div class="row">
    <div class="col-lg-12">
        <form action="<?php echo base_url() . 'admin/pengeluaran/add_to_cart' ?>" method="post">
            <table>
                <tr>
                    <th style="width:100px;padding-bottom:5px;">Supplier</th>
                    <td style="width:300px;padding-bottom:5px;">
                        <select name="supplier" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Supplier" data-width="100%">
                            <option value=''>Pilih Supplier</option>
                            <?php foreach ($sup->result_array() as $i) {
                                $id_sup = $i['id_supplier'];
                                $nm_sup = $i['nama_supplier'];
                                $al_sup = $i['alamat'];
                                $notelp_sup = $i['no_telp'];
                                $sess_id = $this->session->userdata('supplier');
                                if ($sess_id == $id_sup)
                                    echo "<option value='$id_sup' selected>$nm_sup - $al_sup - $notelp_sup</option>";
                                else
                                    echo "<option value='$id_sup'>$nm_sup - $al_sup - $notelp_sup</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>
                        <div class='input-group date' id='datepicker' style="width:200px;">
                            <input type='text' name="tgl" class="form-control" value="<?php echo $this->session->userdata('tgl'); ?>" placeholder="Tanggal..." required />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
            <hr />
            <table style="margin-bottom: 80px;">
                <tr>
                    <th>Kode Barang</th>
                </tr>
                <tr>
                    <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                </tr>
                <div id="detail_barang" style="position:absolute; margin:65px 0px 65px 0px;"></div>
            </table>
        </form>
        <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th style="text-align:center;">Satuan</th>
                    <th style="text-align:center;">Supplier</th>
                    <th style="text-align:center;">Harga Pokok</th>
                    <th style="text-align:center;">Jumlah Beli</th>
                    <th style="text-align:center;">Sub Total</th>
                    <th style="width:100px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($this->cart->contents() as $items) : ?>
                    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                    <?php if ($items['jenis'] == 'pengeluaran') { ?>
                        <tr>
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['name']; ?></td>
                            <td style="text-align:center;"><?= $items['satuan']; ?></td>
                            <td style="text-align:right;"><?= $items['id_supplier']; ?></td>
                            <td style="text-align:right;"><?php echo number_format($items['price']); ?></td>
                            <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                            <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>
                            <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/pengeluaran/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                        </tr>
                    <?php } ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align:center;">Total</td>
                    <td style="text-align:right;">Rp. <?php echo number_format($this->cart->total_pengeluaran()); ?></td>
                </tr>
            </tfoot>
        </table>
        <a href="<?php echo base_url() . 'admin/pengeluaran/simpan_pengeluaran' ?>" class="btn btn-info btn-lg"><span class="fa fa-save"></span> Simpan</a>
    </div>
</div>
<!-- /.row -->
<?php
$this->load->view('layout/script');
?>

<script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>

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
<script type="text/javascript">
    $(function() {
        $('.harga_pokok').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.harga_jual').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //Ajax kabupaten/kota insert
        $("#kode_brg").focus();
        $("#kode_brg").keyup(function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'admin/pengeluaran/get_barang'; ?>",
                data: kobar,
                success: function(msg) {
                    $('#detail_barang').html(msg);
                }
            });
        });

        $("#kode_brg").keypress(function(e) {
            if (e.which == 13) {
                $("#jumlah").focus();
            }
        });
    });
</script>


<?php
$this->load->view('layout/footer');
?>