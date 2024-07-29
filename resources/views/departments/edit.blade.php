@extends('layouts.app')
@section('title', 'Sửa mới khoa / chuyên ngành')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Khoa / Chuyên Ngành</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Quản Lý Khoa / Chuyên Ngành</a></li>
                    <li class="breadcrumb-item active">Sửa Khoa / Chuyên Ngành</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('departments.update', $department) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Khoa / Chuyên Ngành</label>
                                <input type="text" class="form-control tenchinh" id="ten" placeholder="Tên Khoa / Chuyên Ngành"
                                    name="name" value="{{ $department->name}}">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('departments.index') }}">Quay Lại</a>
                    <button class="btn btn-primary">Sửa Khoa / Chuyên Ngành</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

