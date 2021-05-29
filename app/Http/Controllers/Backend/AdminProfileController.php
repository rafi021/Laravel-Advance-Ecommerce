<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function AdminPasswordChange()
    {
        return view('admin.Profile.change_password');
    }

    public function AdminPasswordUpdate(AdminPasswordUpdateRequest $request){

        $current_password = $request->input('current_password');
        $new_password = $request->input('password');

        $admin = Admin::find(1);
        if(Hash::check($current_password,$admin->password)){
            $admin->password = Hash::make($new_password);
            $admin->update([
                'password' => $admin->password,
            ]);

            Auth::logout();

            $notification = [
                'message' => 'Password Updated Successfully!!!',
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.logout')->with($notification);
        }else{
            $notification = [
                'message' => 'Please provide valid password',
                'alert-type' => 'error'
            ];
            return redirect()->route('admin.change.password')->with($notification);
        }
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
