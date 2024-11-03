<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [ImageUploadController::class, 'index'])->name('upload.index');
Route::post('/upload', [ImageUploadController::class, 'upload'])->name('upload.store');
Route::get('/click-upload', [ImageUploadController::class, 'showClickForm'])->name('click.upload');

// Route xử lý upload ảnh qua AJAX
Route::post('/upload', [ImageUploadController::class, 'upload'])->name('upload.store');

Route::get('/upload-qr', [ImageUploadController::class, 'showUploadQrForm'])->name('qr.upload');
Route::post('/create-qr', [ImageUploadController::class, 'createQr'])->name('qr.create');