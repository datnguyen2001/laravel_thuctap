<?php

use Illuminate\Support\Facades\Route;

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


//product route

Route::get('/','HomeController@index')->name('index');

Route::get('/product','PagesController@product')->name('product');

Route::get('/product/{slug}','PagesController@product_show')->name('product.show');

Route::get('/search','PagesController@product_search')->name('product.search');


                //category show route
Route::get('/product/sub_category/{id}','PagesController@product_sub_category_show')->name('product.sub_category.show');

              //add cart route

Route::get('/product/cart/show','PagesController@product_cart_show')->name('product.cart.show');

Route::post('/product/cart/store','PagesController@product_cart_store')->name('product.cart.store');

Route::post('/product/cart/update/{id}','PagesController@product_cart_update')->name('product.cart.update');

Route::get('/product/cart/delete/{id}','PagesController@product_cart_delete')->name('product.cart.delete');


        // cart checkout route

Route::get('/product/cart/checkout','PagesController@product_cart_checkout')->name('product.cart.checkout');

Route::post('/product/cart/checkout/store','PagesController@product_cart_checkout_store')->name('product.cart.checkout.store');








//contact route

Route::get('/contact','PagesController@contact')->name('contact');






//User route

Route::get('/user/token/{token}','UserVerificationController@verify')->name('user.verification');

Route::get('/user/dashboard','UserController@user_dashboard')->name('user.dashboard');

Route::get('/user/profile','UserController@user_profile')->name('user.profile');

Route::post('/user/update/profile','UserController@update_profile')->name('user.update.profile');






//admin product route


Route::get('/admin/product/create','AdminProductController@create')->name('admin.product.create');

Route::post('/admin/product/store','AdminProductController@store')->name('admin.product.store');

Route::post('/admin/product/update/{id}','AdminProductController@update_product')->name('admin.product.update');

Route::get('/admin/product','AdminProductController@manage_product')->name('admin.product');

Route::get('/admin/product/edit/{id}','AdminProductController@product_edit')->name('admin.product.edit');

Route::get('/admin/product/delete/{id}','AdminProductController@product_delete')->name('admin.product.delete');



//admin category route

Route::get('/admin/category','AdminCategoryController@manage_category')->name('admin.category');

Route::get('/admin/category/create','AdminCategoryController@create_category')->name('admin.category.create');

Route::post('/admin/category/store','AdminCategoryController@category_store')->name('admin.category.store');

Route::get('/admin/category/edit/{id}','AdminCategoryController@category_edit')->name('admin.category.edit');

Route::post('/admin/category/update/{id}','AdminCategoryController@category_update')->name('admin.category.update');

Route::get('/admin/category/delete/{id}','AdminCategoryController@category_delete')->name('admin.category.delete');




//Admin Brand  route

Route::get('/admin/brand','AdminBrandController@manage_brand')->name('admin.brand');

Route::get('/admin/brand/create','AdminBrandController@create_brand')->name('admin.brand.create');

Route::post('/admin/brand/store','AdminBrandController@brand_store')->name('admin.brand.store');

Route::get('/admin/brand/edit/{id}','AdminBrandController@brand_edit')->name('admin.brand.edit');

Route::post('/admin/brand/update/{id}','AdminBrandController@brand_update')->name('admin.brand.update');

Route::get('/admin/brand/delete/{id}','AdminBrandController@brand_delete')->name('admin.brand.delete');




//Admin Division route

Route::get('/admin/division','AdminDivisionController@manage_division')->name('admin.division');

Route::get('/admin/division/create','AdminDivisionController@create_division')->name('admin.division.create');

Route::post('/admin/division/store','AdminDivisionController@division_store')->name('admin.division.store');

Route::get('/admin/division/edit/{id}','AdminDivisionController@division_edit')->name('admin.division.edit');

Route::post('/admin/division/update/{id}','AdminDivisionController@division_update')->name('admin.division.update');

Route::get('/admin/division/delete/{id}','AdminDivisionController@division_delete')->name('admin.division.delete');



//Admin District route

Route::get('/admin/district','AdminDistrictController@manage_district')->name('admin.district');

Route::get('/admin/district/create','AdminDistrictController@create_district')->name('admin.district.create');

Route::post('/admin/district/store','AdminDistrictController@district_store')->name('admin.district.store');

Route::get('/admin/district/edit/{id}','AdminDistrictController@district_edit')->name('admin.district.edit');

Route::post('/admin/district/update/{id}','AdminDistrictController@district_update')->name('admin.district.update');

Route::get('/admin/district/delete/{id}','AdminDistrictController@district_delete')->name('admin.district.delete');






//Admin order Receive  route

Route::get('/admin/order','AdminOrderController@index')->name('admin.order');

Route::get('/admin/order/view/{id}','AdminOrderController@show')->name('admin.order.show');
Route::get('/admin/order/delete/{id}','AdminOrderController@order_delete')->name('admin.order.delete');

Route::post('/admin/order/completed/{id}','AdminOrderController@order_completed')->name('admin.order.completed');
Route::post('/admin/order/paid/{id}','AdminOrderController@order_paid')->name('admin.order.paid');
Route::post('/admin/order/charge_update/{id}','AdminOrderController@order_charge_update')->name('admin.order.charge_update');
Route::get('/admin/order/invoice/{id}','AdminOrderController@generate_invoice')->name('admin.order.invoice');





//Admin Slider route

Route::get('/admin/slider','AdminSliderController@manage_slider')->name('admin.slider');

Route::get('/admin/slider/create','AdminSliderController@create_slider')->name('admin.slider.create');

Route::post('/admin/slider/store','AdminSliderController@slider_store')->name('admin.slider.store');

Route::get('/admin/slider/edit/{id}','AdminSliderController@slider_edit')->name('admin.slider.edit');

Route::post('/admin/slider/update/{id}','AdminSliderController@slider_update')->name('admin.slider.update');

Route::get('/admin/slider/delete/{id}','AdminSliderController@slider_delete')->name('admin.slider.delete');




// user Authentication Route

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');



//Admin Authentication  Route
   
Route::get('/admin','AdminPagesController@index')->name('admin.index');

Route::get('/admin/login','Auth\Admin\LoginController@showLoginForm')->name('admin.login');

Route::post('/admin/login/store','Auth\Admin\LoginController@login')->name('admin.login.store');

Route::post('/admin/logout','Auth\Admin\LoginController@logout')->name('admin.logout');

      //Forgot password route


Route::get('/admin/password/reset','Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

Route::post('/admin/password/reset','Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');



//API Routes 

Route::get('get-district/{id}',function($id){

	return json_encode(App\Models\District::where('division_id', $id)->get());

});