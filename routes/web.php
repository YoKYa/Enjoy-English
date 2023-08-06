<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{Materi, Topics};
use App\Http\Livewire\Admin\{Users, Admin, Lessons, Materi as AdminMateri, Practice, Test};

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
    Route::get('/topics/{id}', Materi::class)->name('materi');
    
    // Route Admin
    Route::prefix('admin')->group(function () {
        Route::get('/', Admin::class)->name('admin');
        Route::get('/users', Users::class)->name('admin.users');
        Route::get('/topics/{id}', AdminMateri::class)->name('admin.materi');
        Route::get('/lessons/{slug}', Lessons::class)->name('admin.lessons');
        Route::get('/practice/{slug}', Practice::class)->name('admin.practice');
        Route::get('/test/{slug}', Test::class)->name('admin.test');
        
    });
});
