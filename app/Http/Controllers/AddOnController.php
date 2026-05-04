<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use Illuminate\Http\Request;

class AddOnController extends Controller
{
    public function index()
    {
        $addOns = AddOn::all();
        return view('addons.index', compact('addOns'));
    }

    public function create()
    {
        return view('addons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'addOnName' => 'required|unique:AddOns,addOnName',
            'price' => 'required|numeric|min:0',
        ]);

        AddOn::create($validated);

        return redirect()->route('addons.index')->with('success', 'Add-on created successfully');
    }

    public function show($id)
    {
        $addOn = AddOn::with('bookings')->findOrFail($id);
        return view('addons.show', compact('addOn'));
    }

    public function edit($id)
    {
        $addOn = AddOn::findOrFail($id);
        return view('addons.edit', compact('addOn'));
    }

    public function update(Request $request, $id)
    {
        $addOn = AddOn::findOrFail($id);
        
        $validated = $request->validate([
            'addOnName' => 'required|unique:AddOns,addOnName,' . $id . ',addOnID',
            'price' => 'required|numeric|min:0',
        ]);

        $addOn->update($validated);

        return redirect()->route('addons.index')->with('success', 'Add-on updated successfully');
    }

    public function destroy($id)
    {
        $addOn = AddOn::findOrFail($id);
        $addOn->delete();

        return redirect()->route('addons.index')->with('success', 'Add-on deleted successfully');
    }
}
