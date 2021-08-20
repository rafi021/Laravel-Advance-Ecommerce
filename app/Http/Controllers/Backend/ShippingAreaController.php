<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = ShipDivision::latest()->paginate(10);
        return view('admin.Division.index', compact('divisions'));
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
            'division_name' => 'required',
        ]);

        ShipDivision::create([
            'division_name' => $request->input('division_name'),
        ]);
        $notification = [
            'message' => 'Division Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('division.index')->with($notification);
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
        $division = ShipDivision::findOrFail($id);
        return view('admin.Division.edit', compact('division'));
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
            'division_name' => 'required',
        ]);

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->input('division_name'),
        ]);
        $notification = [
            'message' => 'Division Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('division.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ShipDivision::findOrFail($id)->delete();

        $notification = [
            'message' => 'Division Updated Successfully!!!',
            'alert-type' => 'danger'
        ];

        return redirect()->route('division.index')->with($notification);
    }
}
