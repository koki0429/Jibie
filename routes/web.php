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
Route::get('contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');
Route::post('contact/confirm', 'App\Http\Controllers\ContactController@confirm')->name('contact.confirm');
Route::post('contact/thanks', 'App\Http\Controllers\ContactController@send')->name('contact.send');

Route::get('/sheet', 'App\Http\Controllers\SpreadSheetController@manager');

Route::get('product/about', 'App\Http\Controllers\ProductController@about')->name('product.about');
Route::get('product/thanks', 'App\Http\Controllers\ProductController@thanks')->name('product.thanks');
Route::get('product/kart/{user_id}', 'App\Http\Controllers\ProductController@kart')->name('product.kart');
Route::post('product/kartCreate', 'App\Http\Controllers\ProductController@kartCreate')->name('product.kartCreate');
Route::post('product/kartChange', 'App\Http\Controllers\ProductController@kartChange')->name('product.kartChange');
Route::resource('product', 'App\Http\Controllers\ProductController');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('stripe/stripe', 'App\Http\Controllers\StripeController@stripe')->name('stripe.stripe');
Route::post('stripe', 'App\Http\Controllers\StripeController@stripePost')->name('stripe.post');
