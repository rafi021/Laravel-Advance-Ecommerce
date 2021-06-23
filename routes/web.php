<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Frontend\FrontendPageController;
use App\Http\Controllers\Frontend\FrontendUserProfileController;
use App\Models\Admin;

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

Route::get('/', [FrontendPageController::class,'home'])->name('home');
Route::get('/category', [FrontendPageController::class,'category'])->name('category');
Route::get('/product-detail', [FrontendPageController::class,'productDeatil'])->name('product-detail');


Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login',[AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/logout',[AdminController::class, 'destroy'])->name('admin.logout');
    Route::resource('/profile', AdminProfileController::class);
    Route::get('/edit/profile',[AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::get('/change/password',[AdminProfileController::class, 'AdminPasswordChange'])->name('admin.change.password');
    Route::post('/change/password',[AdminProfileController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});


Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    //$adminData = Admin::find(1);
    return view('admin.index');
})->name('admin.dashboard');



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard',[FrontendUserProfileController::class, 'userdashboard'])->name('dashboard');

// Route::prefix('/user')->middleware(['auth:sanctum,web', 'verified'])->group(function () {
//     Route::get('/dashboard', [FrontendUserProfileController::class, 'userdashboard'])->name('dashboard');
// });

Route::prefix('/user')->group(function () {
    Route::get('/logout', [FrontendUserProfileController::class, 'userlogout'])->name('user.logout');
    Route::get('/profile', [FrontendUserProfileController::class, 'userprofile'])->name('user.profile');
    Route::post('/profile', [FrontendUserProfileController::class, 'userprofileupdate'])->name('user.profile');
    Route::get('/password/change', [FrontendUserProfileController::class, 'userpasswordchange'])->name('user.change.password');
    Route::post('/password/update', [FrontendUserProfileController::class, 'userpasswordupdate'])->name('user.update.password');
});

// Brand all routes
Route::prefix('/admin')->middleware(['auth:sanctum,admin', 'verified'])->group(function(){
    Route::resource('/brands',BrandController::class);
    Route::resource('/categories',CategoryController::class);
    Route::resource('/subcategories', SubCategoryController::class);
    Route::resource('/subsubcategories', SubSubCategoryController::class);
    Route::get('/category/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'getSubCategory']);
    Route::get('/category/subsubcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'getSubSubCategory']);
    Route::resource('/products', ProductController::class);
    // update multi-image route
    Route::post('/products/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
});
Route::get('/changestatus', [ProductController::class, 'changeStatus'])->name('change-product-status');
