<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::with('farmer')
            ->latest()
            ->paginate(10);

        return Inertia::render('Batches/Index', [
            'batches' => $batches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Batches/Create', [
            'farmers' => Farmer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,farmer_id',
            'batch_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date|after:start_date',
            'actual_end_date' => 'nullable|date|after:start_date',
            'batch_status' => 'required|in:planned,in_progress,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        Batch::create($validated);

        return redirect()->route('batches.index')
            ->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        $batch->load(['farmer', 'crops']);

        return Inertia::render('Batches/Show', [
            'batch' => $batch
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        return Inertia::render('Batches/Edit', [
            'batch' => $batch,
            'farmers' => Farmer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,farmer_id',
            'batch_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date|after:start_date',
            'actual_end_date' => 'nullable|date|after:start_date',
            'batch_status' => 'required|in:planned,in_progress,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $batch->update($validated);

        return redirect()->route('batches.index')
            ->with('success', 'Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect()->route('batches.index')
            ->with('success', 'Batch deleted successfully.');
    }
}
