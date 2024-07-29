@extends('layouts.app')
@section('title', 'Sửa môn học')
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
                    <li class="breadcrumb-item active">Sửa Môn Học</li>
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
                <form method="post" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Môn Học</label>
                                <input type="text" class="form-control tenchinh" id="ten" placeholder="Tên Môn Học"
                                    name="name" value="{{ $course->name }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Mã Môn Học</label>
                                <input type="text" class="form-control tenchinh" id="ten" placeholder="Mã Môn Học"
                                    name="code" value="{{ $course->code }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Thi Vấn Đáp?</label>
                                <select name="is_oral_exam" id="is_oral_exam" class="form-control">
                                    <option value="1" {{ $course->is_oral_exam == 1 ? "selected" : "" }}>Có</option>
                                    <option value="0" {{ $course->is_oral_exam == 0 ? "selected" : "" }}>Không</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Khoa / Chuyên Ngành</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    @foreach ($departments as $department)
                                        @if ($department->id == $course->department_id)
                                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                        @else
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('courses.index') }}">Quay Lại</a>
                    <button class="btn btn-primary">Sửa Môn Học</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

