<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Employee = Employee::all();
        return response()->json(
            [
                'status' => 200,
                'Employee' => $Employee
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
                'department' => 'required|min:2|max:10',
                'designation' => 'required|min:2|max:20'
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

            $Employee = new Employee;
            $Employee->name = $request->name;
            $Employee->department = $request->department;
            $Employee->designation = $request->designation;
            $Employee->save();

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
        $Employee = Employee::find($id);
        if ($Employee) {
            return response()->json(
                [
                    'status' => 200,
                    'Employee' => $Employee
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'Employee' => 'Data Not Found!'
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
                'department' => 'required|min:2|max:10',
                'designation' => 'required|min:4|max:20',
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

            $Employee = Employee::find($id);
            if ($Employee) {
                $Employee->name = $request->name;
                $Employee->department = $request->department;
                $Employee->designation = $request->designation;
                $Employee->update();

                return response()->json(
                    [
                        'status' => 200,
                        'Employee' => 'updated successfully'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 404,
                        'Employee' => 'Data Not Found!'
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
        $Employee = Employee::find($id);
        if ($Employee) {
            $Employee->delete();

            return response()->json(
                [
                    'status' => 200,
                    'Employee' => 'deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'Employee' => 'Data Not Found!'
                ]
            );
        }
    }

    public function search(string $name)
    {
        $Employee = Employee::where('name', 'like', '%' . $name . '%')->get();
        return response()->json(
            [
                'status' => 200,
                'Employee' => $Employee
            ]
        );
    }
}
