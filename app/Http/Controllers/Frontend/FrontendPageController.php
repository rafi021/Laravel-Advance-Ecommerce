<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class FrontendPageController extends Controller
{
    public function home()
    {
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->limit(5)->get();
        // $subcategories = SubCategory::with(['subsubcategory'])->orderBy('subcategory_name_en', 'ASC')->get();

        //return response()->json($categories);
        return view('frontend.index', compact('categories'));
    }

    public function category()
    {
        return view('frontend.frontend_layout.category_page.category-page');
    }

    public function productDeatil()
    {
        return view('frontend.frontend_layout.product_page.product-page');
    }

}
