<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get( '/', function () {
//	return view( 'welcome' );
//} );

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::middleware( [ 'auth', 'verified' ] )->group( function () {
	Route::get( '/', [ TodoController::class, 'index' ] )->name( 'dashboard' );
	Route::resource( '/todo', TodoController::class );
	Route::post( '/done/{id}', [ TodoController::class, 'done' ] )->name( 'done' );
} );

require __DIR__ . '/auth.php';
