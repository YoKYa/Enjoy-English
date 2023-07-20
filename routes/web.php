<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{Materi, Topics};
use App\Http\Livewire\Admin\{Users, Admin, Materi as AdminMateri, Topics as AdminTopics};

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', function(){
        return redirect(route('topics'));
    });
    // Route User
    Route::get('/topics', Topics::class)->name('topics');
    Route::get('/topic/{slug}', Materi::class)->name('materi');
    
    // Route Admin
    Route::prefix('admin')->group(function () {
        Route::get('/', Admin::class)->name('admin');
        Route::get('/users', Users::class)->name('admin.users');
        Route::get('/topics/{slug}', AdminMateri::class)->name('admin.materi');
    });
});
