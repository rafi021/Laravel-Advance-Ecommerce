<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::with(['category'])->latest()->get();
        //return response()->json($subCategories);
        return view('admin.SubCategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.SubCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStoreRequest $request)
    {
        SubCategory::create([
            'category_id' => $request->input('category_id'),
            'subcategory_name_en' => $request->input('subcategory_name_en'),
            'subcategory_name_bn' => $request->input('subcategory_name_bn'),
            'subcategory_slug_en' => Str::slug($request->input('subcategory_name_en')),
            'subcategory_slug_bn' => Str::slug($request->input('subcategory_name_bn')),
        ]);

        $notification = [
            'message' => 'Sub Category Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subcategories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::latest()->get();
        return view('admin.SubCategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryStoreRequest $request, $id)
    {

        //dd($request->all(), $id);
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->input('subcategory_name_en'),
            'subcategory_name_bn' => $request->input('subcategory_name_bn'),
            'subcategory_slug_en' => Str::slug($request->input('subcategory_name_en')),
            'subcategory_slug_bn' => Str::slug($request->input('subcategory_name_bn')),
        ]);

        $notification = [
            'message' => 'Sub Category Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        $notification = [
            'message' => 'Sub Category Deleted Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subcategories.index')->with($notification);
    }
}
