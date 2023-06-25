<?php

use App\Http\Controllers\PayOrderController;
use Illuminate\Support\Facades\Route;
use YlsIdeas\FeatureFlags\Facades\Features;

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

Route::get('/', function () {
    return view('welcome');
});

// Contoh penerapan middleware feature di route
Route::get('/test1', function () {
    echo "Test 1 <br>";
    echo "Checking feature accessibility: <br>";

    // Checking feature accessibility (return true or false)
    dd(Features::accessible('laravel.version'));
})->middleware('feature:laravel.version');

Route::get('/test2', function () {
    echo "Test 2 <br>";
    echo "Checking feature accessibility: <br>";

    // Checking feature accessibility (return true or false)
    dd(Features::accessible('laravel.version'));
});

Route::get('/test3', function () {
    echo "Test 3 <br>";
    echo "Checking feature accessibility: <br>";

    // Checking feature accessibility (return true or false)
    dd(Features::accessible('laravel.version'));

    // Manual set feature accessibility with HTTP status code
})->middleware('feature:laravel.version,off,404');

Route::get('pay', [PayOrderController::class, 'store']);
