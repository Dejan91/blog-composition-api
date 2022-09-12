<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\Admin\PostEditController as AdminPostEditController;
use App\Http\Controllers\Admin\PostStoreCntroller as AdminPostStoreController;
use App\Http\Controllers\Admin\PostIndexController as AdminPostIndexController;
use App\Http\Controllers\Admin\PostPatchController as AdminPostPatchController;
use App\Http\Controllers\Admin\PostDestroyController as AdminPostDestroyController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', PostIndexController::class)->name('posts.index');
Route::get('/posts/{post:slug}', PostShowController::class)->name('posts.show');

Route::get('/admin/posts', AdminPostIndexController::class)->name('admin.posts.index');
Route::post('/admin/posts', AdminPostStoreController::class)->name('admin.posts.store');
Route::get('/admin/posts/{post:uuid}/edit', AdminPostEditController::class)->name('admin.posts.store');
Route::patch('/admin/posts/{post:uuid}', AdminPostPatchController::class)->name('admin.posts.patch');
Route::delete('/admin/posts/{post:uuid}', AdminPostDestroyController::class)->name('admin.posts.destroy');