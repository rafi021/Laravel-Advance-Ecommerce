<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\FrontendPageController;
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



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
