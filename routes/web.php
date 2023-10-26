<?php

use App\Http\Controllers\DataController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DataController::class, 'index']);
Route::post('/input-data', [DataController::class, 'UploadData'])->name('input.data');
Route::post('/edit-data', [DataController::class, 'UpdateData'])->name('update.data');
Route::get('/delete-data/{id}', [DataController::class, 'DeleteData']);
Route::get('/search-data', [DataController::class, 'SearchData'])->name('search.data');

