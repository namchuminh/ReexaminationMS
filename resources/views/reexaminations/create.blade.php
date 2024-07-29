@extends('layouts.app')
@section('title', 'Gửi phúc khảo')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Phúc Khảo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reexaminations.index') }}">Quản Lý Phúc Khảo</a></li>
                    <li class="breadcrumb-item active">Gửi Phúc Khảo</li>
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
                <form action="{{ route('reexaminations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Chọn Bài Thi (Không Vấn Đáp)</label>
                                <select name="exam_id" class="form-control">
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->course->name }} - Học Kỳ: {{ $exam->semester }} - Ngày Thi: {{ $exam->exam_date }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Nội Dung Yêu Cầu Phúc Khảo</label>
                                <textarea class="form-control" rows="3" name="reason"></textarea>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('reexaminations.index') }}">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">Gửi Phúc Khảo</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: white;
        opacity: 1;
        cursor: not-allowed;
    }
</style>
@endsection


