<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
Route::get('/foo', function () {
Artisan::call('storage:link');
});


Route::get('/', [\App\Http\Controllers\MainController::class,'index']);
Route::get('/blog/{id}', [\App\Http\Controllers\MainController::class,'singleBlog']);
Route::get('/addcart/{id}', [\App\Http\Controllers\MainController::class,'addCart']);
Route::get('/removecart/{rowId}', [\App\Http\Controllers\MainController::class,'removeCart']);
Route::get('/addcartproduct/{id}', [\App\Http\Controllers\MainController::class,'addCartProduct']);
Route::get('/checkout', [\App\Http\Controllers\MainController::class,'saveCart']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/users', [App\Http\Controllers\HomeController::class, 'users']);
Route::get('/deleteuser/{id}',[App\Http\Controllers\HomeController::class, 'deleteUser']);
Route::patch('/updateuser/{id}',[App\Http\Controllers\HomeController::class, 'updateUser']);
Route::get('/home/menus',[App\Http\Controllers\HomeController::class, 'menus']);
Route::post('/createmenu',[App\Http\Controllers\HomeController::class, 'createMenu']);
Route::get('/deletemenu/{id}',[App\Http\Controllers\HomeController::class, 'deleteMenu']);
Route::patch('/updatemenu/{id}',[App\Http\Controllers\HomeController::class, 'updateMenu']);
Route::get('/home/guests',[App\Http\Controllers\HomeController::class, 'guests']);
Route::delete('/deleteguest/{id}',[App\Http\Controllers\HomeController::class, 'deleteGuest']);
Route::patch('/updateguest/{id}',[App\Http\Controllers\HomeController::class, 'updateGuest']);
Route::post('/create/guest',[App\Http\Controllers\HomeController::class, 'createGuest']);
Route::get('/home/products',[App\Http\Controllers\HomeController::class, 'products']);
Route::post('/createproduct',[App\Http\Controllers\HomeController::class, 'createProduct']);
Route::get('/deleteproduct/{id}',[App\Http\Controllers\HomeController::class, 'deleteProduct']);
Route::patch('/updateproduct/{id}',[App\Http\Controllers\HomeController::class, 'updateProduct']);
Route::get('/home/reviews',[App\Http\Controllers\HomeController::class, 'reviews']);
Route::post('/createreview',[App\Http\Controllers\HomeController::class, 'createReview']);
Route::get('/deletereview/{id}',[App\Http\Controllers\HomeController::class, 'deleteReview']);
Route::patch('/updatereview/{id}',[App\Http\Controllers\HomeController::class, 'updateReview']);
Route::get('/home/blogs',[App\Http\Controllers\HomeController::class, 'blogs']);
Route::post('/createblog',[App\Http\Controllers\HomeController::class, 'createBlog']);
Route::get('/deleteblog/{id}',[App\Http\Controllers\HomeController::class, 'deleteBlog']);
Route::patch('/updateblog/{id}',[App\Http\Controllers\HomeController::class, 'updateBlog']);
Route::get('/home/cart/menus',[App\Http\Controllers\HomeController::class, 'showMenuCart']);
Route::get('/deleteCartItem/{id}',[App\Http\Controllers\HomeController::class, 'deleteItem']);
Route::patch('/updateqty/{id}',[App\Http\Controllers\HomeController::class, 'updateQty']);
Route::get('/home/cart/products',[App\Http\Controllers\HomeController::class, 'showProductCart']);
