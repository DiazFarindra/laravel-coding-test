<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogRequest;
use App\Http\Requests\UpdateLogRequest;
use App\Models\Log;
use App\Models\Package;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::get();

        return view('logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ponds = Pond::with('packages')->get();

        return view('logs.create', $ponds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogRequest $request)
    {
        $from_package = Package::find($request->package_id);
        $from_package->total_unit = $from_package->total_unit - $request->total_unit;
        $from_package->save();

        $to_package = Package::find($request->to_package_id);
        $to_package->total_unit = $to_package->total_unit + $request->total_unit;
        $to_package->save();

        $request->merge([
            'from_pond' => $from_package->pond->id,
            'to_pond' => $to_package->pond->id,
        ]);

        Log::create($request->validated());

        return redirect()->route('logs.index')->with('success', 'Log created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        return view('logs.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        return view('logs.edit', compact('log'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLogRequest  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogRequest $request, Log $log)
    {
        $from_package = Package::find($request->package_id);
        $to_package = Package::find($request->to_package_id);

        $total_unit = $this->calculateUpdateUnit(
            $to_package->total_unit,
            $request->total_unit,
            $from_package->total_unit
        );

        $from_package->total_unit = $total_unit;
        $from_package->save();

        $to_package->total_unit = $request->total_unit;
        $to_package->save();

        $log->update($request->validated());

        return redirect()->route('logs.index')->with('success', 'Log updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log deleted successfully.');
    }

    public function calculateUpdateUnit(
        int $unit_before_update = 0,
        int $requested_unit = 0,
        int $package_unit = 0
    )
    {
        // check the data is exaggerated or deducted
        if ($unit_before_update > $requested_unit) {
            // exaggerated in package
            $unit = ($unit_before_update - $requested_unit);
            $total_unit = ($package_unit + $unit);
        }

        if ($unit_before_update < $requested_unit) {
            // deducted in package
            $unit = ($requested_unit - $unit_before_update);
            $total_unit = ($package_unit - $unit);
        }

        if ($unit_before_update == $requested_unit) {
            $total_unit = $package_unit;
        }

        return $total_unit;
    }
}
