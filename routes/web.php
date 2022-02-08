<?php

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





Route::group(['middleware' => ['auth','admin']],function(){
		Route::get('admin', 'dashboardController@index');
});



Route::group(['prefix'=>'makecommand','middleware' => ['auth','admin']],function(){
	
	Route::get('/', 'dashboardController@index');

	//customize
	Route::get('/visual_customization', 'dashboardController@visual_customization');
	Route::get('/show_layout', 'dashboardController@show_layout');
	Route::get('/customize', 'dashboardController@customize');
	Route::post('/insert_customize', 'dashboardController@insert_customize');
	Route::post('/update_customize', 'dashboardController@update_customize');

	Route::get('/delete_customized_section', 'dashboardController@delete_customized_section');


	//category
	Route::get('/category', 'dashboardController@category');
	Route::get('/add_category', 'dashboardController@add_category');
	Route::post('/insert_category', 'dashboardController@insert_category');
	Route::get('/edit_category', 'dashboardController@edit_category');
	Route::post('/update_category', 'dashboardController@update_category');
	Route::get('/delete_category', 'dashboardController@delete_category');

	Route::get('/sort_category', 'dashboardController@sort_category');
	Route::get('/search_category', 'dashboardController@search_category');


	//manufacturer
	Route::get('/manufacturer', 'dashboardController@manufacturer');;
	Route::get('/add_manufacturer', 'dashboardController@add_manufacturer');
	Route::post('/insert_manufacturer', 'dashboardController@insert_manufacturer');
	Route::get('/edit_manufacturer', 'dashboardController@edit_manufacturer');
	Route::post('/update_manufacturer', 'dashboardController@update_manufacturer');
	Route::get('/delete_manufacturer', 'dashboardController@delete_manufacturer');

	Route::get('/sort_manufacturer', 'dashboardController@sort_manufacturer');
	Route::get('/search_manufacturer', 'dashboardController@search_manufacturer');


	//product
	Route::get('/product', 'backend\ProductController@product');
	Route::get('/add_product', 'backend\ProductController@add_product');
	Route::post('/insert_product', 'backend\ProductController@insert_product');
	Route::get('/edit_product', 'backend\ProductController@edit_product');
	Route::post('/update_product', 'backend\ProductController@update_product');
	Route::get('/delete_product', 'backend\ProductController@delete_product');

	Route::get('/sort_product', 'backend\ProductController@sort_product');
	Route::get('/search_product', 'backend\ProductController@search_product');
	
	Route::get('/unapproved_product', 'backend\ProductController@unapproved_product');


	//attribute
	Route::get('/attribute', 'backend\ProductController@attribute');
	Route::post('/insert_attribute', 'backend\ProductController@insert_attribute');
	Route::post('/update_attribute', 'backend\ProductController@update_attribute');
	Route::get('/delete_attribute', 'backend\ProductController@delete_attribute');


	//order
	Route::get('/order', 'backend\orderController@order');
	Route::get('/show_order', 'backend\orderController@show_order');
	Route::get('/edit_order', 'backend\orderController@edit_order');
	Route::post('/update_order', 'backend\orderController@update_order');

	Route::get('/sort_order', 'backend\orderController@sort_order');
	Route::get('/search_order', 'backend\orderController@search_order');


	//shipping
	Route::get('/shipping', 'backend\ProductController@shipping');
	Route::post('/insert_shipping', 'backend\ProductController@insert_shipping');
	Route::post('/update_shipping', 'backend\ProductController@update_shipping');
	Route::get('/delete_shipping', 'backend\ProductController@delete_shipping');


	//fnq
	Route::get('/fnq', 'dashboardController@fnq');
	Route::post('/insert_fnq', 'dashboardController@insert_fnq');
	Route::post('/update_fnq', 'dashboardController@update_fnq');
	Route::get('/delete_fnq', 'dashboardController@delete_fnq');


	//page
	Route::get('/page', 'dashboardController@page');;
	Route::get('/add_page', 'dashboardController@add_page');
	Route::post('/insert_page', 'dashboardController@insert_page');
	Route::get('/edit_page', 'dashboardController@edit_page');
	Route::post('/update_page', 'dashboardController@update_page');
	Route::get('/delete_page', 'dashboardController@delete_page');



	//user
	Route::get('/user', 'dashboardController@user');
	Route::get('/add_user', 'dashboardController@add_user');
	Route::post('/insert_user', 'dashboardController@insert_user');
	Route::get('/edit_user', 'dashboardController@edit_user');
	Route::post('/update_user', 'dashboardController@update_user');
	Route::get('/update_user', 'dashboardController@update_user');
	Route::get('/delete_user', 'dashboardController@delete_user');
	Route::get('/sort_user', 'dashboardController@sort_user');
	Route::get('/search_user', 'dashboardController@search_user');


	//withdraw_manage
	Route::get('/withdraw_manage', 'dashboardController@withdraw_manage');
	Route::get('/pending_withdraw', 'dashboardController@pending_withdraw');
	Route::get('/update_withdraw', 'dashboardController@update_withdraw');

	Route::get('/pending_user', 'dashboardController@pending_user');
	Route::get('/sort_pending_user', 'dashboardController@sort_pending_user');
	Route::get('/search_pending_user', 'dashboardController@search_pending_user');




});





