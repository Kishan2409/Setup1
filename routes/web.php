<?php

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
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

Route::get('/', function () {
    // return view('admin.files.layouts');
    return redirect()->route('login');
});

//('/login' to '/admin/login')
Route::get('/login', function () {
    return redirect()->route('login');
});

//('/register' to '/admin/register')
Route::get('/register', function () {
    return redirect()->route('register');
});

//('/admin' to '/admin/login')
Route::get('/admin', function () {
    return redirect('/admin/login');
});

//('/admin')
Route::group(['prefix' => 'admin', 'middleware' => 'disable-back'], function () {

    //dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // auth route
    Route::middleware('auth')->group(function () {
        //profile setting
        Route::get('/setting', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/setting', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/setting', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //web setting
        Route::post('/setting', [SettingsController::class, 'store'])->name('setting.store');

        //slider
        Route::get('/slider', [SliderController::class, 'index'])->name('slider');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/slider/create', [SliderController::class, 'store']);
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/slider/edit/{id}', [SliderController::class, 'update']);
        Route::get('/slider/show/{id}', [SliderController::class, 'show'])->name('slider.show');
        Route::get('/slider/delete', [SliderController::class, 'destroy'])->name('slider.destroy');
        Route::get('/slider/status', [SliderController::class, 'status'])->name('slider.status');
    });
});

require __DIR__ . '/auth.php';
