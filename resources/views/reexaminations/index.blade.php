@extends('layouts.app')
@section('title', 'Danh sách phúc khảo')
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
                    <li class="breadcrumb-item active">Quản Lý Phúc Khảo</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('reexaminations.export') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="semester" class="form-control">
                                        @foreach ($semesterList as $semester)
                                            <option value="{{ $semester }}">{{ $semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success">
                                        Xuất Excel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                @if (auth()->user()->role == "student")
                                    <tr>
                                        <th>#</th>
                                        <th>Môn Học</th>
                                        <th>Học Kỳ</th>
                                        <th>Ngày Thi</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày Phúc Khảo</th>
                                        <th>Hành Động</th>
                                    </tr>
                                @else
                                    <tr>
                                        <th>#</th>
                                        <th>Thông Tin Sinh Viên</th>
                                        <th>Môn Học</th>
                                        <th>Học Kỳ</th>
                                        <th>Ngày Thi</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày Phúc Khảo</th>
                                        <th>Hành Động</th>
                                    </tr>
                                @endif
                                
                            </thead>
                            <tbody>
                                @if (auth()->user()->role == "student")
                                    @foreach ($reexaminations as $key => $item)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $item->exam->course->name }}
                                            </td>
                                            <td>
                                                {{ $item->exam->semester }}
                                            </td>
                                            <td>
                                                {{ $item->exam->exam_date }}
                                            </td>
                                            <td>
                                                @if ($item->status == "pending")
                                                    Đang Đợi Duyệt
                                                @elseif ($item->status == "approved")
                                                    Đã Chấp Nhận
                                                @else
                                                    Đã Từ Chối
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('reexaminations.show', $item->id) }}" class="btn btn-primary mr-2">
                                                    <i class="fas fa-edit"></i> <span>XEM PHẢN HỒI</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($reexaminations as $key => $item)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Họ tên: {{ $item->student->name }}</li>
                                                    <li>MSSV: {{ $item->student->id }}</li>
                                                    <li>Khoa / Chuyên ngành: {{ $item->student->department->name }}</li>
                                                    <li>Lớp học: {{ $item->student->class->name }}</li>
                                                </ul>
                                                
                                            </td>
                                            <td>
                                                {{ $item->exam->course->name }}
                                            </td>
                                            <td>
                                                {{ $item->exam->semester }}
                                            </td>
                                            <td>
                                                {{ $item->exam->exam_date }}
                                            </td>
                                            <td>
                                                @if ($item->status == "pending")
                                                    Đang Đợi Duyệt
                                                @elseif ($item->status == "approved")
                                                    Đã Chấp Nhận
                                                @else
                                                    Đã Từ Chối
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('reexaminations.show', $item->id) }}" class="btn btn-primary mr-2">
                                                    <i class="fas fa-edit"></i> <span>GỬI PHẢN HỒI</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection