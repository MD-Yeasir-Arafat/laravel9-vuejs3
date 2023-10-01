<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $empolyees = Employee::all();
        return response()->json($empolyees);
    }

    public function store(Request $request)
    {
        $empolyee = new Employee([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
        ]);

        $empolyee->save();
        return response()->json("Employee Saved");
    }

    public function show(){

    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return response()->json("Employee Updated");

    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json("Employee Deleted");

    }
}
