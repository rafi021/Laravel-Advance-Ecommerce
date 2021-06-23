<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderStoreRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.Slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request)
    {

        if($request->file('slider_image')){
            $upload_location = 'upload/sliders/';
            $file = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(870,370)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;

            Slider::create([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
                'slider_image' => $save_url,
            ]);
        }else{
            Slider::create([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
            ]);
        }

        $notification = [
            'message' => 'Slider Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.index')->with($notification);
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
        $slider = Slider::findOrFail($id);
        return view('admin.Slider.edit', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        if($request->file('slider_image')){
            if($slider->slider_image !='https://source.unsplash.com/random'){
                unlink($slider->slider_image);
            }
            $upload_location = 'upload/sliders/';
            $file = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(870,370)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;

            $slider->update([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
                'slider_image' => $save_url,
            ]);
        }else{
            $slider->update([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
            ]);
        }

        $notification = [
            'message' => 'Slider Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if($slider->slider_image !='https://source.unsplash.com/random'){
            unlink($slider->slider_image);
        }

        $slider->delete();

        $notification = [
            'message' => 'Slider Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.index')->with($notification);
    }

    public function changeSliderStatus(Request $request)
    {
        $slider = Slider::findOrFail($request->slider_id);
        $slider->slider_status = $request->status;
        $slider->save();

         $notification = [
            'message' => 'Slider Status Updated Successfully!!!',
            'alert-type' => 'success'
        ];
        return response()->json($notification, 200);
    }
}
