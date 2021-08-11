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
        $categories = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('slider_name', '=', 'Main-Slider')->where('slider_status', '=', 1)->limit(3)->get();
        $new_products = Product::with(['images'])
        ->where('new_arrival' ,'=', 1)
        ->where('status', 1)->limit(20)->get();

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
        $colors_en = explode(',', $product->product_color_en);
        $colors_bn = explode(',', $product->product_color_bn);
        $size_en = explode(',', $product->product_size_en);
        $size_bn = explode(',', $product->product_size_bn);
        $related_products = Product::where('category_id',$product->category_id)
        ->where('id', '!=', $id)->orderBy('id','DESC')->get();
        //return response()->json($product);
        return view('frontend.frontend_layout.product_page.product-page', compact(
            'categories',
            'product',
            'colors_en',
            'colors_bn',
            'size_en',
            'size_bn',
            'related_products'
        ));
    }

    public function tagwiseProduct($tag)
    {
        $tag_products = Product::where('status',1)->where('product_tags_en', $tag)
        ->where('product_tags_bn',$tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.tags_view', compact('tag_products', 'categories'));
    }

    public function subcategoryProducts($id, $slug)
    {
        $subcategory_products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id','DESC')->paginate(3);
        //$categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        return view('frontend.frontend_layout.subcategory_page.subcategory_product_page', compact('subcategory_products'));
    }

    public function subsubcategoryProducts($id, $slug)
    {
        $subsubcategory_products = Product::where('status', 1)->where('sub_subcategory_id', $id)->orderBy('id','DESC')->paginate(3);
        //$categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        return view('frontend.frontend_layout.subcategory_page.subsubcategory_product_page', compact('subsubcategory_products'));
    }

    public function productviewAjax($id)
    {
        $product = Product::with(['brand','category'])->findOrFail($id);
        $colors_en = explode(',', $product->product_color_en);
        $size_en = explode(',', $product->product_size_en);
        return response()->json([
            'product' => $product,
            'colors_en' => $colors_en,
            'size_en' => $size_en,
        ],200);
    }
}
