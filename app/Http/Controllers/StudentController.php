<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        return response()->json(
            [
                'status' => 200,
                'student' => $student
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =
            [
                'name' => 'required|min:3|max:20',
                'course' => 'required|min:2|max:30',
                'email' => 'required|email',
                'phone' => 'required|min:10|max:10'
            ];
        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => trans('messages.INVALID_DATA'),
                    'data' => $validated->errors()
                ]
            );
        } else {

            $Student = new Student;
            $Student->name = $request->name;
            $Student->course = $request->course;
            $Student->email = $request->email;
            $Student->phone = $request->phone;
            $Student->save();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'successfully'
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json(
                [
                    'status' => 200,
                    'student' => $student
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'student' => 'Data Not Found!'
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules =
            [
                'name' => 'required|min:3|max:20',
                'course' => 'required|min:2|max:30',
                'email' => 'required|email',
                'phone' => 'required|min:10|max:10'
            ];
        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => trans('messages.INVALID_DATA'),
                    'data' => $validated->errors()
                ]
            );
        } else {

            $student = Student::find($id);
            if ($student) {
                $student->name = $request->name;
                $student->course = $request->course;
                $student->email = $request->email;
                $student->phone = $request->phone;
                $student->update();

                return response()->json(
                    [
                        'status' => 200,
                        'student' => 'updated successfully'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 404,
                        'student' => 'Data Not Found!'
                    ]
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();

            return response()->json(
                [
                    'status' => 200,
                    'student' => 'deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'student' => 'Data Not Found!'
                ]
            );
        }
    }
}