<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {

        if($request->file('category_image')){
            $upload_location = 'upload/categories/';
            $file = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(600,600)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;

            Category::create([
                'category_name_en' => $request->input('category_name_en'),
                'category_name_bn' => $request->input('category_name_bn'),
                'category_slug_en' => Str::slug($request->input('category_slug_en')),
                'category_slug_bn' => Str::slug($request->input('category_slug_bn')),
                'category_icon' => $request->input('category_icon'),
                'category_image' => $save_url
            ]);
        }else{
            Category::create([
                'category_name_en' => $request->input('category_name_en'),
                'category_name_bn' => $request->input('category_name_bn'),
                'category_slug_en' => Str::slug($request->input('category_slug_en')),
                'category_slug_bn' => Str::slug($request->input('category_slug_bn')),
                'category_icon' => $request->input('category_icon'),
            ]);
        }

        $notification = [
            'message' => 'Category Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.Category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        if($request->file('category_image')){
            if($category->category_image !='default.jpg'){
                unlink($category->category_image);
            }
            $upload_location = 'upload/categories/';
            $file = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(600,600)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;

            $category->update([
                'category_name_en' => $request->input('category_name_en'),
                'category_name_bn' => $request->input('category_name_bn'),
                'category_slug_en' => Str::slug($request->input('category_slug_en')),
                'category_slug_bn' => Str::slug($request->input('category_slug_bn')),
                'category_icon' => $request->input('category_icon'),
                'category_image' => $save_url
            ]);
        }else{
            $category->update([
                'category_name_en' => $request->input('category_name_en'),
                'category_name_bn' => $request->input('category_name_bn'),
                'category_slug_en' => Str::slug($request->input('category_slug_en')),
                'category_slug_bn' => Str::slug($request->input('category_slug_bn')),
                'category_icon' => $request->input('category_icon'),
            ]);
        }

        $notification = [
            'message' => 'Category Updated Successfully!!!',
            'alert-type' => 'info'
        ];

        return redirect()->route('categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->category_image !='default.jpg'){
            unlink($category->category_image);
        }
        $category->delete();

        $notification = [
            'message' => '$category Deleted Successfully!!!',
            'alert-type' => 'warning'
        ];

        return redirect()->route('categories.index')->with($notification);

    }
}
