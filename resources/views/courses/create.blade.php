@extends('layouts.app')
@section('title', 'Thêm mới môn học')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Môn Học</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Quản Lý Môn Học</a></li>
                    <li class="breadcrumb-item active">Thêm Môn Học</li>
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
                <form method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Môn Học</label>
                                <input type="text" class="form-control tenchinh" id="ten" placeholder="Tên Môn Học"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Mã Môn Học</label>
                                <input type="text" class="form-control tenchinh" id="ten" placeholder="Mã Môn Học"
                                    name="code">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Thi Vấn Đáp?</label>
                                <select name="is_oral_exam" id="is_oral_exam" class="form-control">
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
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
                    <a class="btn btn-success" href="{{ route('courses.index') }}">Quay Lại</a>
                    <button class="btn btn-primary">Thêm Môn Học</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

