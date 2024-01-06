<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(){
        return view('employees.index',['employees'=>Employee::latest()->paginate(4)]);
    }
    public function create(){
        return view('employees.create');
    }
    public function store(Request $request) {
        // Validate
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z\s]+$/',
            'gender' => 'required',
            'dob' => ['required', 'date', 'before:' . Carbon::now()->subYears(17)->format('Y-m-d')],// 'required',
            'salary' => 'required |numeric',
            'joining_date' => ['required', 'date', 'before:tomorrow'],
            'contact_number' => ['required',
                        'numeric',
                        'max_digits:10',
                        'min_digits:10',
                        Rule::unique('employees','contact_number'),
                    ],
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email'),
            ],
        ]);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->gender = $request->gender;
        $employee->dob = $request->dob;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;
        $employee->relieving_date = $request->relieving_date;
        $employee->contact_number = $request->contact_number;
        $employee->email = $request->email;
        $employee->status = $request->status;

        $employee->save();

        return back()->withSuccess('Employee Added !!');
    }
    public function edit($id) {
        $employee = Employee::where('id',$id)->first();
        return view('employees.edit',['employee'=> $employee]);
    }
    public function update(Request $request, $id) {
        // Validate date
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z\s]+$/',
            'gender' => 'required',
            'dob' => ['required', 'date', 'before:' . Carbon::now()->subYears(17)->format('Y-m-d')],// 'required',
            'salary' => 'required |numeric',
            'joining_date' => ['required', 'date', 'before:tomorrow'],
            'contact_number' => ['required',
                        'numeric',
                        'max_digits:10',
                        'min_digits:10',
                    ],
            'email' => [
                'required',
                'email',
            ],
        ]);
        $employee = Employee::where('id',$id)->first();

        // $employee = new Employee;
        $employee->name = $request->name;
        $employee->gender = $request->gender;
        $employee->dob = $request->dob;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;
        $employee->relieving_date = $request->relieving_date;
        $employee->contact_number = $request->contact_number;
        $employee->email = $request->email;
        $employee->status = $request->status;

        $employee->save();

        return back()->withSuccess('Employee Updated Successfully !!');
    }
    public function destroy($id) {
        $employee = Employee::where('id',$id)->first();

        if (!$employee) {
            return response()->json(['message' => 'Employee not found.'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Deleted successfully.']);
    }
    public function show($id) {
        $employee = Employee::where('id',$id)->first();
        return view('employees.show',['employee'=>$employee]);
    }
}
