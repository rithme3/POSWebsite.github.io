<?php

use Illuminate\Support\Facades\Route;


// website 
Route::get('/', [App\Http\Controllers\WebController::class, 'home'])->name('home');
Route::get('/product/detail/{id}', [App\Http\Controllers\WebController::class, 'detail'])->name('product_detail');
Route::get('/product/{name}/{id}', [App\Http\Controllers\WebController::class, 'productByCategory'])->name('product_by_category');
Route::get('/switch_lang/{locale}', [App\Http\Controllers\WebController::class, 'switchLanguage'])->name('switch_lang');



Auth::routes(['register'=>true]);
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::group(['prefix'=>'admin','middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    // users
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index')->middleware('checkUserType');
    Route::get('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create')->middleware('checkUserType');
    Route::get('/users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit')->middleware('checkUserType');
    Route::get('/users/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete')->middleware('checkUserType');
    Route::post('/users/save', [App\Http\Controllers\UsersController::class, 'save'])->name('users.save')->middleware('checkUserType');
    Route::post('/users/update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update')->middleware('checkUserType');

    // category
    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index')->middleware('checkUserType');
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create')->middleware('checkUserType');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit')->middleware('checkUserType');
    Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete')->middleware('checkUserType');
    Route::post('/category/save', [App\Http\Controllers\CategoryController::class, 'save'])->name('category.save')->middleware('checkUserType');
    Route::post('/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update')->middleware('checkUserType');

    // article
    Route::get('/article', [App\Http\Controllers\ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('article.create');
    Route::get('/article/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('article.edit');
    Route::get('/article/delete/{id}', [App\Http\Controllers\ArticleController::class, 'delete'])->name('article.delete');
    Route::post('/article/save', [App\Http\Controllers\ArticleController::class, 'save'])->name('article.save');
    Route::post('/article/update', [App\Http\Controllers\ArticleController::class, 'update'])->name('article.update');

    // product
    Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::get('/product/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/save', [App\Http\Controllers\ProductController::class, 'save'])->name('product.save');
    Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');

    //POS
    Route::get('/pos-order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
    Route::post('order/save', [App\Http\Controllers\OrderController::class, 'addToCart'])->name('order.save_cart');
    Route::get('order/remove/{id}', [App\Http\Controllers\OrderController::class, 'removeCart'])->name('order.remove');
    Route::get('order/clear-all-cart', [App\Http\Controllers\OrderController::class, 'clearAllCart'])->name('order.clear_all');
    Route::post('order/save-order', [App\Http\Controllers\OrderController::class, 'saveOrder'])->name('order.save');

    //invoice
    Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/detail/{id}', [App\Http\Controllers\InvoiceController::class, 'detail'])->name('invoice.detail');
    Route::get('/invoice/print/{id}', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoice.print');

    // no permission 
    Route::get('/no-permission', function(){
        return view('admins.no_permission');
    })->name('no_permission');
});
