<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript">
    BASE_URL = "<?php echo base_url(); ?>";
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>smart Learning</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?php echo base_url() ?>tools/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'tools/css/style.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'tools/plugins/sweetalert2/sweetalert2.css' ?>">
  <!-- jQuery -->
<script src="<?php echo base_url() ?>tools/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>tools/plugins/jquery-ui/jquery-ui.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url() ?>tools/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
        height="60" width="60">
    </div>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../index3.html" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-th-large"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><strong><?php $user_name = $this->session->userdata('full_name');
            echo $user_name; ?></strong></span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-lock"></i> Login Time
              <span class="float-right text-muted text-sm">2025-02-05</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('admin/profile') ?>" class="btn btn-default btn-flat">Profile</a>
            <a href="<?php echo base_url('auth/log_out') ?>" class="btn btn-default btn-flat"
              style="margin-left:120px;">Log Out</a>
          </div>
        </li>


      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url() ?>tools/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">smart Learning</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?php echo base_url('admin') ; ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  User Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/user_list');?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('role'); ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Role</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('permission')  ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permission</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Course Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php echo base_url('board') ; ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Board/University</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('course') ; ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Course</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('chapter') ; ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chapter</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('topic') ; ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Topic</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('module')  ?>" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Module
                </p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>