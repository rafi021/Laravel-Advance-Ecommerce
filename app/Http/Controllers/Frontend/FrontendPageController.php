<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class FrontendPageController extends Controller
{
    public function home()
    {
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('slider_name', '=', 'Main-Slider')->get();

        //return response()->json($categories);
        return view('frontend.index', compact('categories', 'sliders'));
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
