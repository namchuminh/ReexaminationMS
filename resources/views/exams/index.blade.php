@extends('layouts.app')
@section('title', 'Danh sách bài thi')
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
                    <li class="breadcrumb-item active">Quản Lý Bài Thi</li>
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
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên Môn Học</th>
                                    <th>Học Kỳ</th>
                                    <th>Ngày Thi</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $key => $item)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $item->course->name }}
                                        </td>
                                        <td>
                                            {{ $item->semester }}
                                        </td>
                                        <td>
                                            {{ $item->exam_date }}
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('exams.edit', $item->id) }}" class="btn btn-primary mr-2">
                                                <i class="fas fa-edit"></i> <span>SỬA</span>
                                            </a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('exams.destroy', ['exam' => $item->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài thi này?')">
                                                    <i class="fas fa-trash"></i> XÓA
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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