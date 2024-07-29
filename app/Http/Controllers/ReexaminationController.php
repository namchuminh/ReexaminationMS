<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Reexamination;
use App\Models\Exam;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class ReexaminationController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'student') {
            // Nếu là sinh viên, lấy danh sách phúc khảo của sinh viên đó
            $reexaminations = Reexamination::with(['student', 'exam.course'])
            ->where('student_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();
        } else {
            // Nếu là nhân viên, lấy toàn bộ danh sách phúc khảo
            $reexaminations = Reexamination::with('student')->with('exam')->get();
        }

        $semesters = Exam::select('semester')->distinct()->get();

        // Chuyển đổi kết quả thành mảng để dễ xử lý trong view
        $semesterList = $semesters->pluck('semester');

        return view('reexaminations.index', compact('reexaminations', 'semesterList'));
    }

    public function show($id){
        $reexamination = Reexamination::with(['student', 'exam.course'])
            ->where('id', $id)
            ->firstOrFail();

        if((auth()->user()->role == "student") && (auth()->user()->id != $reexamination->student_id)){
            return redirect()->route('reexaminations.index');
        }

        Notification::where('reexaminations_id', $id)->update(['is_read' => 1]);
        
        return view('reexaminations.show', compact('reexamination'));
    }

    public function create()
    {
        $exams = Exam::with('course')->whereHas('course', function ($query) {
            $query->where('department_id', auth()->user()->department_id)
            ->where('is_oral_exam', 0);
        })
        ->orderBy('exam_date', 'desc')
        ->get();
        return view('reexaminations.create', compact('exams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'reason' => 'required|string|max:255',
        ]);

        $reexamination = Reexamination::create([
            'student_id' => auth()->id(),
            'exam_id' => $request->exam_id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        // Gửi thông báo cho nhân viên
        $staffUsers = User::where('role', 'staff')->get();
        foreach ($staffUsers as $staff) {
            Notification::create([
                'user_id' => $staff->id,
                'message' => 'Một đơn phúc khảo đã được gửi bởi sinh viên: ' . auth()->user()->name. ' - MSSV: ' .auth()->user()->id.' - Lớp học: ' .auth()->user()->class->name.' - Khoa: ' .auth()->user()->department->name,
                'reexaminations_id' => $reexamination->id,
                'is_read' => false,
            ]);
        }

        return redirect()->route('reexaminations.index');
    }

    public function update(Request $request, $id){
        // Chỉ cho phép nhân viên cập nhật
        if (auth()->user()->role != 'staff') {
            return redirect()->back()->with('error', 'Bạn không có quyền cập nhật phản hồi phúc khảo.');
        }

        $reexamination = Reexamination::with(['student', 'exam.course'])
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|string|in:approved,rejected',
            'response' => 'required|string|max:255',
        ]);

        $reexamination->status = $request->status;
        $reexamination->response = $request->response;

        $reexamination->save();

        Notification::create([
            'user_id' => $reexamination->student_id,
            'message' => 'Phòng KT & ĐBCLGD đã gửi phản hồi phúc khảo môn học: ' .$reexamination->exam->course->name,
            'reexaminations_id' => $reexamination->id,
            'is_read' => false,
        ]);

        return redirect()->route('reexaminations.index');
    }

    public function export(Request $request)
    {
        $semester = $request->input('semester');

        // Lấy dữ liệu phúc khảo theo kỳ
        $reexaminations = Reexamination::whereHas('exam', function ($query) use ($semester) {
            $query->where('semester', $semester);
        })->get();

        // Tạo tiêu đề cho file CSV
        $filename = 'reexaminations_' . $semester . '.csv';

        // Tạo tiêu đề phản hồi HTTP để tải file về
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Tạo nội dung CSV với UTF-8 BOM
        $csvContent = "\xEF\xBB\xBF"; // UTF-8 BOM
        $csvContent .= "STT,Thông Tin Sinh Viên,Môn Học,Trạng Thái Phúc Khảo,Ngày Phúc Khảo,Lý Do Phúc Khảo,Phản Hồi Phúc Khảo\n";

        $stt = 1;
        foreach ($reexaminations as $reexamination) {
            $status = "Đang Đợi Duyệt";

            if($reexamination->status == "approved"){
                $status = "Đã Chấp Nhận";
            }else if($reexamination->status == "rejected"){
                $status = "Đã Từ Chối";
            }

            $csvContent .= implode(',', [
                $stt,
                'Họ tên: ' .$reexamination->student->name . ' - MSSV: '.$reexamination->student_id.' - Khoa / Chuyên ngành: '.$reexamination->student->department->name.' - Lớp học: '.$reexamination->student->class->name,
                $reexamination->exam->course->name,
                $status,
                $reexamination->created_at,
                $reexamination->reason,
                $reexamination->response,
            ]) . "\n";

            $stt++;
        }

        // Trả về phản hồi với nội dung file CSV
        return response($csvContent, 200, $headers);
    }





}
