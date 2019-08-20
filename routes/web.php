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

Route::get('/', 'PagesController@homePage');


//client side Routes

Route::get('/about', 'PagesController@aboutPage');

Route::get('/checkout', 'PagesController@checkoutPage');
Route::get('/posts/search', 'PagesController@searchPage');

Route::get('/elements','ElementController@fetchElements');


Route::get('/cart','PagesController@cartCheckout');

Route::resource('posts','PostsController');

Route::get('orders','PagesController@ordersPage');
Route::post('orders',['as'=>'ordersPage','uses'=>'PagesController@ordersPage']);
Route::get('/posts/categories/{category}','PagesController@categoryPage');
Route::get('/footer', 'PagesController@footer');

Route::get('stripe', 'StripePaymentController@stripe');

Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');


//Authentication Routes

Auth::routes();


//managing cart

Route::get('/cart/price', 'AjaxController@getPrice');
Route::get('/cart/total', 'AjaxController@getTotalPrice');
Route::post('/cart/item-add', 'AjaxController@addItem');
Route::post('/cart/item-minus', 'AjaxController@minusItem');
Route::post('/cart/item-delete', 'AjaxController@deleteItem');
Route::post('/cart/setzero','AjaxController@setPriceZero');
Route::post('/user/{}','PagesController@showProfile');
Route::get('/deals','DealsController@deals');

//dashboard Routes


Route::get('/dashboard', 'DashboardController@index');

Route::get('/dashboard/products','DashboardController@products');
Route::get('/dashboard/orders','DashboardController@orders');
Route::get('/dashboard/products/new', 'PagesController@newPostPage');



//deals
Route::get('/dashboard/deals','DealsController@index');
Route::get('/dashboard/deals/new', 'DealsController@newDeal');
Route::post('/dashboard/deals/store', 'DealsController@store');



//Ajax Controller Routes

Route::post('/posts/cart','AjaxController@cart');
Route::post('/deals/cart','AjaxController@dealsCart');

Route::post('/price','AjaxController@price');

Route::get('/user/address','AjaxController@fetchAddress');


Route::get('/dashboard/user/address','AjaxController@fetchUserAddress');
Route::get('/orders/status','AjaxController@changeOrderStatus');
Route::get('/dashboard/stock/count','AjaxController@getStockCount');
Route::get('/dashboard/orders/count','AjaxController@getOrdersCount');
Route::get('/dashboard/stock/earnings','AjaxController@retrieveTotalBalance');
Route::get('/dashboard/stock/sales','AjaxController@getSalesCount');
Route::get('/dashboard/products/delete','AjaxController@deleteProduct');
Route::get('/dashboard/products/earnings','AjaxController@getEarningsByDate');
Route::get('/dashboard/products/categories','AjaxController@getTopCategories');
Route::get('/posts/fetch/categories','AjaxController@fetchAllCategories');
Route::get('/posts/fetch/posts','AjaxController@fetchAllPosts');

