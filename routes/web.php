<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminSliderController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CODController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\ShippingDistrictController;
use App\Http\Controllers\Backend\ShippingStateController;
use App\Http\Controllers\Backend\StripeController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CartPageController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendPageController;
use App\Http\Controllers\Frontend\FrontendUserProfileController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\User\OrderDetailsController;
use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\User\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Frontend customer/user logout, profile, change password routes


Route::middleware(['auth:web'])->group(function(){

    Route::middleware(['auth:sanctum, web', 'verified'])->get('/dashboard',[FrontendUserProfileController::class, 'userdashboard'])->name('dashboard');

    Route::prefix('/user')->group(function () {
        Route::get('/logout', [FrontendUserProfileController::class, 'userlogout'])->name('user.logout');
        Route::get('/profile', [FrontendUserProfileController::class, 'userprofile'])->name('user.profile');
        Route::post('/profile', [FrontendUserProfileController::class, 'userprofileupdate'])->name('user.profile');
        Route::get('/password/change', [FrontendUserProfileController::class, 'userpasswordchange'])->name('user.change.password');
        Route::post('/password/update', [FrontendUserProfileController::class, 'userpasswordupdate'])->name('user.update.password');

        // user order history
        Route::get('/orders/history', [OrderHistoryController::class, 'orderHistory'])->name('user.orders');
    });
});

// Frontend Pages routes
Route::get('/', [FrontendPageController::class,'home'])->name('home');
Route::get('/category', [FrontendPageController::class,'category'])->name('category');

Route::get('/product/detail/{id}/{slug}', [FrontendPageController::class,'productDeatil'])->name('frontend-product-details');
Route::get('/english/language', [LanguageController::class, 'englishLoad'])->name('english.language');
Route::get('/bangla/language', [LanguageController::class, 'banglaLoad'])->name('bangla.language');

// Tags wise products route
Route::get('/product/tag/{tag}', [FrontendPageController::class, 'tagwiseProduct'])->name('product.tag');
//subcategory wise products route
Route::get('/subcategory/{id}/{slug}', [FrontendPageController::class,'subcategoryProducts'])->name('subcategory.products');
//subsubcategory wise products route
Route::get('/subsubcategory/{id}/{slug}', [FrontendPageController::class,'subsubcategoryProducts'])->name('subsubcategory.products');
// AJAX Product data route
Route::get('/product/view/modal/{id}',[FrontendPageController::class,'productviewAjax'])->name('productModalview');

// Cart routes
// Add to cart Product route
Route::post('/cart/data/store/{id}', [CartController::class,'addToCart'])->name('productaddToCart');
// mini cart product data get route
Route::get('/product/mini/cart', [CartController::class,'getMiniCart'])->name('getMiniCartProduct');
// remove item from mini cart route
Route::get('/minicart/product-remove/{rowId}', [CartController::class,'removeMiniCart'])->name('removeMiniCartProduct');

//Wishlist routes
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user'], 'namespace' => 'User'], function()
{
    // add to wishlist route
    Route::post('/add/product/to-wishlist/{product_id}',[WishlistController::class,'addToWishlist'])->name('addtoWishlist');
    // list wishlist route
    Route::get('/list/wishlists', [WishlistController::class,'listWishList'])->name('listWishlist');
    // remove from wishlist
    Route::get('/remove/from-wishlist/{wish_id}', [WishlistController::class,'removefromWishList'])->name('removefromWishList');

    //stripe payment route
    Route::post('/stripe/v1/payment', [StripeController::class,'stripeOrder'])->name('stripe.order');

    // User order deatils route
    Route::get('/order-details/{order_id}', [OrderDetailsController::class, 'userOrderDetails'])->name('order-deatils');
    // Download Invoice - user route
    Route::get('/invoice-download/{order_id}', [OrderDetailsController::class, 'userInvoiceDownload'])->name('invoice-download');
    // Return order route
    Route::post('/return/order/{order_id}', [OrderDetailsController::class, 'returnOrder'])->name('return.order');
    // Return Order list route
    Route::get('/return/orders/list', [OrderDetailsController::class, 'returnOrderList'])->name('user.return-orders');
    // Cancel order list route
    Route::get('/cancel/orders/list', [OrderDetailsController::class, 'cancelOrderList'])->name('user.cancel-orders');

    // Cash on Delivery route
    Route::post('/cod/v1/payment', [CODController::class, 'codOrder'])->name('cod.order');
});

