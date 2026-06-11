<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KamarController::class, 'index'])->name('landing');
Route::get('/kamar/{kamar}', [KamarController::class, 'show'])->name('kamar.detail')->where('kamar', '[0-9]+');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kamar booking route
    Route::get('/kamar/{kamar}/pesan', [KamarController::class, 'pesan'])->name('kamar.pesan')->where('kamar', '[0-9]+');

    // Penghuni routes
    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
    Route::get('/penghuni/create', [PenghuniController::class, 'create'])->name('penghuni.create');
    Route::post('/penghuni', [PenghuniController::class, 'store'])->name('penghuni.store');

    // Pembayaran routes
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{tagihanId}/pay', [PembayaranController::class, 'pay'])->name('pembayaran.pay');
    Route::post('/pembayaran/notification', [PembayaranController::class, 'notification'])->name('pembayaran.notification');
    Route::post('/pembayaran/{tagihanId}/simulate-success', [PembayaranController::class, 'simulateSuccess'])->name('pembayaran.simulate-success')->middleware('auth');
    Route::get('/pembayaran/{tagihanId}/check-status', [PembayaranController::class, 'checkStatus'])->name('pembayaran.check-status')->middleware('auth');

    // Perbaikan (permintaan perbaikan oleh penghuni)
    Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
    Route::get('/perbaikan/create', [PerbaikanController::class, 'create'])->name('perbaikan.create');
    Route::post('/perbaikan', [PerbaikanController::class, 'store'])->name('perbaikan.store');
});

require __DIR__.'/auth.php';
