@extends('layouts.app')
@section('title', 'Thêm mới lớp')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Lớp</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Quản Lý Lớp</a></li>
                    <li class="breadcrumb-item active">Thêm Lớp</li>
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
                <form method="post" action="{{ route('classes.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Lớp</label>
                                <input type="text" class="form-control tenchinh" id="ten" placeholder="Tên Lớp"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Khoa / Chuyên Ngành</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('classes.index') }}">Quay Lại</a>
                    <button class="btn btn-primary">Thêm Lớp</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

