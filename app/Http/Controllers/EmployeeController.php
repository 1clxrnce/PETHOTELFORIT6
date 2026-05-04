<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:Users,username',
            'password' => 'required|min:6',
            'empFName' => 'required',
            'empLName' => 'required',
            'phoneNum' => 'required|unique:Employees,phoneNum',
            'email' => 'required|email|unique:Employees,email',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required',
            'hireDate' => 'required|date',
            'role' => 'required|in:Staff,Admin',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => 'Active',
        ]);

        Employee::create([
            'userID' => $user->userID,
            'empFName' => $validated['empFName'],
            'empMName' => $request->empMName,
            'empLName' => $validated['empLName'],
            'phoneNum' => $validated['phoneNum'],
            'email' => $validated['email'],
            'birthdate' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'hireDate' => $validated['hireDate'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function show($id)
    {
        $employee = Employee::with(['user', 'bookings'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        
        $validated = $request->validate([
            'empFName' => 'required',
            'empLName' => 'required',
            'phoneNum' => 'required|unique:Employees,phoneNum,' . $id . ',empID',
            'email' => 'required|email|unique:Employees,email,' . $id . ',empID',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required',
            'hireDate' => 'required|date',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
