<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('department')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:courses,code',
            'is_oral_exam' => 'required|boolean',
            'department_id' => 'required|exists:departments,id',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Tạo môn học thành công');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $departments = Department::all();
        return view('courses.edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:courses,code,'.$course->id,
            'is_oral_exam' => 'required|boolean',
            'department_id' => 'required|exists:departments,id',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Cập nhật môn học thành công');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Xóa môn học thành công');
    }
}
