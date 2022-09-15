<?php

use App\Http\Controllers\Admin\{
    CategoryController,
    NoticeController,
    PostController,
    RecordController,
    UserController,
};
use App\Http\Controllers\Site\{
    HomeController,
    NoticeController as SiteNoticeController,
    PostController as SitePostController,
};

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::post('/', [HomeController::class, 'search'])->name('search');

#Posts
Route::prefix('post')->group(function(){
    Route::get('/todos-posts', [SitePostController::class, 'index'])->name('site.post.index');
    Route::get('{post:slug}', [SitePostController::class, 'show'])->name('site.post.show');
});

#Notícias
Route::prefix('noticias')->group(function(){
    Route::get('/todas-noticias', [SiteNoticeController::class, 'index'])->name('site.notice.index');
    Route::get('{notice:slug}', [SiteNoticeController::class, 'show'])->name('site.notice.show');
});

#Autenticado
Route::middleware(['auth', 'verified'])->group(function(){
    Route::post('notica/comentario', [SiteNoticeController::class, 'comment'])->name('site.notice.comment');
    Route::post('post/gostei', [SitePostController::class, 'like'])->name('site.post.like');
    Route::post('notica/gostei', [SiteNoticeController::class, 'like'])->name('site.notice.like');
});

#Rotas do Admin
Route::middleware(['auth', 'verified', 'admin'])->group(function() {

    Route::get('/dashboard', function(){
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class);
    Route::resource('records', RecordController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('notices', NoticeController::class);
});

require __DIR__.'/auth.php';
