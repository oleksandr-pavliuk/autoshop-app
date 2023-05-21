<?php

use App\Http\Controllers\AdminCarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    return Redirect::to('/admin/cars');
});
Route::get('/home', function () {
    return Redirect::to('/admin/cars');
});

Route::resource('/admin/cars', AdminCarController::class)->middleware('auth');
Route::get('/admin/cars/{id}/scholarship-payment', [AdminCarController::class, 'scholarshipPayment'])->middleware('auth');
Route::post('/admin/cars/{id}/pay-scholarship', [AdminCarController::class, 'payScholarship'])->middleware('auth');
Route::get('/admin/cars/{id}/view', [AdminCarController::class, 'view'])->middleware('auth');

Auth::routes();
