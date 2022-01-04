<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('layout/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Google Fonts Link -->
    <!-- Line Awesome CDN Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;800&display=swap">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

    <!-- Custom styles for this template-->
    <link href="<?= base_url('layout/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('layout/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url('layout/'); ?>css/mystyle.css">

    <!-- custom favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('layout/img/favicon.ico'); ?>">

</head>

<body id="page-top">
    <div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('sweetalert'); ?>"></div>
    <div class="flash-data-wrong" data-flashdata="<?= $this->session->flashdata('wrong'); ?>"></div>

    <!-- Page Wrapper -->
    <div id="wrapper">