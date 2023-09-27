<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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
    return view('user.index');
});

Route::get('/dashboard', function () {
    return view('user.dashboard.user_dashboard');
})->middleware(['auth', 'verified','user'])->name('dashboard');

Route::middleware('auth','user')->group(function () {
    Route::get('/profile', [UserController::class, 'page'])->name('user.profile');
    Route::post('/user/profile/update',[UserController::class,'userProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/password/change',[UserController::class,'userChangePassword'])->name('user.password.change');



});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update',[AdminController::class,'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');


    //Team List
    Route::prefix('team')->controller(TeamController::class)->group(function(){
        Route::get('list','teamList')->name('team.list');
    });


});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

