<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Markets/Index', [
            'markets' => Market::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Markets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'market_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'market_status' => 'required|in:active,inactive,temporary_closed',
            'notes' => 'nullable|string'
        ]);

        Market::create($validated);

        return redirect()->route('markets.index')
            ->with('success', 'Market created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Market $market)
    {
        return Inertia::render('Markets/Show', [
            'market' => $market
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Market $market)
    {
        return Inertia::render('Markets/Edit', [
            'market' => $market
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Market $market)
    {
        $validated = $request->validate([
            'market_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'market_status' => 'required|in:active,inactive,temporary_closed',
            'notes' => 'nullable|string'
        ]);

        $market->update($validated);

        return redirect()->route('markets.index')
            ->with('success', 'Market updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Market $market)
    {
        $market->delete();

        return redirect()->route('markets.index')
            ->with('success', 'Market deleted successfully.');
    }
}
