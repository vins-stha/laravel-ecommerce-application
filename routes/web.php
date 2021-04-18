<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\FrontendController;

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


Route::get('/', [FrontendController::class, 'index']);
Route::get('/category/{id}', [FrontendController::class, 'categoryView']);
Route::get('/single-product/{id}', [FrontendController::class, 'productView']);
Route::post('/addToCart', [FrontendController::class, 'addToCart']);//->name('frontend.addToCart');
Route::get('/my-cart', [FrontendController::class, 'myCart']);
Route::post('/search', [FrontendController::class, 'search']);
Route::get('/search', [FrontendController::class, 'search']);





Route::get('/admin', [AdministratorController::class, 'index']);

Route::post('/admin', [AdministratorController::class, 'authenticate'])->name('administrator.authenticate');

Route::group(['middleware' => 'admin_auth'], function () {

    Route::get('/admin/dashboard', [AdministratorController::class, 'dashboard']);
    Route::get('admin/logout', [AdministratorController::class, 'logout']);

    /***** Routes for Product-category management ******/

    Route::get('/admin/product-category', [ProductCategoryController::class, 'index']);

    Route::get('/admin/product-category/add', [ProductCategoryController::class, 'addCategory']);
    Route::post('/admin/product-category/add', [ProductCategoryController::class, 'addCategory'])->name('productcategory.addCategory');

    Route::get('/admin/product-category/edit/{id}', [ProductCategoryController::class, 'editCategory']);
    Route::post('/admin/product-category/update/', [ProductCategoryController::class, 'editCategory'])->name('productcategory.editCategory');

    Route::get('/admin/product-category/delete/{id}', [ProductCategoryController::class, 'deleteCategory']);

    /***** Routes for coupon management ******/

    Route::get('/admin/coupon', [CouponController::class, 'index']);

    Route::get('/admin/coupon/add', [CouponController::class, 'addCoupon']);
    Route::post('/admin/coupon/add', [CouponController::class, 'addCoupon'])->name('coupon.addCoupon');

    Route::get('/admin/coupon/edit/{id}', [CouponController::class, 'editCoupon']);
    Route::post('/admin/coupon/update/', [CouponController::class, 'editCoupon'])->name('coupon.editCoupon');

    Route::get('/admin/coupon/delete/{id}', [CouponController::class, 'deleteCoupon']);


    /***** Routes for product management ******/

    Route::get('/admin/product', [ProductController::class, 'index']);

    Route::get('/admin/product/add', [ProductController::class, 'addProduct']);
   // Route::get('/admin/product/add', [ProductController::class, 'addOrEdit']);
    Route::post('/admin/product/add', [ProductController::class, 'addProduct'])->name('product.addProduct');

    Route::get('/admin/product/edit/{id}', [ProductController::class, 'editProduct']);
   // Route::get('/admin/product/edit/{id}', [ProductController::class, 'addOrEdit']);

    Route::post('/admin/product/update/', [ProductController::class, 'editProduct'])->name('product.editProduct');

    Route::get('/admin/product/delete/{id}', [ProductController::class, 'deleteProduct']);

    /***** Routes for Brand management ******/

    Route::get('/admin/brand', [ProductBrandController::class, 'index']);

    Route::get('/admin/brand/add', [ProductController::class, 'addBrand']);
    Route::post('/admin/brand/add', [ProductController::class, 'addBrand'])->name('productBrand.addBrand');

    Route::get('/admin/brand/edit/{id}', [ProductController::class, 'editBrand']);
    Route::post('/admin/brand/update/', [ProductController::class, 'editBrand'])->name('productBrand.editBrand');

    Route::get('/admin/brand/delete/{id}', [ProductController::class, 'deleteBrand']);

    /***** Routes for Color management ******/

    Route::get('/admin/colors', [ColorController::class, 'index']);

    Route::get('/admin/colors/add', [ColorController::class, 'addColor']);
    Route::post('/admin/colors/add', [ColorController::class, 'addColor'])->name('color.addColor');

    Route::get('/admin/colors/edit/{id}', [ColorController::class, 'editColor']);
    Route::post('/admin/colors/update/', [ColorController::class, 'editColor'])->name('color.editColor');

    Route::get('/admin/colors/delete/{id}', [ColorController::class, 'deleteColor']);


    /***** Routes for sizes management ******/

    Route::get('/admin/sizes', [SizeController::class, 'index']);

    Route::get('/admin/sizes/add', [SizeController::class, 'addSize']);
    Route::post('/admin/sizes/add', [SizeController::class, 'addSize'])->name('size.addSize');

    Route::get('/admin/sizes/edit/{id}', [SizeController::class, 'editSize']);
    Route::post('/admin/sizes/update/', [SizeController::class, 'editSize'])->name('size.editSize');

    Route::get('/admin/sizes/delete/{id}', [SizeController::class, 'deleteSize']);

    /***** Routes for Brand management ******/

    Route::get('/admin/brands', [ProductBrandController::class, 'index']);

    Route::get('/admin/brands/add', [ProductBrandController::class, 'addBrand']);
    Route::post('/admin/brands/add', [ProductBrandController::class, 'addBrand'])->name('brands.addBrands');

    Route::get('/admin/brands/edit/{id}', [ProductBrandController::class, 'editBrand']);
    Route::post('/admin/brands/update/', [ProductBrandController::class, 'editBrand'])->name('brands.editBrand');

    Route::get('/admin/brands/delete/{id}', [ProductBrandController::class, 'deleteBrand']);




});


