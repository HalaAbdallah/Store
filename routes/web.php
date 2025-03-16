<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;


/**Dashboard Routes */
//Product Routes
Route::get   ('/admin/products/index'       ,[ProductController::class, 'index'  ])->name('products.index'  );// Route to display the list of all products
Route::get   ('/admin/products/create'      ,[ProductController::class, 'create' ])->name('products.create' );// Route to display the product creation form
Route::post  ('/admin/products/store'       ,[ProductController::class, 'store'  ])->name('products.store'  );// Route to handle storing the new product in the database
Route::delete('/admin/products/{id}/delete' ,[ProductController::class, 'destroy'])->name('products.destroy');// Route to handle product deletion
Route::get   ('/admin/products/{id}/edit'   ,[ProductController::class, 'edit'   ])->name('products.edit'   );// Route to display the product edit form
Route::put   ('admin/products/update/{id}'  ,[ProductController::class, 'update' ])->name('products.update' );// Route to handle updating an existing product

//Category Routes
Route::get   ('/admin/categories/create'      ,[CategoryController::class, 'create' ])->name('categories.create' );// Route to display the Category creation form
Route::get   ('/admin/categories/index'       ,[CategoryController::class, 'index'  ])->name('categories.index'  );// Route to display the list of all Category
Route::post  ('/admin/categories/store'       ,[CategoryController::class, 'store'  ])->name('categories.store'  );// Route to handle storing the new Category in the database
Route::delete('/admin/categories/{id}/delete' ,[CategoryController::class, 'destroy'])->name('categories.destroy');// Route to handle Category deletion
Route::get   ('/admin/categories/{id}/edit'   ,[CategoryController::class, 'edit'   ])->name('categories.edit'   );// Route to display the Category edit form
Route::put   ('admin/categories/update/{id}'  ,[CategoryController::class, 'update' ])->name('categories.update' );// Route to handle updating an existing Category


/**Front Page Routes */
// Route to display all products with optional category filtering
Route::get('/', [FrontController::class, 'index'])->name('layouts.front.index');

// Route to filter products by category
Route::get('admin/categories/{id}', [FrontController::class, 'filterByCategory'])->name('layouts.front.category');