// Cart page routes
Route::get('/my-cart',[CartPageController::class,'myCartView'])->name('myCartView');
Route::get('/my-cart/list',[CartPageController::class,'showmyCartList'])->name('showmyCartList');
Route::get('/remove/from-cart/{rowId}',[CartPageController::class,'removeFromCart'])->name('removeFromCart');
Route::get('/add/in-cart/{rowId}',[CartPageController::class,'addQtyToCart'])->name('addQtyToCart');
Route::get('/reduce/from-cart/{rowId}',[CartPageController::class,'reduceQtyFromCart'])->name('reduceQtyFromCart');

//Frontend apply Coupon routes
Route::post('/coupon/apply/',[CartPageController::class,'applyCoupon'])->name('applyCoupon');
Route::get('/coupon-calculation',[CartPageController::class,'couponCalculation'])->name('couponCalculation');
Route::get('/coupon-remove',[CartPageController::class,'couponRemove'])->name('couponRemove');

// Checkout Page routes
Route::get('/checkout-page',[CheckoutController::class,'checkoutPage'])->name('checkout-page');
Route::get('/division/district/ajax/{division_id}', [CheckoutController::class, 'getDistrict']);
Route::get('/district/state/ajax/{district_id}', [CheckoutController::class, 'getState']);
Route::post('/checkout-store',[CheckoutController::class, 'checkoutStore'])->name('checkout.store');








// Admin Login routes
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/1wire_rty/login',[AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){

    // Admin Logout/password change and profile routes
    Route::prefix('/admin')->group(function () {
        Route::get('/logout',[AdminController::class, 'destroy'])->name('admin.logout');
        Route::resource('/profile', AdminProfileController::class);
        Route::get('/edit/profile',[AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
        Route::get('/change/password',[AdminProfileController::class, 'AdminPasswordChange'])->name('admin.change.password');
        Route::post('/change/password',[AdminProfileController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    });

    // Admin Dashboard routes
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // Admin Dashboard all functionality/features routes
    Route::prefix('/admin')->group(function(){
        Route::resource('/brands',BrandController::class);
        Route::resource('/categories',CategoryController::class);
        Route::resource('/subcategories', SubCategoryController::class);
        Route::resource('/subsubcategories', SubSubCategoryController::class);

        Route::get('/category/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'getSubCategory']);
        Route::get('/category/subsubcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'getSubSubCategory']);

        // update multi-image route
        Route::post('/products/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
        Route::resource('/products', ProductController::class);
        Route::get('/changestatus', [ProductController::class, 'changeStatus'])->name('change-product-status');

        // slider routes
        Route::resource('/slider', AdminSliderController::class);
        Route::get('/changesliderstatus', [AdminSliderController::class, 'changeSliderStatus'])->name('change-product-status');

        // coupon routes
        Route::resource('/coupons', CouponController::class);
        Route::get('/change/coupon/status', [CouponController::class, 'changeCouponStatus'])->name('change-coupon-status');

        // shipping routes
        Route::resource('/division', ShippingAreaController::class);
        Route::resource('/district', ShippingDistrictController::class);
        Route::resource('/state', ShippingStateController::class);

        Route::get('/division/district/ajax/{division_id}', [ShippingStateController::class, 'getDistrict']);
        Route::get('/district/state/ajax/{district_id}', [ShippingStateController::class, 'getState']);


        // Orders routes
        Route::resource('/orders', OrderController::class);
        Route::get('/orders/pending/index', [OrderController::class, 'pendingOrderIndex'])->name('pending.orders');
        Route::get('/orders/confirmed/index', [OrderController::class, 'confirmedOrderIndex'])->name('confirmed.orders');
        Route::get('/orders/processing/index', [OrderController::class, 'processingOrderIndex'])->name('processing.orders');
        Route::get('/orders/picked/index', [OrderController::class, 'pickedOrderIndex'])->name('picked.orders');
        Route::get('/orders/shipped/index', [OrderController::class, 'shippedOrderIndex'])->name('shipped.orders');
        Route::get('/orders/delivered/index', [OrderController::class, 'deliveredOrderIndex'])->name('delivered.orders');
        Route::get('/orders/cancel/index', [OrderController::class, 'cancelOrderIndex'])->name('cancel.orders');
        Route::get('/orders/return/index', [OrderController::class, 'returnOrderIndex'])->name('return.orders');

        Route::get('/orders/status/update/{order_id}/{status}', [OrderController::class, 'orderStatusUpdate'])->name('order-status.update');
        // Download Invoice route - admin
        Route::get('/invoice-download/{order_id}', [OrderController::class, 'adminInvoiceDownload'])->name('admin-invoice-download');
    });
});
