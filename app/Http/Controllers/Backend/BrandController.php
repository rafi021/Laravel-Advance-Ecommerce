<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.Brands.index', compact('brands'));
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
    public function store(BrandStoreRequest $request)
    {

        if($request->file('brand_image')){
            $upload_location = 'upload/brands/';
            $file = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(600,600)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;

            Brand::create([
                'brand_name_en' => $request->input('brand_name_en'),
                'brand_name_bn' => $request->input('brand_name_bn'),
                'brand_slug_en' => Str::slug($request->input('brand_slug_en')),
                'brand_slug_bn' => Str::slug($request->input('brand_slug_bn')),
                'brand_image' => $save_url
            ]);
        }else{
            Brand::create([
                'brand_name_en' => $request->input('brand_name_en'),
                'brand_name_bn' => $request->input('brand_name_bn'),
                'brand_slug_en' => Str::slug($request->input('brand_slug_en')),
                'brand_slug_bn' => Str::slug($request->input('brand_slug_bn')),
            ]);
        }

        $notification = [
            'message' => 'Brand Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('brands.index')->with($notification);
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
    public function edit(Brand $brand)
    {
        return view('admin.Brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        if($request->file('brand_image')){
            if($brand->brand_image !='default.jpg'){
                unlink($brand->brand_image);
            }
            $upload_location = 'upload/brands/';
            $file = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(600,600)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;

            $brand->update([
                'brand_name_en' => $request->input('brand_name_en'),
                'brand_name_bn' => $request->input('brand_name_bn'),
                'brand_slug_en' => Str::slug($request->input('brand_slug_en')),
                'brand_slug_bn' => Str::slug($request->input('brand_slug_bn')),
                'brand_image' => $save_url
            ]);
        }else{
            $brand->update([
                'brand_name_en' => $request->input('brand_name_en'),
                'brand_name_bn' => $request->input('brand_name_bn'),
                'brand_slug_en' => Str::slug($request->input('brand_slug_en')),
                'brand_slug_bn' => Str::slug($request->input('brand_slug_bn')),
            ]);
        }

        $notification = [
            'message' => 'Brand Updated Successfully!!!',
            'alert-type' => 'info'
        ];

        return redirect()->route('brands.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //dd($brand);
        if($brand->brand_image !='default.jpg'){
            unlink($brand->brand_image);
        }
        $brand->delete();

        $notification = [
            'message' => 'Brand Deleted Successfully!!!',
            'alert-type' => 'warning'
        ];

        return redirect()->route('brands.index')->with($notification);
    }
}
