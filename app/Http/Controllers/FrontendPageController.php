<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendPageController extends Controller
{
    public function home()
    {
        return view('frontend.index');
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
