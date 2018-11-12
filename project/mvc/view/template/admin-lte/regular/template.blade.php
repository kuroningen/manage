@extends('template.admin-lte.template')
@section('main-body')
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <div class="fader"></div>
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>O</b>T</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Omni</b>Tool</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="fa fa-bars"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('logout') }}">
                            <i class="fa fa-sign-out-alt"></i>
                            <span class="hidden-xs">LOGOUT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @include('template.admin-lte.regular.sidebar')
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->

    @yield('body')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; {{ date('Y-m-d') }} <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('admin-lte/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin-lte/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin-lte/iCheck/icheck.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-lte/admin-lte/js/adminlte.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
<script src="{{ \project\core\lib\libAssetManager::i()->compileJsAsset() }}"></script>
</body>
@endsection