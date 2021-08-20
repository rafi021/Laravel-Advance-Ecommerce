<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

class ShippingDistrictController extends Controller
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
        //return $divisions;
        return view('admin.District.index', compact('districts', 'divisions'));
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
            'district_name' => 'required',
        ]);

        ShipDistrict::create([
            'division_id' => $request->input('division_id'),
            'district_name' => $request->input('district_name'),
        ]);
        $notification = [
            'message' => 'District Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('district.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = ShipDistrict::with('division')->findOrFail($id);
        $divisions = ShipDivision::with('districts')->latest()->get();
        //return $divisions;
        return view('admin.District.edit', compact('district', 'divisions'));
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
            'district_name' => 'required',
        ]);

        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->input('division_id'),
            'district_name' => $request->input('district_name'),
        ]);
        $notification = [
            'message' => 'District Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('district.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        ShipDistrict::findOrFail($id)->delete();
        $notification = [
            'message' => 'District Deleted Successfully!!!',
            'alert-type' => 'danger'
        ];

        return redirect()->route('district.index')->with($notification);
    }
}
