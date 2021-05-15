<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Redis;

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

Route::get('/temp', function(){
    $redis = Redis::connection();

    $redis->set('user_details', json_encode([
            'first_name' => 'Alex', 
            'last_name' => 'Richards'
        ])
    );
});

Route::get('/', [StreamController::class, 'index'])->name('stream.index');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/reset-key', [SettingsController::class, 'resetKey'])->name('settings.resetKey');
});

Route::get('/{user:username}', [StreamController::class, 'show'])->name('stream.show');
