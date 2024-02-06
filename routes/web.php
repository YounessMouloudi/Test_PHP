<?php

use App\Http\Controllers\TemoignageController;
use App\Models\Temoignage;
use Illuminate\Http\Request;
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

Route::get('/', function() {
    return redirect()->route("temoignage");
})->name("home");

Route::get('/temoignage', [TemoignageController::class, 'index'])->name("temoignage");

Route::post('/temoignage/store', [TemoignageController::class, 'store'])->name("add_temoignage");

Route::get('/temoignage/admin/edit/{id}', [TemoignageController::class, 'edit'])->name("edit_temoignage");

Route::patch('/temoignage/admin/update/{id}', [TemoignageController::class, 'update'])->name("update_temoignage");

Route::get('/temoignage/admin', [TemoignageController::class, 'administration'])->name("administration");

Route::post('/temoignage/admin', [TemoignageController::class, 'dragdrop'])->name("drag&drop");

// Route::resource('/temoignages',TemoignageController::class);
