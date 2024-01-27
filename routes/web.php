<?php

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

use App\Http\Controllers\MainController;
Route::get('/display',[MainController::class,'display']);

Route::post('/add-product',[MainController::class,'addproduct'])->name('add.product');
Route::post('/update-product',[MainController::class,'updateproduct'])->name('update.product');
Route::post('/delete-product',[MainController::class,'deleteproduct'])->name('delete.product');
Route::get('/pagination/paginate-data',[MainController::class,'pagination']);
Route::get('/search-product',[MainController::class,'searchproduct'])->name('search.product');
Route::get('/generateCSV',[MainController::class,'generateCSV'])->name('download.csv');
