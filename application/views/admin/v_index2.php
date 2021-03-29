<?php
$this->load->view('layout/header');
?>



<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-12">
                <p style="font-size: 5rem; text-align:center;">SELAMAT DATANG</p>
                <p style="font-size: 2rem; text-align:center; margin-top: -40px; margin-bottom: 20px;">Di Website Kami, STIS Point of Sale</p>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12" style="text-align: center;">
                <img src="<?php echo base_url() . 'assets/img/logopos.png' ?>" alt="Logo STIS Poin of Sale">
            </section>
        </div>
        <!-- /.row (main row) -->
    </div>

    <?php
    $this->load->view('layout/script');
    ?>
    <?php
    $this->load->view('layout/footer');
    ?>