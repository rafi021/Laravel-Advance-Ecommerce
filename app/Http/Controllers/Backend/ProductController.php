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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{

    protected $brands;
    protected $categories;
    protected $subcategories;
    protected $subsubcategories;

    public function __construct()
    {
        $this->brands = Brand::latest()->get();
        $this->categories = Category::latest()->get();
        $this->subcategories = SubCategory::latest()->get();
        $this->subsubcategories = SubSubCategory::latest()->get();
        view()->share([
            'brands' => $this->brands,
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'subsubcategories' => $this->subsubcategories,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['brand', 'category', 'subcategory', 'subsubcategory', 'images'])->latest()->get();
        return view('admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = $this->brands;
        $categories = $this->categories;
        $subcategories = $this->subcategories;
        $subsubcategories = $this->subsubcategories;
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
        $product = new Product();
        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->sub_subcategory_id = $request->input('sub_subcategory_id');
        $product->product_name_en = $request->input('product_name_en');
        $product->product_name_bn = $request->input('product_name_bn');
        $product->product_slug_en = Str::slug($request->input('product_name_en'));
        $product->product_slug_bn = Str::slug($request->input('product_name_bn'));
        $product->product_code = $request->input('product_code');
        $product->product_qty = $request->input('product_qty');
        $product->product_tags_en = $request->input('product_tags_en');
        $product->product_tags_bn = $request->input('product_tags_bn');
        $product->product_size_en = $request->input('product_size_en');
        $product->product_size_bn = $request->input('product_size_bn');
        $product->product_color_en = $request->input('product_color_en');
        $product->product_color_bn = $request->input('product_color_bn');
        $product->purchase_price = $request->input('purchase_price');
        $product->selling_price = $request->input('selling_price');
        $product->discount_price = $request->input('discount_price');
        $product->short_description_en = $request->input('short_description_en');
        $product->short_description_bn = $request->input('short_description_bn');
        $product->ong_description_en = $request->input('long_description_en');
        $product->long_description_bn = $request->input('long_description_bn');
        $product->hot_deals = $request->input('hot_deals') | false;
        $product->featured = $request->input('featured') | false;
        $product->new_arrival = $request->input('new_arrival') | false;
        $product->special_offer = $request->input('special_offer') | false;
        $product->special_deals = $request->input('special_deals') | false;
        $product->status = $request->input('status') | false;

        if ($request->file('product_thumbnail')) {
            $upload_location = 'upload/products/thumbnail/';
            $file = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(600, 600)->save($upload_location . $name_gen);
            $save_url = $upload_location . $name_gen;
            $product->product_thumbnail = $save_url;
        }
        $product->save();

        if ($request->file('product_images')) {
            $images = $request->file('product_images');
            foreach ($images as $single_image) {
                $upload_location = 'upload/products/multi_images/';
                $name_gen = hexdec(uniqid()) . '.' . $single_image->getClientOriginalExtension();
                Image::make($single_image)->resize(600, 600)->save($upload_location . $name_gen);
                $save_url = $upload_location . $name_gen;
                ModelsImage::create([
                    'product_id' => $product->id,
                    'photo_name' => $save_url,
                ]);
            }
        }

        return redirect()->route('products.index')->with([
            'message' => 'Product Created Successfully!!!',
            'alert-type' => 'success'
        ]);
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
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = $this->brands;
        $categories = $this->categories;
        $subcategories = $this->subcategories;
        $subsubcategories = $this->subsubcategories;
        $product = Product::with(['brand', 'category', 'subcategory', 'subsubcategory', 'images'])->findOrFail($id);
        return view('admin.Product.edit', compact('product', 'brands', 'categories', 'subcategories', 'subsubcategories'));
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
        $product = Product::findOrFail($id);
        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->sub_subcategory_id = $request->input('sub_subcategory_id');
        $product->product_name_en = $request->input('product_name_en');
        $product->product_name_bn = $request->input('product_name_bn');
        $product->product_slug_en = Str::slug($request->input('product_name_en'));
        $product->product_slug_bn = Str::slug($request->input('product_name_bn'));
        $product->product_code = $request->input('product_code');
        $product->product_qty = $request->input('product_qty');
        $product->product_tags_en = $request->input('product_tags_en');
        $product->product_tags_bn = $request->input('product_tags_bn');
        $product->product_size_en = $request->input('product_size_en');
        $product->product_size_bn = $request->input('product_size_bn');
        $product->product_color_en = $request->input('product_color_en');
        $product->product_color_bn = $request->input('product_color_bn');
        $product->purchase_price = $request->input('purchase_price');
        $product->selling_price = $request->input('selling_price');
        $product->discount_price = $request->input('discount_price');
        $product->short_description_en = $request->input('short_description_en');
        $product->short_description_bn = $request->input('short_description_bn');
        $product->long_description_en = $request->input('long_description_en');
        $product->long_description_bn = $request->input('long_description_bn');
        $product->hot_deals = $request->input('hot_deals') | false;
        $product->featured = $request->input('featured') | false;
        $product->new_arrival = $request->input('new_arrival') | false;
        $product->special_offer = $request->input('special_offer') | false;
        $product->special_deals = $request->input('special_deals') | false;
        $product->status = $request->input('status') | false;


        if ($request->file('product_thumbnail')) {
            // if($product->product_thumbnail !='thumbnail.jpg'){
            //     unlink($product->product_thumbnail);
            // }
            $upload_location = 'upload/products/thumbnail/';
            $file = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(600, 600)->save($upload_location . $name_gen);
            $save_url = $upload_location . $name_gen;

            // $product->update([
            //     'product_thumbnail' => $save_url,
            // ]);
            $product->product_thumbnail = $save_url;
        }
        $product->save();

        // if($request->file('product_images'))
        // {
        //     $product_images = ModelsImage::where('product_id', '=',$product->id)->get();
        //     foreach ($product_images as $value) {
        //             unlink($value->photo_name);
        //     }
        //     $images = $request->file('product_images');
        //     foreach ($images as $single_image) {
        //         $upload_location = 'upload/products/multi_images/';
        //         $name_gen = hexdec(uniqid()).'.'.$single_image->getClientOriginalExtension();
        //         Image::make($single_image)->resize(600,600)->save($upload_location.$name_gen);
        //         $save_url = $upload_location.$name_gen;
        //         ModelsImage::create([
        //             'product_id' => $product->id,
        //             'photo_name' => $save_url,
        //         ]);
        //     }
        // }

        return redirect()->route('products.index')->with([
            'message' => 'Product Updated Successfully!!!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_thumbnail != 'thumbnail.jpg') {
            unlink($product->product_thumbnail);
        }
        $product_images = ModelsImage::where('product_id', '=', $product->id)->get();
        foreach ($product_images as $value) {
            unlink($value->photo_name);
            $value->delete();
        }
        $product->delete();

        return redirect()->route('products.index')->with([
            'message' => 'Product Deleted Successfully!!!',
            'alert-type' => 'success'
        ]);
    }

    public function MultiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = ModelsImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $upload_location = 'upload/products/multi_images/';
            Image::make($img)->resize(600, 600)->save($upload_location . $make_name);
            $uploadPath = $upload_location . $make_name;

            ModelsImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);
        } // end foreach

        $notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function changeStatus(Request $request)
    {
        //dd($request->all());
        $product = Product::findOrFail($request->product_id);
        $product->status = $request->status;
        $product->save();

        return response()->json(['success' => 'Product status change successfully.']);
    }
}
