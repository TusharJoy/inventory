<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Batch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CropController extends Controller
{
    /**
     * Display a listing of the crops.
     */
    public function index()
    {
        $crops = Crop::with('batch')->paginate(10);
        return Inertia::render('Crops/Index', [
            'crops' => $crops
        ]);
    }

    /**
     * Show the form for creating a new crop.
     */
    public function create()
    {
        $batches = Batch::all();
        return Inertia::render('Crops/Create', [
            'batches' => $batches
        ]);
    }

    /**
     * Store a newly created crop in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,batch_id',
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'crop_variety' => 'required|string|max:255',
            'growing_season' => 'required|string|max:255',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'actual_harvest_date' => 'nullable|date|after:planting_date',
            'yield_amount' => 'nullable|numeric|min:0',
            'yield_unit' => 'nullable|string|max:50',
            'crop_status' => 'required|string|in:growing,harvested,failed',
            'notes' => 'nullable|string'
        ]);

        Crop::create($validated);

        return redirect()->route('crops.index')
            ->with('message', 'Crop created successfully.');
    }

    /**
     * Display the specified crop.
     */
    public function show(Crop $crop)
    {
        $crop->load('batch');
        return Inertia::render('Crops/Show', [
            'crop' => $crop
        ]);
    }

    /**
     * Show the form for editing the specified crop.
     */
    public function edit(Crop $crop)
    {
        $batches = Batch::all();
        return Inertia::render('Crops/Edit', [
            'crop' => $crop,
            'batches' => $batches
        ]);
    }

    /**
     * Update the specified crop in storage.
     */
    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,batch_id',
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'crop_variety' => 'required|string|max:255',
            'growing_season' => 'required|string|max:255',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'actual_harvest_date' => 'nullable|date|after:planting_date',
            'yield_amount' => 'nullable|numeric|min:0',
            'yield_unit' => 'nullable|string|max:50',
            'crop_status' => 'required|string|in:growing,harvested,failed',
            'notes' => 'nullable|string'
        ]);

        $crop->update($validated);

        return redirect()->route('crops.index')
            ->with('message', 'Crop updated successfully.');
    }

    /**
     * Remove the specified crop from storage.
     */
    public function destroy(Crop $crop)
    {
        $crop->delete();

        return redirect()->route('crops.index')
            ->with('message', 'Crop deleted successfully.');
    }
}
