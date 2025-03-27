<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdhesiveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\zoneController;
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
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/index', [ProductController::class, 'index'])->name('products.index');
    Route::get('/companiess', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create-categories', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/index-categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create-sample', [SampleController::class, 'create'])->name('sample.create');
    Route::get('/index-sample', [SampleController::class, 'index'])->name('sample.index');
    Route::get('/create-zones', [zoneController::class, 'create'])->name('zones.create');
    Route::get('/index-zones', [zoneController::class, 'index'])->name('zones.index');


    // Route::resource('companies', CompanyController::class);

});

require __DIR__.'/auth.php';
