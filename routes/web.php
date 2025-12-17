<?php


// Route dashboard admin (sementara tampilkan halaman sederhana)

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\BookingController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Jika ingin pakai middleware admin, aktifkan baris berikut:
    // Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('history', [\App\Http\Controllers\Admin\HistoryController::class, 'show'])->name('history');
    Route::post('history', [\App\Http\Controllers\Admin\HistoryController::class, 'update'])->name('history.update');
    Route::post('history/images', [\App\Http\Controllers\Admin\HistoryController::class, 'uploadImages'])->name('history.images.upload');
    Route::post('history/image/{id}', [\App\Http\Controllers\Admin\HistoryController::class, 'deleteImage'])->name('history.image.delete');
    Route::get('maps', [\App\Http\Controllers\Admin\MapsController::class, 'show'])->name('maps');
    Route::post('maps', [\App\Http\Controllers\Admin\MapsController::class, 'update'])->name('maps.update');
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class)->only(['index','create','store','edit','update','destroy']);
    Route::get('about', [\App\Http\Controllers\Admin\AboutController::class, 'show'])->name('about');
    Route::post('about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');

    Route::resource('galleries', GalleryController::class)->only(['index','show','destroy']);
    Route::post('galleries/{gallery}/approve', [GalleryController::class,'approve'])->name('galleries.approve');
    Route::post('galleries/{gallery}/reject', [GalleryController::class,'reject'])->name('galleries.reject');
    Route::get('galleries/deletion-requests', [GalleryController::class,'deletionRequests'])->name('galleries.deletion_requests');
    Route::post('galleries/{gallery}/approve-deletion', [GalleryController::class,'approveDeletion'])->name('galleries.approve_deletion');
    Route::post('galleries/{gallery}/deny-deletion', [GalleryController::class,'denyDeletion'])->name('galleries.deny_deletion');

    Route::resource('events', EventController::class)->only(['index','create','store','destroy']);

    Route::resource('bookings', BookingController::class)->only(['index','show','destroy']);

    // Hapus akun admin sendiri
    Route::delete('account', [AuthController::class, 'destroy'])->name('account.destroy');
    // });
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');
    // Route admin lain di sini
    Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/sejarah', function () {
    return view('sejarah');
})->name('sejarah');


// Galeri upload, detail, hapus
Route::get('/galeri/upload', function () {
    return view('galeri-upload');
})->name('galeri.upload');

Route::post('/galeri/upload', [App\Http\Controllers\GalleryController::class, 'store'])->name('galeri.store');

Route::get('/galeri/{id}', [App\Http\Controllers\GalleryController::class, 'show'])->name('galeri.detail');

Route::get('/galeri/{id}/hapus', function ($id) {
    return view('galeri-hapus', compact('id'));
})->name('galeri.hapus');

Route::post('/galeri/{id}/hapus', [App\Http\Controllers\GalleryController::class, 'requestDelete'])->name('galeri.requestDelete');

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/galeri', [App\Http\Controllers\GalleryController::class, 'index'])->name('galeri');

Route::get('/acara', function () {
    return view('acara');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/pesan-tiket', function () {
    return view('pesan-tiket');
});

Route::post('/pesan-tiket', [App\Http\Controllers\TicketController::class, 'store'])->name('pesan-tiket.store');

Route::get('/pembayaran-berhasil', function () {
    return view('pembayaran-berhasil');
})->name('pembayaran-berhasil');


