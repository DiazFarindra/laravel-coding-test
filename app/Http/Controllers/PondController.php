<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePondRequest;
use App\Http\Requests\UpdatePondRequest;
use App\Models\Pond;

class PondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ponds = Pond::with('packages.logs')->get();

        return view('ponds.index', compact('ponds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePondRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePondRequest $request)
    {
        Pond::create($request->validated());

        return redirect()->route('ponds.index')->with('success', 'Pond created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pond  $pond
     * @return \Illuminate\Http\Response
     */
    public function show(Pond $pond)
    {
        return view('ponds.show', compact('pond'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pond  $pond
     * @return \Illuminate\Http\Response
     */
    public function edit(Pond $pond)
    {
        return view('ponds.edit', compact('pond'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePondRequest  $request
     * @param  \App\Models\Pond  $pond
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePondRequest $request, Pond $pond)
    {
        $pond->update($request->validated());

        return redirect()->route('ponds.index')->with('success', 'Pond updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pond  $pond
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pond $pond)
    {
        $pond->delete();

        return redirect()->route('ponds.index')->with('success', 'Pond deleted successfully.');
    }
}
