<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


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

Route::get('/', [StudentController::class, 'index']);
Route::get('/download-excel-template', [StudentController::class, 'downloadTemplate'])->name('download.excel.template');
Route::post('/students/upload', [StudentController::class, 'upload'])->name('students.upload');
