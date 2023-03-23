<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\SizePriceController;
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

Route::get('/reload-captcha', [AuthController::class, 'reloadCaptcha']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store_register']);


// ** ROUTE DASHBOARD */
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/biodata/create', [BiodataController::class, 'create']);
    Route::post('/biodata/store', [BiodataController::class, 'store']);

    Route::get('/katalog', [KatalogController::class, 'shop']);
    Route::get('/katalog/detail/{slug}', [KatalogController::class, 'detail']);
});

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/master/katalog', [KatalogController::class, 'index']);
    Route::post('/master/katalog/simpan', [KatalogController::class, 'store']);
    Route::get('/master/katalog/detil/{id}', [KatalogController::class, 'show']);

    Route::get('/master/size', [SizePriceController::class, 'index']);
    Route::post('/master/size/simpan', [SizePriceController::class, 'store']);
});
