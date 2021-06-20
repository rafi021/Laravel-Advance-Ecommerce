<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubSubCategoryStoreRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsubCategories = SubSubCategory::with(['category','subcategory'])->latest()->get();
        return view('admin.SubSubCategory.index', compact('subsubCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('subcategory')->latest()->get();
        //dd($categories);
        return view('admin.SubSubCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubSubCategoryStoreRequest $request)
    {
        // dd($request->all());
        SubSubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->input('subsubcategory_name_en'),
            'subsubcategory_name_bn' => $request->input('subsubcategory_name_bn'),
            'subsubcategory_slug_en' => Str::slug($request->input('subsubcategory_name_en')),
            'subsubcategory_slug_bn' => Str::slug($request->input('subsubcategory_name_bn')),
        ]);

        $notification = [
            'message' => 'Sub Sub Category Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subsubcategories.index')->with($notification);
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
        $subsubCategory = SubSubCategory::findOrFail($id);
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.SubSubCategory.edit', compact('categories','subcategories','subsubCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubSubCategoryStoreRequest $request, $id)
    {
        $subsubCategory = SubSubCategory::findOrFail($id);
        $subsubCategory->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->input('subsubcategory_name_en'),
            'subsubcategory_name_bn' => $request->input('subsubcategory_name_bn'),
            'subsubcategory_slug_en' => Str::slug($request->input('subsubcategory_name_en')),
            'subsubcategory_slug_bn' => Str::slug($request->input('subsubcategory_name_bn')),
        ]);

        $notification = [
            'message' => 'Sub Sub Category Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subsubcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsubCategory = SubSubCategory::findOrFail($id);
        $subsubCategory->delete();

        $notification = [
            'message' => 'Sub Sub Category Deleted Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subsubcategories.index')->with($notification);
    }

    public function getSubCategory($category_id)
    {
        $subCategory = SubCategory::where('category_id','=', $category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subCategory);
    }

    public function getSubSubCategory($subcategory_id)
    {
        $subsubCategory = SubSubCategory::where('subcategory_id', '=', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubCategory);
    }
}
