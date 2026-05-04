<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        // Check if user is customer and filter their pets only
        if (auth()->user()->role === 'Customer') {
            $pets = auth()->user()->customer->pets;
            return view('pets.index', compact('pets'));
        } else {
            $pets = Pet::with('customer')->get();
            return view('pets.admin-index', compact('pets'));
        }
    }

    public function create()
    {
        // For customers, auto-fill their cusID
        if (auth()->user()->role === 'Customer') {
            $customers = collect([auth()->user()->customer]);
            return view('pets.create', compact('customers'));
        } else {
            $customers = Customer::all();
            return view('pets.admin-create', compact('customers'));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cusID' => 'required|exists:Customers,cusID',
            'petName' => 'required',
            'petType' => 'required|in:Cat,Dog',
            'breed' => 'required',
            'gender' => 'required|in:Male,Female',
            'birthdate' => 'required|date',
            'weightSize' => 'required|in:S,M,L',
            'petPhoto' => 'nullable|image|max:2048',
            'vaccinationFile' => 'required|file|max:5120',
        ]);

        // For customers, ensure they can only add pets to their own account
        if (auth()->user()->role === 'Customer') {
            $validated['cusID'] = auth()->user()->customer->cusID;
        }

        if ($request->hasFile('petPhoto')) {
            $validated['petPhoto'] = $request->file('petPhoto')->store('pets/photos', 'public');
        }

        if ($request->hasFile('vaccinationFile')) {
            $validated['vaccinationFile'] = $request->file('vaccinationFile')->store('pets/vaccinations', 'public');
        }

        Pet::create($validated);

        if (auth()->user()->role === 'Customer') {
            return redirect()->route('customer.pets.index')->with('success', 'Pet added successfully! Our staff will review the details shortly.');
        }

        return redirect()->route('pets.index')->with('success', 'Pet added successfully');
    }

    public function show($id)
    {
        $pet = Pet::with(['customer', 'bookings'])->findOrFail($id);

        if (auth()->user()->role === 'Customer') {
            return view('pets.show', compact('pet'));
        }

        return view('pets.admin-show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $customers = Customer::all();

        if (auth()->user()->role === 'Customer') {
            return view('pets.edit', compact('pet', 'customers'));
        }

        return view('pets.admin-edit', compact('pet', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        
        // For customers, ensure they can only edit their own pets
        if (auth()->user()->role === 'Customer' && $pet->cusID !== auth()->user()->customer->cusID) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'cusID' => 'required|exists:Customers,cusID',
            'petName' => 'required',
            'petType' => 'required|in:Cat,Dog',
            'breed' => 'required',
            'gender' => 'required|in:Male,Female',
            'birthdate' => 'required|date',
            'weightSize' => 'required|in:S,M,L',
            'petPhoto' => 'nullable|image|max:2048',
            'vaccinationFile' => 'nullable|file|max:5120',
        ]);

        if ($request->hasFile('petPhoto')) {
            $validated['petPhoto'] = $request->file('petPhoto')->store('pets/photos', 'public');
        }

        if ($request->hasFile('vaccinationFile')) {
            $validated['vaccinationFile'] = $request->file('vaccinationFile')->store('pets/vaccinations', 'public');
        }

        $pet->update($validated);

        if (auth()->user()->role === 'Customer') {
            return redirect()->route('customer.pets.index')->with('success', 'Pet updated successfully!');
        }

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        
        // For customers, ensure they can only delete their own pets
        if (auth()->user()->role === 'Customer' && $pet->cusID !== auth()->user()->customer->cusID) {
            abort(403, 'Unauthorized action.');
        }
        
        $pet->delete();

        if (auth()->user()->role === 'Customer') {
            return redirect()->route('customer.pets.index')->with('success', 'Pet deleted successfully');
        }

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
    }
}
