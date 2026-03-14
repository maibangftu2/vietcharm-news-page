<?php
/**
 * HƯỚNG DẪN TÍCH HỢP TRANG TIN TỨC VÀO DỰ ÁN
 * ================================================
 * 
 * Thêm dòng sau vào file `routes/web.php`:
 */

use App\Http\Controllers\TinTucController;

Route::get('/tin-tuc', [TinTucController::class, 'index'])->name('tin-tuc.index');
