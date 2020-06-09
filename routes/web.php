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



// use Illuminate\Routing\Route;

use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Notifications\Notification;

Route::get('/', 'HomeController@index')->name('home');
        
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');

Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function()
{
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function()
{
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});

Route::get('my-orders', 'UserOrderController@index')->name('user.orders');

Route::group(['middleware'=>['auth', 'access.control.store.admin']], function() 
{

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () 
    {
        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

      
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index')->name('orders.my');
    });
});

Auth::routes();
      


Route::get('not', function(){
    // $user = \App\User::find(27);

    //$user->notify(new App\Notifications\StoreReceiveNewOrder());

    // $notification = $user->notifications->first();
    // $notification->markAsread();
    // $notification = $user->unreadNotifications->first();

    // $stores = [27, 30];
    // $stores = \App\Store::whereIn('id', $stores)->get();
    // // return $stores;
    // // return $stores->each(function($store)
    // /**com map eu retorno o dono das lojas */
    // return $stores->map(function($store)

    //     {
    //         return $store->user;
    //         // return get_class($store->user);

    //     });



    // return $user->unreadNotifications; //ou unreadNotifications

    // return $user->readNotifications; ou unreadNotifications
    // return $user->readNotifications->count(); //ou unreadNotifications

});


// Route::get('not', function(){$user = \App\User::find(39);

Route::get('/model', function () 
{
    
    $product = \App\Product::find(27);
    return $product->categories;

    // return \App\User::all();
});

        /* Route::prefix('stores')->name('stores.')->group(function(){

            Route::get('/', 'StoreController@index')->name('index');
            Route::get('/create', 'StoreController@create')->name('create');
            Route::post('/store', 'StoreController@store')->name('store');
            Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
            Route::post('/update/{store}', 'StoreController@update')->name('update');
            Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');

        }); */
