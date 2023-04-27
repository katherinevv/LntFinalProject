<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\InvoiceController;
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

Route::middleware('isAdmin')->group(function(){
    Route::get('/create-barang', [BarangController::class, 'createBarang']);
});

Route::get('/', [BarangController::class, 'show']);

Route::post('store-barang', [BarangController::class, 'storeBarang']);

Route::get('/edit-barang{id}', [BarangController::class, 'edit'])->name('edit');

Route::patch('/update-barang/{id}', [BarangController::class, 'update'])->name('update');

Route::delete('/delete-barang/{id}', [BarangController::class, 'delete'])->name('delete');

Route::get('/create-category', [CategoryController::class, 'createCategory']);

Route::post('/store-category', [CategoryController::class, 'storeCategory']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/send-mail', [MailController::class, 'sendMail']);

Route::get('/create-invoice', [InvoiceController::class, 'createInvoice']);

// Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('show');

Route::post('/store-invoice', [InvoiceController::class, 'store'])->name('store');

// Route::get('/edit-invoice{id}', [InvoiceController::class, 'edit'])->name('edit');

// Route::put('/update-invoice/{id}', [InvoiceController::class, 'update'])->name('update');

Route::delete('/destroy-invoice/{id}', [InvoiceController::class, 'destroy'])->name('destroy');

Route::get('/show-invoice/{id}', [InvoiceController::class, 'show'])->name('show');

