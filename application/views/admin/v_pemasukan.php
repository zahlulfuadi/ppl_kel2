<?php
$this->load->view('layout/header');
?>

<?php echo $this->session->flashdata('msg'); ?>

<!-- Projects Row -->
<div class="row">
    <div class="col-lg-12">
        <form action="<?php echo base_url() . 'admin/pemasukan/add_to_cart' ?>" method="post">
            <table style="margin-bottom: 80px;">
                <tr>
                    <th>Tanggal</th>
                </tr>
                <tr>
                    <td>
                        <div class='input-group date' id='datepicker' style="width:200px;">
                            <input type='text' name="tgl" class="form-control" value="<?php echo $this->session->userdata('tgl'); ?>" placeholder="Tanggal..." required />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Kode Barang</th>
                </tr>
                <tr>
                    <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                </tr>
                <div id="detail_barang" style="position:absolute; margin:130px 0px 65px 0px;"></div>
    </div>
    </table>
    </form>
    <p class="text-right">
        <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari Produk!</small></a>
    </p>
    <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th style="text-align:center;">Satuan</th>
                <th style="text-align:center;">Harga(Rp)</th>
                <th style="text-align:center;">Diskon(Rp)</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:center;">Sub Total</th>
                <th style="width:100px;text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($this->cart->contents() as $items) : ?>
                <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                <tr>
                    <?php if ($items['jenis'] == 'pemasukan') { ?>
                        <td><?= $items['id']; ?></td>
                        <td><?= $items['name']; ?></td>
                        <td style="text-align:center;"><?= $items['satuan']; ?></td>
                        <td style="text-align:right;"><?php echo number_format($items['amount']); ?></td>
                        <td style="text-align:right;"><?php echo number_format($items['disc']); ?></td>
                        <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                        <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>

                        <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/pemasukan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                    <?php } ?>
                </tr>

                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="<?php echo base_url() . 'admin/pemasukan/simpan_pemasukan' ?>" method="post">
        <table>
            <tr>
                <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Simpan</button></td>
                <th style="width:140px; text-align:right; padding-right:10px;">Total (Rp) </th>
                <th style="text-align:right;width:140px;"><input type="text" name="total" value="<?php echo number_format($this->cart->total_pemasukan()); ?>" class="form-control input-sm total" style="text-align:right;margin-bottom:5px;" readonly></th>
            </tr>
            <!-- <tr>
                    <th>Tunai(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                    <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                </tr>
                <tr>
                    <td></td>
                    <th>Kembalian(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                </tr> -->

        </table>
    </form>
    <hr />
</div>
<!-- /.row -->
<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
            </div>
            <div class="modal-body" style="overflow:scroll;height:500px;">

                <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th style="width:120px;">Kode Barang</th>
                            <th style="width:240px;">Nama Barang</th>
                            <th>Satuan</th>
                            <th style="width:100px;">Harga (Eceran)</th>
                            <th>Stok</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data->result_array() as $a) :
                            $no++;
                            $id = $a['id_barang'];
                            $nm = $a['nama_barang'];
                            $satuan = $a['satuan_barang'];
                            $harpok = $a['harga_pokok'];
                            $harjul = $a['harga_jual'];
                            $stok = $a['stok'];
                            $kat_id = $a['id_kategori'];
                            $kat_nama = $a['nama_kategori'];
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $nm; ?></td>
                                <td style="text-align:center;"><?php echo $satuan; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                <td style="text-align:center;"><?php echo $stok; ?></td>
                                <td style="text-align:center;">
                                    <form action="<?php echo base_url() . 'admin/pemasukan/add_to_cart' ?>" method="post">
                                        <input type="hidden" name="kode_brg" value="<?php echo $id ?>">
                                        <input type="hidden" name="nabar" value="<?php echo $nm; ?>">
                                        <input type="hidden" name="satuan" value="<?php echo $satuan; ?>">
                                        <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                        <input type="hidden" name="harjul" value="<?php echo number_format($harjul); ?>">
                                        <input type="hidden" name="diskon" value="0">
                                        <input type="hidden" name="qty" value="1" required>
                                        <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-edit"></span> Pilih</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>

            </div>
        </div>
    </div>
</div>



<!-- ============ MODAL HAPUS =============== -->


<!--END MODAL-->

<?php
$this->load->view('layout/script');
?>

<script type="text/javascript">
    $(function() {
        $('#jml_uang').on("input", function() {
            var total = $('#total').val();
            var jumuang = $('#jml_uang').val();
            var hsl = jumuang.replace(/[^\d]/g, "");
            $('#jml_uang2').val(hsl);
            $('#kembalian').val(hsl - total);
        })

    });
</script>
<script type="text/javascript">
    $(function() {
        $('.total').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('#jml_uang2').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ''
        });
        $('#kembalian').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.harjul').priceFormat({
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
        $("#kode_brg").on("input", function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'admin/pemasukan/get_barang'; ?>",
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