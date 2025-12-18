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

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

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

    Route::resource('events', EventController::class)->only(['index','create','store','edit','update','destroy']);

    Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::resource('bookings', BookingController::class);

    // Hapus akun admin sendiri
    Route::delete('account', [AuthController::class, 'destroy'])->name('account.destroy');
    // });
});

// Route::prefix('admin')->group(function () {
//     Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
//     Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');
//     // Route admin lain di sini
//     Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
// });

Route::get('/sejarah', function () {
    $history = \App\Models\AboutPage::where('section', 'history')->with('historyImages')->first();
    return view('sejarah', compact('history'));
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

Route::post('/galeri/{id}/like', [App\Http\Controllers\GalleryController::class, 'like'])->name('galeri.like');

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $articles = \App\Models\Article::latest()->take(4)->get();
    $maps_link = \App\Models\AboutPage::where('section', 'maps')->value('content') ?? 'https://www.google.com/maps';
    $maps_btn_link = \App\Models\AboutPage::where('section', 'maps_link')->value('content') ?? 'https://www.google.com/maps';
    return view('home', compact('articles', 'maps_link', 'maps_btn_link'));
});

Route::get('/galeri', [App\Http\Controllers\GalleryController::class, 'index'])->name('galeri');

Route::get('/acara', function () {
    $events = \App\Models\Event::orderBy('event_date', 'desc')->get();
    return view('acara', compact('events'));
});

Route::get('/tentang', function () {
    $about = \App\Models\AboutPage::where('section', 'about')->value('content');
    $contact = \App\Models\AboutPage::where('section', 'contact')->value('content');
    return view('tentang', compact('about', 'contact'));
});

Route::get('/pesan-tiket', function () {
    return view('pesan-tiket');
});

Route::post('/pesan-tiket', [App\Http\Controllers\TicketController::class, 'store'])->name('pesan-tiket.store');

Route::get('/pembayaran-berhasil', function () {
    return view('pembayaran-berhasil');
})->name('pembayaran-berhasil');

Route::get('/pembayaran-pending/{id}', [App\Http\Controllers\TicketController::class, 'showPending'])->name('pembayaran-pending');
Route::get('/check-payment-status/{id}', [App\Http\Controllers\TicketController::class, 'checkStatus'])->name('check-payment-status');
Route::post('/booking/{id}/cancel', [App\Http\Controllers\TicketController::class, 'cancel'])->name('booking.cancel');
Route::get('/booking/{id}/konfirmasi', [App\Http\Controllers\TicketController::class, 'showConfirmation'])->name('booking.confirmation');
Route::post('/booking/{id}/konfirmasi', [App\Http\Controllers\TicketController::class, 'submitConfirmation'])->name('booking.confirmation.submit');


