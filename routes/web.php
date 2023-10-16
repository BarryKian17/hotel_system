<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookAreaController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\UserRoomController;

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

Route::get('/',[UserController::class,'index'])->name('user.index');
Route::get('/dashboard', function () {
    return view('user.dashboard.user_dashboard');
})->middleware(['auth', 'verified','user'])->name('dashboard');

Route::middleware('auth','user')->group(function () {
    Route::get('/profile', [UserController::class, 'page'])->name('user.profile');
    Route::post('/user/profile/update',[UserController::class,'userProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/password/change',[UserController::class,'userChangePassword'])->name('user.password.change');

    //User CheckOut View
    Route::prefix('user')->controller(BookingController::class)->group(function(){
        Route::get('check/out','checkOut')->name('user.check.out');
        Route::post('booking/store/{id}','bookingStore')->name('user.booking.store');

    });


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
        Route::get('team/add','addPage')->name('team.add.page');
        Route::post('team/add/date','add')->name('team.add');
        Route::get('edit/{id}','editPage')->name('team.edit');
        Route::post('team/update','update')->name('team.update');
        Route::get('delete/{id}','delete')->name('team.delete');
    });

    //Room Type
    Route::prefix('room/type')->controller(RoomTypeController::class)->group(function(){
        Route::get('list','list')->name('room.type.list');
        Route::get('add/page','addPage')->name('room.type.add.page');
        Route::post('create','create')->name('room.type.create');

    });

    //Room Type
    Route::prefix('room')->controller(RoomController::class)->group(function(){
        Route::get('edit/{id}','edit')->name('room.edit');
        Route::post('update/{id}','update')->name('room.update');
        Route::get('delete/multiImg/{id}','deleteMulti')->name('room.delete.multiImg');
        Route::post('number/create','create')->name('room.number.create');
        Route::get('number/edit/{id}','numberEdit')->name('room.number.edit');
        Route::post('number/update/{id}','numberUpdate')->name('room.number.update');
        Route::get('number/delete/{id}','numberDelete')->name('room.number.delete');
        Route::get('delete/all/{id}','deleteAll')->name('room.delete.all');
    });

    //Booking Area
    Route::get('booking/area/page',[BookAreaController::class,'page'])->name('book.area.page');
    Route::post('booking/area/update',[BookAreaController::class,'update'])->name('book.area.update');


});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

//User Room View
Route::prefix('user/room')->controller(UserRoomController::class)->group(function(){
    Route::get('list','list')->name('user.room.list');
    Route::get('detail/{id}','detail')->name('user.room.detail');
    Route::get('booking/search','bookSearch')->name('user.book.search');
    Route::get('search/detail/{id}','detailSearch')->name('user.search_room_detail');
    Route::get('check_room_availability','checkAvailability')->name('check_room_availability');

});
