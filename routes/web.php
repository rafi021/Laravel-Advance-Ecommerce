<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
Route::group(['controller' => FrontendPageController::class],function(){
    Route::get('/', 'home')->name('home');
    Route::get('/category', 'category')->name('category');
    Route::get('/product/detail/{id}/{slug}', 'productDeatil')->name('frontend-product-details');
    // Tags wise products route
    Route::get('/product/tag/{tag}', 'tagwiseProduct')->name('product.tag');
    //subcategory wise products route
    Route::get('/subcategory/{id}/{slug}','subcategoryProducts')->name('subcategory.products');
    //subsubcategory wise products route
    Route::get('/subsubcategory/{id}/{slug}','subsubcategoryProducts')->name('subsubcategory.products');
    // AJAX Product data route
    Route::get('/product/view/modal/{id}','productviewAjax')->name('productModalview');
});

Route::get('/english/language', [LanguageController::class, 'englishLoad'])->name('english.language');
Route::get('/bangla/language', [LanguageController::class, 'banglaLoad'])->name('bangla.language');


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
Route::group(['controller'=>CartPageController::class],function(){
    Route::get('/my-cart','myCartView')->name('myCartView');
    Route::get('/my-cart/list','showmyCartList')->name('showmyCartList');
    Route::get('/remove/from-cart/{rowId}','removeFromCart')->name('removeFromCart');
    Route::get('/add/in-cart/{rowId}','addQtyToCart')->name('addQtyToCart');
    Route::get('/reduce/from-cart/{rowId}','reduceQtyFromCart')->name('reduceQtyFromCart');
    //Frontend apply Coupon routes
    Route::post('/coupon/apply/','applyCoupon')->name('applyCoupon');
    Route::get('/coupon-calculation','couponCalculation')->name('couponCalculation');
    Route::get('/coupon-remove','couponRemove')->name('couponRemove');
});

// Checkout Page routes
Route::group(['controller'=>CheckoutController::class],function(){
    Route::get('/checkout-page','checkoutPage')->name('checkout-page');
    Route::get('/division/district/ajax/{division_id}', 'getDistrict');
    Route::get('/district/state/ajax/{district_id}', 'getState');
    Route::post('/checkout-store', 'checkoutStore')->name('checkout.store');
    
});

// Admin Login routes
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/1wire_rty/login',[AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){

    // Admin Logout/password change and profile routes
    Route::get('/admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');
    Route::group(['prefix'=>'admin','controller'=>AdminProfileController::class],function () {
        Route::get('/edit/profile', 'AdminProfileEdit')->name('admin.profile.edit');
        Route::get('/change/password', 'AdminPasswordChange')->name('admin.change.password');
        Route::post('/change/password', 'AdminPasswordUpdate')->name('admin.password.update');
    });



    // Admin Dashboard routes
 Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // Admin Dashboard all functionality/features routes
Route::prefix('admin')->group(function(){
    Route::resources([
        'brands'=>BrandController::class,
        'categories'=>CategoryController::class,
        'subcategories'=> SubCategoryController::class,
        'subsubcategories'=> SubSubCategoryController::class,
         // shipping routes
        'division'=> ShippingAreaController::class,
        'district'=> ShippingDistrictController::class,
        'state'=> ShippingStateController::class,
        // admin resource
        'slider'=> AdminSliderController::class,
        // product resource
        'products'=> ProductController::class,
        // order resource
        'orders'=> OrderController::class,
        // cupons resource
        'coupons'=> CouponController::class,
        // admin profile resource
        'profile'=> AdminProfileController::class,
    ]);
});
    Route::group(['prefix'=>'admin/orders','controller'=>OrderController::class],function(){
        Route::get('pending/index',  'pendingOrderIndex')->name('pending.orders');
        Route::get('confirmed/index',  'confirmedOrderIndex')->name('confirmed.orders');
        Route::get('processing/index',  'processingOrderIndex')->name('processing.orders');
        Route::get('picked/index',  'pickedOrderIndex')->name('picked.orders');
        Route::get('shipped/index',  'shippedOrderIndex')->name('shipped.orders');
        Route::get('delivered/index',  'deliveredOrderIndex')->name('delivered.orders');
        Route::get('cancel/index',  'cancelOrderIndex')->name('cancel.orders');
        Route::get('return/index',  'returnOrderIndex')->name('return.orders');
    });

Route::prefix('/admin')->group(function(){
        Route::get('/category/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'getSubCategory']);
        Route::get('/category/subsubcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'getSubSubCategory']);
        // update multi-image route
        Route::post('/products/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
        Route::get('/changestatus', [ProductController::class, 'changeStatus'])->name('change-product-status');

        // slider routes
        Route::get('/changesliderstatus', [AdminSliderController::class, 'changeSliderStatus'])->name('change-product-status');

        // coupon routes
  
        Route::get('/change/coupon/status', [CouponController::class, 'changeCouponStatus'])->name('change-coupon-status');

        Route::get('/division/district/ajax/{division_id}', [ShippingStateController::class, 'getDistrict']);
        Route::get('/district/state/ajax/{district_id}', [ShippingStateController::class, 'getState']);
        // Orders routes
       
        Route::get('/orders/status/update/{order_id}/{status}', [OrderController::class, 'orderStatusUpdate'])->name('order-status.update');
        // Download Invoice route - admin
        Route::get('/invoice-download/{order_id}', [OrderController::class, 'adminInvoiceDownload'])->name('admin-invoice-download');
    });
});