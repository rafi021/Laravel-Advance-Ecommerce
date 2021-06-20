<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image as ModelsImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['brand', 'category', 'subcategory', 'subsubcategory', 'images'])->latest()->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('admin.Product.create', compact(
            'brands',
            'categories',
            'subcategories',
            'subsubcategories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        //dd($request->all());
        $product = Product::create([
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'sub_subcategory_id' => $request->input('sub_subcategory_id'),
            'product_name_en' => $request->input('product_name_en'),
            'product_name_bn' => $request->input('product_name_bn'),
            'product_slug_en' => Str::slug($request->input('product_name_en')),
            'product_slug_bn' => Str::slug($request->input('product_name_bn')),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
            'product_tags_en' => $request->input('product_tags_en'),
            'product_tags_bn' => $request->input('product_tags_bn'),
            'product_size_en' => $request->input('product_size_en'),
            'product_size_bn' => $request->input('product_size_bn'),
            'product_color_en' => $request->input('product_color_en'),
            'product_color_bn' => $request->input('product_color_bn'),
            'purchase_price' => $request->input('purchase_price'),
            'selling_price' => $request->input('selling_price'),
            'discount_price' => $request->input('discount_price'),
            'short_description_en' => $request->input('short_description_en'),
            'short_description_bn' => $request->input('short_description_bn'),
            'long_description_en' => $request->input('long_description_en'),
            'long_description_bn' => $request->input('long_description_bn'),
            'hot_deals' => $request->input('hot_deals')|false,
            'featured' => $request->input('featured')|false,
            'new_arrival' => $request->input('new_arrival')|false,
            'special_offer' => $request->input('special_offer')|false,
            'special_deals' => $request->input('special_deals')|false,
            'status' => $request->input('status')|false
            ]);

            if($request->file('product_thumbnail')){
                // if($product->product_thumbnail !='thumbnail.jpg'){
                //     unlink($product->product_thumbnail);
                // }
                $upload_location = 'upload/products/thumbnail/';
                $file = $request->file('product_thumbnail');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(600,600)->save($upload_location.$name_gen);
                $save_url = $upload_location.$name_gen;
                
                $product->update([
                    'product_thumbnail' => $save_url,
                ]);
            }

            if($request->file('product_images'))
            {
                $images = $request->file('product_images');
                foreach ($images as $single_image) {
                    $upload_location = 'upload/products/multi_images/';
                    $name_gen = hexdec(uniqid()).'.'.$single_image->getClientOriginalExtension();
                    Image::make($single_image)->resize(600,600)->save($upload_location.$name_gen);
                    $save_url = $upload_location.$name_gen;
                    ModelsImage::create([
                        'product_id' => $product->id,
                        'photo_name' => $save_url,
                    ]);
                }
            }

        $notification = [
            'message' => 'Product Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }
        
        // 'product_thumbnail' => 'required|mimes:png,jpg',
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['brand', 'category', 'subcategory', 'subsubcategory', 'images'])->findOrFail($id);
        return $product;
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
    public function update(Request $request, $id)
    {
        //
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
