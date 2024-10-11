<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\MentorController;
use App\Http\Controllers\Student\AppointmentController;
use App\Http\Controllers\Student\FeedbackController;
use App\Http\Controllers\Student\ClassroomController;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Student\CommunityController;
use App\Http\Controllers\Student\TeamChartController;
use App\Http\Controllers\Student\SettingsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ForumPostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/classroom', [ClassroomController::class, 'index'])->name('classroom');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::get('/teamchart', [TeamChartController::class, 'index'])->name('teamchart');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/community', [ForumPostController::class, 'index'])->name('community.index');
    Route::post('/community', [ForumPostController::class, 'store'])->name('community.store');
    Route::put('/community/{post}', [ForumPostController::class, 'update'])->name('community.update');
    Route::delete('/community/{post}', [ForumPostController::class, 'destroy'])->name('community.destroy');
    Route::post('/community/{post}/reply', [ForumPostController::class, 'reply'])->name('community.reply');
    Route::post('/community/{post}/like', [ForumPostController::class, 'like'])->name('community.like');
});
    Route::get('/classroom', [ClassroomController::class, 'index'])->name('classroom');
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function () {
    Route::get('/community', [ForumPostController::class, 'index'])->name('community.index');
    Route::post('/community', [ForumPostController::class, 'store'])->name('community.store');
    Route::put('/community/{post}', [ForumPostController::class, 'update'])->name('community.update');
    Route::delete('/community/{post}', [ForumPostController::class, 'destroy'])->name('community.destroy');
    Route::post('/community/{post}/reply', [ForumPostController::class, 'reply'])->name('community.reply');
    Route::post('/community/{post}/like', [ForumPostController::class, 'like'])->name('community.like');
});

// require __DIR__.'/auth.php';

Route::post('/community/{post}/like', [ForumPostController::class, 'like'])->name('community.like');

Route::get('/community/{reply}/edit', [ForumPostController::class, 'editReply'])->name('community.reply.edit');
Route::put('/community/reply/{reply}', [ForumPostController::class, 'updateReply'])->name('community.reply.update');
Route::delete('/community/{reply}', [ForumPostController::class, 'deleteReply'])->name('community.reply.delete');
Route::delete('/community/reply/{reply}', [ForumPostController::class, 'deleteReply'])->name('community.reply.delete');
