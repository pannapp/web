<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoiDungController;

// Route m?c d?nh: Hi?n th? danh sách ngu?i dùng
Route::get('/nguoi_dung', [NguoiDungController::class, 'index'])->name('nguoi_dung.index');

// Route hi?n th? form t?o ngu?i dùng
Route::get('/nguoi_dung/create', [NguoiDungController::class, 'create'])->name('nguoi_dung.create');

// Route luu d? li?u ngu?i dùng m?i
Route::post('/nguoi_dung', [NguoiDungController::class, 'store'])->name('nguoi_dung.store');

// Route hi?n th? thông tin chi ti?t m?t ngu?i dùng
Route::get('/nguoi_dung/{id}', [NguoiDungController::class, 'show'])->name('nguoi_dung.show');

// Route hi?n th? form ch?nh s?a thông tin ngu?i dùng
Route::get('/nguoi_dung/{id}/edit', [NguoiDungController::class, 'edit'])->name('nguoi_dung.edit');

// Route c?p nh?t thông tin ngu?i dùng
Route::put('/nguoi_dung/{id}', [NguoiDungController::class, 'update'])->name('nguoi_dung.update');

// Route xóa ngu?i dùng
Route::delete('/nguoi_dung/{id}', [NguoiDungController::class, 'destroy'])->name('nguoi_dung.destroy');

Route::get('/nguoi_dung', [NguoiDungController::class, 'index'])->name('nguoi_dung.index');
