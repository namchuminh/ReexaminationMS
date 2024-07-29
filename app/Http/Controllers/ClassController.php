<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Department;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with('department')->get();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('classes.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ClassModel::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Tạo lớp thành công');
    }

    public function show(ClassModel $class)
    {
        return view('classes.show', compact('class'));
    }

    public function edit(ClassModel $class)
    {
        $departments = Department::all();
        return view('classes.edit', compact('class', 'departments'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Cập nhật lớp thành công');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Xóa lớp thành công');
    }
}
