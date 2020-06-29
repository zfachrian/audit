<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Audit | @yield('title') </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('back/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('back/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('back/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('back/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          <a class="d-block">Admin - {{ Auth::user()->company_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Menu
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <?php
          $role = Auth::user()->role;
          $display = "display:none;"
          ?>
          @if ($role == 2)
            <?php $display = "display:none;" ?>
          @elseif($role == 3)
            <?php $display = "display:none;" ?>
          @else
            <?php $display = " " ?>
          @endif
          <li class="nav-item has-treeview" style={{$display}} >
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manajemen User
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/userSupervisor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supervisor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="userManajer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manajer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/userAuditor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Auditor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/userKontraktor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kontraktor</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Audit Menu
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               @if ($role == 3)
                  <?php $display = "display:none;" ?>
                @else
                  <?php $display = " " ?>
                @endif
              <li class="nav-item">
                <a href="/audit" class="nav-link" style={{$display}}>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Audit</p>
                </a>
              </li>
                @if ($role == 3)
                  <?php $display = " " ?>
                @else
                  <?php $display = "display:none;" ?>
                @endif
              <li class="nav-item">
                <a href="/hasil/{{Auth::user()->id}}" class="nav-link" style={{$display}}>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hasil Audit</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="../forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li> --}}
            </ul>
          </li>
            {{-- display logic --}}
            </li>
            <?php
            $role = Auth::user()->role;
            $display = "display:none;"
            ?>
            @if ($role == 2)
            <?php $display = "display:none;" ?>
            @elseif($role == 3)
            <?php $display = "display:none;" ?>
            @else
            <?php $display = " " ?>
            @endif
            {{-- end of display logic --}}
          <li class="nav-item has-treeview menu" style={{$display}}>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manajemen Soal
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/KategoriWIP" class="nav-link" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Soal WIP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/KategoriPTW" class="nav-link" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Soal PTW</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header"></li>
          <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off nav-icon"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- {{-- @foreach ($path as $item => $value)
                <li class="breadcrumb-item @if($loop->last) @endif"> <a style="text-transform: capitalize;">{{ $value }}</a></li>
              @endforeach --}} -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        @yield('content')

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('back/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('back/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('back/dist/js/adminlte.min.js') }}"></script>
@yield('script')
</body>
</html>
