<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    \Log::debug('TESTING');
    return false;
    return (int) $user->id === (int) $id;
});

Broadcast::channel('stream.{id}', function($user, $id){
    \Log::debug('this route was hit');
    return ['name' => \Str::random(40)];
});
