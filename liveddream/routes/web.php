<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdhesiveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/products', [ProductController::class, 'create'])->name('product.create')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/companies', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/adhesive', [AdhesiveController::class, 'create'])->name('adhesive.create');
    Route::post('/adhesive', [AdhesiveController::class, 'store'])->name('adhesive.store');
    Route::get('/adhesives', [AdhesiveController::class, 'index'])->name('adhesive.index');
Route::get('/adhesive/edit/{id}', [AdhesiveController::class, 'edit'])->name('adhesive.edit');
Route::put('/adhesive/update/{id}', [AdhesiveController::class, 'update'])->name('adhesive.update');
Route::delete('/adhesive/destroy/{id}', [AdhesiveController::class, 'destroy'])->name('adhesive.destroy');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/show-products', [ProductController::class, 'index'])->name('products.show');
    Route::get('/companiess', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create-categories', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/index-categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create-sample', [SampleController::class, 'create'])->name('sample.create');
    Route::get('/index-sample', [SampleController::class, 'index'])->name('sample.index');
   

    Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('/zones/create', [ZoneController::class, 'create'])->name('zones.create');
    Route::post('/zones', [ZoneController::class, 'store'])->name('zones.store');
    Route::get('/zones/{id}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
    Route::post('/zones/{id}', [ZoneController::class, 'update'])->name('zones.update');
    Route::post('/zones/{id}/delete', [ZoneController::class, 'destroy'])->name('zones.destroy');
    
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/edit-product-image/{id}/{product_id}', [ProductController::class, 'editProductImage'])->name('product.image.edit');
    Route::put('/update-product-image/{id}', [ProductController::class, 'updateProductImage'])->name('product.image.update');
   
    // Route::resource('companies', CompanyController::class);

});

require __DIR__.'/auth.php';
