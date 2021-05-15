<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Stream;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("stream-auth", function(Request $request){
    $user = User::where('stream_key', $request->input('name'))->first();
    if($user){
        Stream::setViewCount($user->username);
        $url = 'rtmp://142.93.245.216:1935/live/' . $user->username;
        return redirect($url);
    }
    abort(404);
});

Route::post("remove-stream", function(Request $request){
    \Log::debug('stream ended');
    $user = User::where('stream_key', $request->input('name'))->first();
    \Log::debug($user);
    if($user){
        Stream::removeStream($user->username);
    }
});
