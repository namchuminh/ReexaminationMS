@extends('layouts.app')
@section('title', 'Xem đơn phúc khảo')
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
                    <li class="breadcrumb-item active">Xem Phúc Khảo</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid row">
        <div class="col-md-6">
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Môn Học</label>
                                <input type="text" class="form-control" placeholder="Tên Môn Học" value="{{ $reexamination->exam->course->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Học Kỳ</label>
                                <input type="text" class="form-control" placeholder="Học Kỳ"
                                    name="semester" value="{{ $reexamination->exam->semester }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Ngày Thi</label>
                                <input type="date" class="form-control" placeholder="Ngày Thi"
                                    name="exam_date" value="{{ $reexamination->exam->exam_date }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Nội Dung Phúc Khảo</label>
                                <textarea class="form-control" rows="3" disabled>{{ $reexamination->reason }}</textarea>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('reexaminations.index') }}">Quay Lại</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3>Phản Hồi Phúc Khảo</h3>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="{{ route('reexaminations.update', $reexamination->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Trạng Thái Phúc Khảo</label>
                                @if (auth()->user()->role == "student")
                                    @if ($reexamination->status == "pending")
                                        <input type="text" class="form-control" placeholder="Trạng Thái" value="Đang Đợi Duyệt" disabled>
                                    @elseif ($reexamination->status == "approved")
                                        <input type="text" class="form-control" placeholder="Trạng Thái" value="Đã Chấp Nhận" disabled>
                                    @else
                                        <input type="text" class="form-control" placeholder="Trạng Thái" value="Đã Từ Chối" disabled>
                                    @endif
                                @else
                                    <select name="status" class="form-control">
                                        <option value="approved" {{ $reexamination->status == "approved" ? "selected" : "" }}>Chấp Nhận Phúc Khảo</option>
                                        <option value="rejected" {{ $reexamination->status == "rejected" ? "selected" : "" }}>Từ Chối Phúc Khảo</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Phản Hồi Phúc Khảo</label>
                                <textarea name="response" class="form-control" rows="3" {{ auth()->user()->role == "student" ? "disabled" : "" }}>{{ $reexamination->response }}</textarea>
                            </div>
                        </div>
                        @if (auth()->user()->role == "staff")
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Gửi Phản Hồi</button>
                            </div>
                        @endif
                    </form>
                </div>
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


