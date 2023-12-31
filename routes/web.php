<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


/**
 * LOGIN
 * Route, listen to the GET /login url request, trigger LoginController@create method
 */
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])/*->name('login ')*/;
/**
 * ->middleware('auth') = the user must be logged in, in order to do a logout. That is why we use
 * here the auth middleware.
 */
Route::post('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');



Route::middleware('auth')->group(function () {

  Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');

  Route::inertia('/', 'Home');//this is a shorter way of returning a Vue component, without controller
  Route::inertia('/settings', 'Settings');

  //USERS
  Route::get('/users', [UsersController::class, 'index']);//lists users
  
  /**
   * ->middleware('can:create, App\Models\User');   <- here we use the UserPolicy.php.
   * Only allow this route, if the user can create a new user.
   */
  Route::get('/users/create', [UsersController::class, 'create'])->middleware('can:create, App\Models\User');
  Route::post('/users', [UsersController::class, 'store']);

  //PROFILES
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// require __DIR__.'/auth.php';//THIS MUST BE TURNED ON LATER!!!
