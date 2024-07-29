<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reexamination;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->role == "staff"){
            $today = Carbon::today();

            // Lấy đơn phúc khảo hôm nay
            $reexaminationsToday = Reexamination::whereDate('created_at', $today)->get();

            // Lấy tuần hiện tại
            $startOfWeek = $today->startOfWeek();
            $endOfWeek = $today->endOfWeek();

            // Lấy đơn phúc khảo trong tuần này
            $reexaminationsThisWeek = Reexamination::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

            // Lấy tháng hiện tại
            $startOfMonth = $today->startOfMonth();
            $endOfMonth = $today->endOfMonth();

            // Lấy đơn phúc khảo trong tháng này
            $reexaminationsThisMonth = Reexamination::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

            // Lấy năm hiện tại
            $startOfYear = $today->startOfYear();
            $endOfYear = $today->endOfYear();

            // Lấy đơn phúc khảo trong năm này
            $reexaminationsThisYear = Reexamination::whereBetween('created_at', [$startOfYear, $endOfYear])->get();

            return view('dashboard', [
                'reexaminationsToday' => $reexaminationsToday->count(),
                'reexaminationsThisWeek' => $reexaminationsThisWeek->count(),
                'reexaminationsThisMonth' => $reexaminationsThisMonth->count(),
                'reexaminationsThisYear' => $reexaminationsThisYear->count()
            ]);
        }else{
            $studentId = auth()->id();

            // Tổng số đơn phúc khảo đã gửi
            $totalReexaminations = Reexamination::where('student_id', $studentId)->count();

            // Số đơn phúc khảo với trạng thái pending
            $pendingReexaminations = Reexamination::where('student_id', $studentId)
                                                ->where('status', 'pending')
                                                ->count();

            // Số đơn phúc khảo với trạng thái approved
            $approvedReexaminations = Reexamination::where('student_id', $studentId)
                                                    ->where('status', 'approved')
                                                    ->count();

            // Số đơn phúc khảo với trạng thái rejected
            $rejectedReexaminations = Reexamination::where('student_id', $studentId)
                                                    ->where('status', 'rejected')
                                                    ->count();

            return view('dashboard', [
                'totalReexaminations' => $totalReexaminations,
                'pendingReexaminations' => $pendingReexaminations,
                'approvedReexaminations' => $approvedReexaminations,
                'rejectedReexaminations' => $rejectedReexaminations,
            ]);
        }
    }
}
