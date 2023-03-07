<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Players = Players::all();
        return response()->json(
            [
                'status' => 200,
                'Players' => $Players
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
                'age' => 'required|min:2|max:3',
                'role' => 'required|min:4|max:20',
                'team' => 'required|min:3|max:15'
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

            $Players = new Players;
            $Players->name = $request->name;
            $Players->age = $request->age;
            $Players->role = $request->role;
            $Players->team = $request->team;
            $Players->save();

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
        $Players = Players::find($id);
        if ($Players) {
            return response()->json(
                [
                    'status' => 200,
                    'Players' => $Players
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'Players' => 'Data Not Found!'
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
                'age' => 'required|min:2|max:3',
                'role' => 'required|min:4|max:20',
                'team' => 'required|min:3|max:15'
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

            $Players = Players::find($id);
            if ($Players) {
                $Players->name = $request->name;
                $Players->age = $request->age;
                $Players->role = $request->role;
                $Players->team = $request->team;
                $Players->update();

                return response()->json(
                    [
                        'status' => 200,
                        'Players' => 'updated successfully'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 404,
                        'Players' => 'Data Not Found!'
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
        $Players = Players::find($id);
        if ($Players) {
            $Players->delete();

            return response()->json(
                [
                    'status' => 200,
                    'Players' => 'deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'Players' => 'Data Not Found!'
                ]
            );
        }
    }

    public function search(string $name)
    {
        $Players = Players::where('name', 'like', '%' . $name . '%')->get();
        return response()->json(
            [
                'status' => 200,
                'Players' => $Players
            ]
        );
    }
}
