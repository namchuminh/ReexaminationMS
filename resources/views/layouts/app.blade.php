@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/AdminLTELogo.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-primary navbar-badge">{{ $notificationsRead }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    @foreach ($notifications as $notification)
                        <a href="{{ route('reexaminations.show', $notification->reexaminations_id) }}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <b>Thông Báo</b>
                                    </h3>
                                    <p class="text-sm">{{ $notification->message }}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    @if ($totalNotifications == 0)
                        <div class="dropdown-divider"></div>
                        <p class="text-center pt-2 pb-2">Chưa có thông báo nào!</p>
                        <div class="dropdown-divider"></div>
                    @else
                        <a href="{{ route('reexaminations.index') }}" class="dropdown-item dropdown-footer">Xem Tất Cả</a>
                    @endif
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Quản Lý Phúc Khảo</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Trang Chủ
                                </p>
                            </a>
                        </li>

                        @if (auth()->user()->role == "staff")
                            <li class="nav-header">QUẢN LÝ GiẢNG DẠY</li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('classes.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-people-roof"></i>
                                    <p>
                                        Lớp Học
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('classes.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Danh Sách</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('classes.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Thêm Mới</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('departments.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-door-open"></i>
                                    <p>
                                        Khoa / Chuyên Ngành
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('departments.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Danh Sách</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('departments.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Thêm Mới</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('courses.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-book-tanakh"></i>
                                    <p>
                                        Môn Học
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('courses.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Danh Sách</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('courses.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Thêm Mới</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('exams.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-book-open"></i>
                                    <p>
                                        Bài Thi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('exams.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Danh Sách</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('exams.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Thêm Mới</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-header">QUẢN LÝ PHÚC KHẢO</li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('reexaminations.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-outdent"></i>
                                    <p>
                                        Danh Sách
                                    </p>
                                </a>
                            </li>
                        @else
                            <li class="nav-header">QUẢN LÝ PHÚC KHẢO</li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('reexaminations.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-outdent"></i>
                                    <p>
                                        Danh Sách
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{ route('reexaminations.create') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-share"></i>
                                    <p>
                                        Gửi Phúc Khảo
                                    </p>
                                </a>
                            </li>

                        @endif


                        <li class="nav-header">TÀI KHOẢN</li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                                <p>
                                    Đăng Xuất
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper" style="min-height: 1203.31px;">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>&copy; 2023-2024 - Trang dành cho <a href="#">phúc khảo điểm số</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Phiên bản</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @yield('css')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            $(document).ready(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 5000
                };
                toastr.error('{{ $error }}', 'Thất Bại!');
            });
        </script>
    @endforeach
@endif