Route::get('/', 'LinkController@index');
Route::get('index', 'LinkController@index');



Route::get('shop', 'LinkController@shop');
Route::get('show_category', 'LinkController@all_category');
Route::get('product/{name}/{id}', 'LinkController@showproduct');
Route::get('merchant_register', 'LinkController@merchant_register');

Route::get('page/{name}/{id}', 'LinkController@page_show');
Route::get('fnq', 'LinkController@fnq');


Route::get('order_track', 'LinkController@order_track');
Route::get('order_tracking', 'LinkController@order_tracking');



Route::get('Affiliate-Reg', 'LinkController@affiliate_reg');
Route::get('Vendor-Reg', 'LinkController@vendor_reg');
Route::get('Dealer-Reg', 'LinkController@Dealer_Reg');

Route::get('sign_up', 'LinkController@sign_up');





Route::group(['middleware' => ['auth']],function(){

	//transection and withdraw
	Route::get('/transaction', 'dashboardController@transaction');
	Route::get('/withdraw', 'dashboardController@withdraw');
	Route::post('/withdraw_request', 'dashboardController@withdraw_request');



	Route::post('update_cart', 'LinkController@update_cart');
	Route::get('add_to_cart', 'LinkController@add_to_cart');
	Route::get('delete_from_cart', 'LinkController@delete_from_cart');
	Route::get('cart', 'LinkController@cart');
	Route::get('checkout', 'LinkController@checkout');
	Route::post('order_place', 'LinkController@order_place');




	Route::get('/home', 'Profile_Controller@profile');
	Route::get('profile', 'Profile_Controller@profile');
	Route::post('update_profile', 'Profile_Controller@update_profile');
	Route::get('profile/orderlist', 'Profile_Controller@profile_orderlist');
	Route::get('profile/show_order', 'Profile_Controller@show_order');

	// Route::get('profile/product', 'Profile_Controller@profile_product');
	// Route::get('profile/add_product', 'Profile_Controller@add_product');
	// Route::post('profile/insert_product', 'Profile_Controller@insert_product');
	// Route::get('profile/edit_product', 'Profile_Controller@edit_product');
	// Route::post('profile/update_product', 'Profile_Controller@update_product');

	// Route::get('profile/product_attribute', 'Profile_Controller@product_attribute');
	// Route::post('profile/insert_attribute', 'Profile_Controller@insert_attribute');
	// Route::post('profile/update_attribute', 'Profile_Controller@update_attribute');
	// Route::get('profile/delete_attribute', 'Profile_Controller@delete_attribute');

	// Route::get('profile/order_management', 'Profile_Controller@order_management');
	// Route::get('profile/edit_order_management', 'Profile_Controller@edit_order_management');
	// Route::get('profile/update_order', 'Profile_Controller@update_order');


	Route::get('create-affiliate-dashboard', 'AffiliateController@create_affiliate_dashboard');
});



