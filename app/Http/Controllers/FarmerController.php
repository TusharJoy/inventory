<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmer;
use Inertia\Inertia;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmers = Farmer::latest()->paginate(10);
        return Inertia::render('Farmers/Index', [
            'farmers' => $farmers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Farmers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
        ]);

        Farmer::create($validated);

        return redirect()->route('farmers.index')
            ->with('message', 'Farmer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farmer $farmer)
    {
        return Inertia::render('Farmers/Show', [
            'farmer' => $farmer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farmer $farmer)
    {
        return Inertia::render('Farmers/Edit', [
            'farmer' => $farmer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farmer $farmer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
        ]);

        $farmer->update($validated);

        return redirect()->route('farmers.index')
            ->with('message', 'Farmer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farmer $farmer)
    {
        $farmer->delete();

        return redirect()->route('farmers.index')
            ->with('message', 'Farmer deleted successfully.');
    }
}
