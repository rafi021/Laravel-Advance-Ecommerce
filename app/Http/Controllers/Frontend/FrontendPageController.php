<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class FrontendPageController extends Controller
{
    public function home()
    {
        $categories = Category::with(['subcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('slider_name', '=', 'Main-Slider')->where('slider_status', '=', 1)->limit(3)->get();
        $new_products = Product::with(['brand', 'category', 'subcategory', 'subsubcategory', 'images'])
        ->where('new_arrival' ,'=', 1)
        ->where('status', 1)->limit(6)->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_category_products_0 = Product::where('category_id', $skip_category_0->id)
                        ->where('status', 1)
                        ->latest()->limit(20)->get();

        $skip_brand_0 = Brand::skip(0)->first();
        $skip_brand_products_0 = Product::where('brand_id', $skip_brand_0->id)
                        ->where('status', 1)
                        ->latest()->limit(20)->get();

        //return response()->json($categories);
        return view('frontend.index', compact(
            'categories',
            'sliders',
            'new_products',
            'skip_category_0',
            'skip_category_products_0',
            'skip_brand_0',
            'skip_brand_products_0',
        ));
    }

    public function category()
    {
        return view('frontend.frontend_layout.category_page.category-page');
    }

    public function productDeatil($id, $slug)
    {
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        $product = Product::with(['images'])->findOrFail($id);

        //return response()->json($product);
        return view('frontend.frontend_layout.product_page.product-page', compact(
            'categories',
            'product'
        ));
    }

    public function tagwiseProduct($tag)
    {
        $tag_products = Product::where('status',1)->where('product_tags_en', $tag)
        ->where('product_tags_bn',$tag)->orderBy('id', 'DESC')->get();
        $categories = Category::with(['subcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.tags_view', compact('tag_products', 'categories'));
    }

}
