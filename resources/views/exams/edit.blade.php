@extends('layouts.app')
@section('title', 'Thêm mới Bài Thi')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Bài Thi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Quản Lý Bài Thi</a></li>
                    <li class="breadcrumb-item active">Sửa Bài Thi</li>
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
                <form method="post" action="{{ route('exams.update', $exam->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Môn Học</label>
                                <select name="course_id" id="course_id" class="form-control">
                                    @foreach ($courses as $course)
                                        @if ($course->id == $exam->course_id)
                                            <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                        @else
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Học Kỳ</label>
                                <input type="text" class="form-control" placeholder="Học Kỳ"
                                    name="semester" value="{{ $exam->semester }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Ngày Thi</label>
                                <input type="date" class="form-control" placeholder="Ngày Thi"
                                    name="exam_date" value="{{ $exam->exam_date }}">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('exams.index') }}">Quay Lại</a>
                    <button class="btn btn-primary">Thêm Bài Thi</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

