<?php

use App\Spiders\RbkSpider;
use Illuminate\Support\Facades\Route;
use RoachPHP\Roach;
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

Route::get('/', [\App\Http\Controllers\FeedController::class, 'getAll']);
Route::get('/post/{feed}', [\App\Http\Controllers\FeedController::class, 'show']);
