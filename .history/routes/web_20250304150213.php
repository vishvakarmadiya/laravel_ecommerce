<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgaetPasswordController;
use App\Http\Controllers\ForntendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazopayController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserDiatilsController;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;


Route::get('/', function () {
    return view('welcome');
});


Route::get('index', [AdminController::class, 'index_login'])->name('index_login');
Route::get('add-product', [ProductController::class, 'prodcutAdd'])->name('productAdd');
Route::post('product-store', [ProductController::class, 'productstore'])->name('productstore');
Route::get('manage-product', [ProductController::class, 'productManage'])->name('productManage');
Route::delete('product_delete/{id}', action: [ProductController::class, 'product_delete'])->name('product_delete');
Route::get('{data}productEdit', [ProductController::class, 'productEdit'])->name('productEdit');
Route::put('/productupdate{id}', [ProductController::class, 'productupdate'])->name('productupdate');

Route::get('category-add', [CategoryController::class, 'categoryAdd'])->name('categoryAdd');
Route::post('category-store', [CategoryController::class, 'categoryStore'])->name('categoryStore');
Route::get('category-manage', [CategoryController::class, 'categoryManage'])->name('categoryManage');
Route::get('{data}categoryEdit', [CategoryController::class, 'categoryEdit'])->name('categoryEdit');
Route::delete('catagoryDelete/{id}', [CategoryController::class, 'catagoryDelete'])->name('destroy');
Route::put('/updatecategory/{id}', [CategoryController::class, 'updatecategory'])->name('updatecategory');

Route::get('sub-category-add', [SubcategoryController::class, 'subCategoryAdd'])->name('subCategoryAdd');
Route::post('store', action: [SubcategoryController::class, 'subcategoryStore'])->name('subcategoryStore');
Route::get('sub-category-manage', [SubcategoryController::class, 'subCategoryManage'])->name('subCategoryManage');
Route::get('{data}subcategoryupdate', [SubcategoryController::class, 'subcategoryEdit'])->name('subcategoryEdit');
Route::put('/subcategoryupdate{id}', [SubcategoryController::class, 'SubCategoryUpdate'])->name('SubCategoryUpdate');
Route::delete('/subcategory/{id}', [SubCategoryController::class, 'sub_category_destroy'])->name('sub_category_destroy');

Route::get('brand-add', [BrandController::class, 'brandAdd'])->name('brandAdd');
Route::get('brand-manage', [BrandController::class, 'brandManage'])->name('brandManage');
Route::post('bradstore', action: [BrandController::class, 'bradstore'])->name('bradstore');
Route::get('{data}brandEdit', [BrandController::class, 'brandEdit'])->name('brandEdit');
Route::put('/brand_update{id}', [BrandController::class, 'brand_update'])->name('brand_update');
Route::delete('/brand/{id}', [BrandController::class, 'brand_delete'])->name('brand_delete');

Route::get('slider-add', [SliderController::class, 'sliderAdd'])->name('sliderAdd');
Route::get('slider-manage', [SliderController::class, 'sliderManage'])->name('sliderManage');
Route::post('sliderstore', [SliderController::class, 'sliderstore'])->name('sliderstore');
Route::get('index', [AdminController::class, 'index_login'])->name('admin.index');


// Guest Routes - Grouped under admin.guest middleware

Route::get('/', [ForntendController::class, 'index'])->name('index');
Route::get('/kittu', [ForntendController::class, 'index'])->name('index');
Route::get('resiter', [AdminLoginController::class, 'resitorShow'])->name('admin.register');
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

Route::post('admin/logout', [AdminLoginController::class, 'adminLogout'])->name('adminLogout');


Route::post('/admin/login', [AdminLoginController::class, 'Admil_login'])->name('Admil_login');
Route::post('/admin/resiter', [AdminLoginController::class, 'Admin_store'])->name('Admin_store');
Route::get('kittusweety', [ForntendController::class, 'index'])->name('index');
Route::get('Kittu/{categoryName?}', [ForntendController::class, 'products_listing'])->name('products_listing');
Route::get('ditilails/{productName?}', [ForntendController::class, 'product_ditails'])->name('product_ditails');
Route::get('kittu/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('kittu/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('kittu', [ProfileController::class, 'profile_logout'])->name('logout');
Route::post('/cart/add', [CartController::class, 'addcart'])->name('addcart');
Route::get('/cart/add/show', [CartController::class, 'addcartshow'])->name('addcartshow');
Route::get('kittu/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::put('/cart_update/{id}', [CartController::class, 'cart_update'])->name('cart_update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/order/store', [OrderController::class, 'order_store'])->name('order_store');

Route::get('/order/clear/{payment_id}', [OrderController::class, 'cartClear'])->name('cartClear');
Route::get('/shipingAdrass', [CheckoutController::class, 'shipingAddrase'])->name('shipingAddrase');
Route::post('/pament', [CheckoutController::class, 'orderAddress'])->name('orderAddress');
Route::get('/order/success', function () {
    return view('order.success');
})->name('order.success');

Route::get('user/Acount-update', [OrderController::class, 'updateAccount'])->name('updateAccount');
Route::get('admin/order', [OrderController::class, 'orderindex'])->name('orderindex');
Route::post('kittu/orders/peyment', [OrderController::class, 'verifyPayment'])->name('razorpay.verify');
Route::get('admin/user', [UserDiatilsController::class, 'userDiatils'])->name('userDiatils');
Route::put('/order/status/update/{orderid}', [OrderController::class, 'updateStatus'])->name('order_status_update');


Route::get('/forgot-password', [ForgaetPasswordController ::class, 'forgetPasswordShow'])->name('forgetPasswordShow');
Route::post('/forgot-password', [ForgaetPasswordController ::class, 'forgetPassword'])->name('forgetPassword');
Route::get('/reset-password', [ForgaetPasswordController ::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgaetPasswordController ::class, 'resetPassword'])->name('resetPassword');

Route::get('/search', [ProductController::class, 'search'])->name('product.search');
