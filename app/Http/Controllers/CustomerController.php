<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['user', 'pets'])->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:Users,username',
            'password' => 'required|min:6',
            'cusFName' => 'required',
            'cusLName' => 'required',
            'phoneNum' => 'required|unique:Customers,phoneNum',
            'email' => 'required|email|unique:Customers,email',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'Customer',
            'status' => 'Active',
        ]);

        Customer::create([
            'userID' => $user->userID,
            'cusFName' => $validated['cusFName'],
            'cusMName' => $request->cusMName,
            'cusLName' => $validated['cusLName'],
            'phoneNum' => $validated['phoneNum'],
            'email' => $validated['email'],
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function show($id)
    {
        $customer = Customer::with(['user', 'pets', 'bookings'])->findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        $validated = $request->validate([
            'cusFName' => 'required',
            'cusLName' => 'required',
            'phoneNum' => 'required|unique:Customers,phoneNum,' . $id . ',cusID',
            'email' => 'required|email|unique:Customers,email,' . $id . ',cusID',
        ]);

        $customer->update([
            'cusFName' => $validated['cusFName'],
            'cusMName' => $request->cusMName,
            'cusLName' => $validated['cusLName'],
            'phoneNum' => $validated['phoneNum'],
            'email' => $validated['email'],
            'address' => $request->address,
        ]);

        return redirect()->route('customers.show', $customer->cusID)->with('success', 'Customer updated successfully');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
