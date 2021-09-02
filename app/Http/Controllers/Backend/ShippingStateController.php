<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShippingStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = ShipDistrict::with('division')->latest()->get();
        $divisions = ShipDivision::with('districts')->latest()->get();
        $states = ShipState::with(['division','district'])->latest()->get();
        //return $divisions;
        return view('admin.State.index', compact(
            'districts',
            'divisions',
            'states'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'state_name' => 'required',
        ]);

        ShipState::create([
            'division_id' => $request->input('division_id'),
            'district_id' => $request->input('district_id'),
            'state_name' => $request->input('state_name'),
        ]);
        $notification = [
            'message' => 'State Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('state.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts = ShipDistrict::with('division')->latest()->get();
        $divisions = ShipDivision::with('districts')->latest()->get();
        $state = ShipState::with(['division','district'])->findOrFail($id);
        //return $divisions;
        return view('admin.State.edit', compact(
            'districts',
            'divisions',
            'state'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'state_name' => 'required',
        ]);

        ShipState::findOrFail($id)->update([
            'division_id' => $request->input('division_id'),
            'district_id' => $request->input('district_id'),
            'state_name' => $request->input('state_name'),
        ]);
        $notification = [
            'message' => 'State Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('state.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ShipState::findOrFail($id)->delete();
        $notification = [
            'message' => 'State Deleted Successfully!!!',
            'alert-type' => 'danger'
        ];

        return redirect()->route('state.index')->with($notification);
    }

    public function getDistrict($division_id)
    {
        $districts = ShipDistrict::where('division_id','=', $division_id)->orderBy('district_name','ASC')->get();
        return json_encode($districts);
    }
    public function getState($district_id)
    {
        $states = ShipState::where('district_id','=', $district_id)->orderBy('state_name','ASC')->get();
        return json_encode($states);
    }

}
