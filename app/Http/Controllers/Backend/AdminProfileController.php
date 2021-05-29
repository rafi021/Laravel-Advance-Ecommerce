<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminData = Admin::find(1);
        return view('admin.Profile.index', compact('adminData'));
    }

    public function AdminProfileEdit()
    {
        $editData = Admin::find(1);
        return view('admin.Profile.edit', compact('editData'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->file('image')){
            $image_file = $request->file('image');
            if($data->profile_photo_path){
                @unlink(public_path('upload/admin_images'.$data->profile_photo_path));
            }
            $filename = date('YmdHi').'.'.$image_file->getClientOriginalExtension();
            $image_file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path']= $filename;
        }
        $data->save();

        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('profile.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