Route::group(['affiliate-dashboard' => ['auth','affiliate']],function(){
	Route::get('affiliate-dashboard', 'AffiliateController@index');
	Route::get('affiliate-dashboard/code', 'AffiliateController@code');

	
	Route::get('affiliate-dashboard/reff_user', 'AffiliateController@reff_user');
	Route::get('affiliate-dashboard/sort_reff_user', 'AffiliateController@sort_reff_user');
	Route::get('affiliate-dashboard/search_reff_user', 'AffiliateController@search_reff_user');


	Route::get('affiliate-dashboard/pending_my_affiliate_order', 'AffiliateController@pending_my_affiliate_order');
	Route::get('affiliate-dashboard/sort_pending_my_affiliate_order', 'AffiliateController@sort_pending_my_affiliate_order');
	Route::get('affiliate-dashboard/search_pending_my_affiliate_order', 'AffiliateController@search_pending_my_affiliate_order');



	Route::get('affiliate-dashboard/complete_my_affiliate_order', 'AffiliateController@complete_my_affiliate_order');
	Route::get('affiliate-dashboard/sort_complete_my_affiliate_order', 'AffiliateController@sort_complete_my_affiliate_order');
	Route::get('affiliate-dashboard/search_complete_my_affiliate_order', 'AffiliateController@search_complete_my_affiliate_order');


	Route::get('affiliate-dashboard/products', 'AffiliateController@products');
	Route::get('affiliate-dashboard/sort_products', 'AffiliateController@sort_products');
	Route::get('affiliate-dashboard/search_products', 'AffiliateController@search_products');





});














Route::group(['dealer-dashboard' => ['auth','dealer']],function(){
	Route::get('dealer-dashboard', 'DealerController@index');


	Route::get('dealer-dashboard/products', 'DealerController@dealer_product');

	Route::get('dealer-dashboard/sort_dealer_product', 'DealerController@sort_dealer_product');
	Route::get('dealer-dashboard/search_dealer_product', 'DealerController@search_dealer_product');


	Route::get('dealer-dashboard/orderlist', 'DealerController@orderlist');
	Route::get('dealer-dashboard/show_order', 'DealerController@show_order');

});






Route::group(['prefix'=>'vendor-dashboard','middleware' => ['auth','vendor']],function(){
	Route::get('/', 'VendorController@index');


	//product
	Route::get('/product', 'VendorController@product');
	Route::get('/add_product', 'VendorController@add_product');
	Route::post('/insert_product', 'VendorController@insert_product');
	Route::get('/edit_product', 'VendorController@edit_product');
	Route::post('/update_product', 'VendorController@update_product');
	Route::get('/delete_product', 'VendorController@delete_product');

	Route::get('/sort_product', 'VendorController@sort_product');
	Route::get('/search_product', 'VendorController@search_product');


	//attribute
	Route::get('/attribute', 'VendorController@attribute');
	Route::post('/insert_attribute', 'VendorController@insert_attribute');
	Route::post('/update_attribute', 'VendorController@update_attribute');
	Route::get('/delete_attribute', 'VendorController@delete_attribute');


	//order
	Route::get('/order', 'VendorController@order');
	Route::get('/show_order', 'VendorController@show_order');
	Route::get('/edit_order', 'VendorController@edit_order');
	Route::post('/update_order', 'VendorController@update_order');

	Route::get('/sort_order', 'VendorController@sort_order');
	Route::get('/search_order', 'VendorController@search_order');




});







Auth::routes();

 Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

