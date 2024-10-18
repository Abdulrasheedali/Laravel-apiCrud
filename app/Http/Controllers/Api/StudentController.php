<?php

namespace App\Http\Controllers\Api;

use App\Models\Student; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create the student
        $student = Student::create($request->only(['name', 'course', 'email', 'phone']));

        if ($student) {
            return response()->json([
                'status' => 200,
                'message' => 'Student added successfully',
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function show($id)
    {
        $students = Student::find($id);
    
        if ($students) {
            return response()->json([
                'status' => 200,
                'student' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No data found'
            ], 404);
        }
    }

    public function edit($id){
        $students = Student::find($id);
    
        if ($students) {
            return response()->json([
                'status' => 200,
                'student' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No data found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'phone' => 'required|string|max:15'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages()
        ], 422);
    }

    $student = Student::find($id);

    if ($student) {
        $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Student updated successfully',
            'student' => $student
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No student found'
        ], 404);
    }
}

public function destory($id){
    $student = Student::find($id);
    if($student){
      $student->delete();
      return response()->json([
        'status' => 200,
        'message' => 'Student Deleted Sucessfully'
    ], 200);
    }else{
        return response()->json([
            'status' => 404,
            'message' => 'No student found'
        ], 404);
    }
}
}
