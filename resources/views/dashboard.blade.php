@extends('layouts.app')
@section('title', 'Hệ Thống Phúc Khảo')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Bảng Điều Khiển</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        @if (auth()->user()->role == "staff")
        <div class="row">
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $reexaminationsToday }}</h3>
                <p>Đơn Phúc Khảo Hôm nay</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $reexaminationsThisWeek }}</h3>
                <p>Đơn Phúc Khảo Trong Tuần</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $reexaminationsThisMonth }}</h3>
                <p>Đơn Phúc Khảo Trong Tháng</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $reexaminationsThisYear }}</h3>
                <p>Đơn Phúc Khảo Trong Năm</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        @else
        <div class="row">
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalReexaminations }}</h3>
                <p>Đơn Phúc Khảo Đã Gửi</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $pendingReexaminations }}</h3>
                <p>Đơn Phúc Chờ Duyệt</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $approvedReexaminations }}</h3>
                <p>Đơn Phúc Khảo Chấp Nhận</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $rejectedReexaminations }}</h3>
                <p>Đơn Phúc Khảo Từ Chối</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa-solid fa-outdent"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        @endif


    </div><!-- /.container-fluid -->
</section>
@endsection
