<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::latest()->paginate(10);
        return Inertia::render('Warehouses/Index', [
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Warehouses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'capacity' => 'required|numeric|min:0',
            'storage_type' => 'required|string|max:255',
        ]);

        Warehouse::create($validated);

        return redirect()->route('warehouses.index')
            ->with('message', 'Warehouse created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return Inertia::render('Warehouses/Show', [
            'warehouse' => $warehouse
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return Inertia::render('Warehouses/Edit', [
            'warehouse' => $warehouse
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'capacity' => 'required|numeric|min:0',
            'storage_type' => 'required|string|max:255',
        ]);

        $warehouse->update($validated);

        return redirect()->route('warehouses.index')
            ->with('message', 'Warehouse updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouses.index')
            ->with('message', 'Warehouse deleted successfully.');
    }
}
