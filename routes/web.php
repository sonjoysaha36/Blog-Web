<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

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

route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class,'redirect'])->name('dashboard');});
route::get('/redirect',[HomeController::class,'redirect']);
route::get('/view_category',[AdminController::class,'view_category']);
// blog post page
route::get('/blog_post',[AdminController::class,'blog_post']);
// for adding category
route::post('/add_category',[AdminController::class,'add_category']);

// delete category
route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
// delete log
route::get('/delete_blog/{id}',[AdminController::class,'delete_blog']);
// delete user
route::get('/delete_user/{id}',[AdminController::class,'delete_user']);

// Adding Blog
route::post('/add_blog',[AdminController::class,'add_blog']);


// edit blog
route::get('/edit_blog/{id}',[AdminController::class,'edit_blog']);
// Show all blog in admin page
route::get('/show_blog',[AdminController::class,'show_blog']);

// Show all blog
route::get('/all_blogs',[HomeController::class,'all_blogs']);

// category selected blog
route::get('/category_blog/{id}',[HomeController::class,'category_blog']);
// Search
route::get('/search',[HomeController::class,'search']);
// manage user
route::get('/manage_user',[AdminController::class,'manage_user']);
// Approve request
route::get('/approve_request',[AdminController::class,'approve_request']);

// update Blog
route::post('/update_blog/{id}',[AdminController::class,'update_blog']);

// Watch feedback
route::get('/feedback',[AdminController::class,'feedback']);

// delete Feedback
route::get('/delete_feedback/{id}',[AdminController::class,'delete_feedback']);

// posting blog login user

route::get('/post_blog',[HomeController::class,'post_blog']);

// add cart
route::get('/add_cart/{id}',[HomeController::class,'add_cart']);
// Hide Comment
route::get('/hide_comment/{id}',[HomeController::class,'hide_comment']);



// show cart
route::get('/show_cart',[HomeController::class,'show_cart']);
// remove cart
route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
// try page
route::get('/demo',[HomeController::class,'demo']);

route::get('/read/{id}',[HomeController::class,'read']);
// add like
route::get('/add_like/{id}',[HomeController::class,'add_like']);

// add comment
route::post('/add_comment',[HomeController::class,'add_comment']);
// add feedback
route::post('/feedback',[HomeController::class,'feedback']);
// contact us
route::get('/contact',[HomeController::class,'contact']);

// show and hide blog
Route::patch('/products/{product}/toggle-feature', [ProductController::class, 'toggleFeature']);