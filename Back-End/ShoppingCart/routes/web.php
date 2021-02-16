<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/Products',[ProductController::class,'index'])->name('Products');
Route::get('/Cart',[CartController::class,'index'])->name('Cart');
Route::post('/Cart/add',[CartController::class,'AddToCart'])->name('AddToCart');
Route::post('/Cart/update',[CartController::class,'UpdateFromCart'])->name('UpdateFromCart');
Route::post('/Cart/remove',[CartController::class,'RemoveFromCart'])->name('RemoveFromCart');
Route::post('/Cart/coupon',[CartController::class,'UseCoupons'])->name('UseCoupon');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
