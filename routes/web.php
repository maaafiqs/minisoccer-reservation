<?php

use App\Http\Controllers\ProfileController;
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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;

Route::get('/migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $m = \Illuminate\Support\Facades\Artisan::output();
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    $s = \Illuminate\Support\Facades\Artisan::output();
    return "<h1>Migrasi & Seed Berhasil!</h1><pre>{$m}\n{$s}</pre><br><a href='/'>Buka Halaman Utama</a>";
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Clean up expired reservations first
    \App\Models\Reservation::cleanupExpired();
    
    // Pass user's reservation stats
    $totalReservations = auth()->user()->reservations()->count();
    $pendingReservations = auth()->user()->reservations()->where('status', 'pending')->count();
    $acceptedReservations = auth()->user()->reservations()->where('status', 'accepted')->count();
    $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();
    
    return view('dashboard', compact('totalReservations', 'pendingReservations', 'acceptedReservations', 'announcements'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/status', [AdminController::class, 'updateStatus'])->name('reservations.status');
    Route::delete('/reservations/{reservation}', [AdminController::class, 'destroy'])->name('reservations.destroy');
    
    // Vouchers
    Route::get('/vouchers', [App\Http\Controllers\Admin\VoucherController::class, 'index'])->name('vouchers.index');
    Route::post('/vouchers', [App\Http\Controllers\Admin\VoucherController::class, 'store'])->name('vouchers.store');
    Route::delete('/vouchers/{voucher}', [App\Http\Controllers\Admin\VoucherController::class, 'destroy'])->name('vouchers.destroy');
    
    // Announcements
    Route::get('/announcements', [App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('announcements.index');
    Route::post('/announcements', [App\Http\Controllers\Admin\AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    // Inventory
    Route::get('inventory/print', [App\Http\Controllers\Admin\InventoryController::class, 'print'])->name('inventory.print');
    Route::resource('inventory-categories', App\Http\Controllers\Admin\InventoryCategoryController::class)->only(['store']);
    Route::resource('inventory', App\Http\Controllers\Admin\InventoryController::class)->except(['show']);

    // Fields
    Route::resource('fields', App\Http\Controllers\Admin\FieldController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}/pay', [ReservationController::class, 'paymentView'])->name('reservations.pay.view');
    Route::post('/reservations/{reservation}/pay', [ReservationController::class, 'pay'])->name('reservations.pay');
    Route::get('/reservations/{reservation}/print', [ReservationController::class, 'printPdf'])->name('reservations.print');
    
    // API
    Route::post('/api/check-voucher', [ReservationController::class, 'checkVoucher'])
        ->middleware('throttle:5,1')
        ->name('api.check.voucher');
        
    Route::get('/api/available-slots', [ReservationController::class, 'getAvailableSlots'])->name('api.available.slots');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
