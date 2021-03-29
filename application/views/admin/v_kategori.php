<?php
$this->load->view('layout/header');
?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kategori
            <small>Barang</small>
            <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Kategori</a></div>
        </h1>
    </div>
</div>

<!-- /.row -->
<!-- Projects Row -->
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
            <thead>
                <tr>
                    <th style="text-align:center;width:40px;">No</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th style="width:140px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $a) :
                    $no++;
                    $id = $a['id_kategori'];
                    $nm = $a['nama_kategori'];
                    $des = $a['deskripsi'];

                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td><?php echo $nm; ?></td>
                        <td><?php echo $des; ?></td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->
<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kategori</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/kategori/tambah_kategori' ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3">Nama Kategori</label>
                        <div class="col-xs-9">
                            <input name="kategori" class="form-control" type="text" placeholder="Input Nama Kategori..." style="width:280px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Deskripsi</label>
                        <div class="col-xs-9">
                            <textarea name="deskripsi" class="form-control" rows="3" style="width:280px;" type="text" placeholder="Masukkan Deskripsi..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============ MODAL EDIT =============== -->
<?php
foreach ($data->result_array() as $a) {
    $id = $a['id_kategori'];
    $nm = $a['nama_kategori'];
    $des = $a['deskripsi'];
?>
    <div id="modalEditPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Edit Kategori</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/kategori/edit_kategori' ?>">
                    <div class="modal-body">
                        <input name="kode" type="hidden" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Kategori</label>
                            <div class="col-xs-9">
                                <input name="kategori" class="form-control" type="text" value="<?php echo $nm; ?>" style="width:280px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Deskripsi</label>
                            <div class="col-xs-9">
                                <textarea name="deskripsi" class="form-control" rows="3" style="width:280px;" type="text" placeholder="Masukkan Deskripsi..."></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<!-- ============ MODAL HAPUS =============== -->
<?php
foreach ($data->result_array() as $a) {
    $id = $a['id_kategori'];
    $nm = $a['nama_kategori'];
    $des = $a['deskripsi'];
?>
    <div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Hapus Kategori</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/kategori/hapus_kategori' ?>">
                    <div class="modal-body">
                        <p>Yakin mau menghapus data..?</p>
                        <input name="kode" type="hidden" value="<?php echo $id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<!--END MODAL-->
<?php
$this->load->view('layout/script');
?>
<?php
$this->load->view('layout/footer');
?>