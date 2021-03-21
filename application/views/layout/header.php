<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By Mfikri.com">
    <meta name="author" content="M Fikri Setiadi">
    <title>Judul | STIS POS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/fontawesome-free/css/all.min.css' ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/jqvmap/jqvmap.min.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/dist/css/adminlte.min.css' ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css' ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/daterangepicker/daterangepicker.css' ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/adminlte/plugins/summernote/summernote-bs4.min.css' ?>">





    <!-- Bootstrap Core CSS -->
    <!-- <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet"> -->


    <!-- laman supplier -->
    <!-- <link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
        // Navbar
        $this->load->view('layout/navbar');
        // Sidebar
        $this->load->view('layout/sidebar');
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->



            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">