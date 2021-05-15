<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Stream;
use Auth;
use Redirect;
use Str;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Settings/Index', [
            'stream_key' => Auth::user()->stream_key
        ]);
    }

    public function resetKey()
    {
        while(true){
            $key = Str::random(40);
            $existingKey = User::where('stream_key', $key)->first();

            if(!$existingKey){
                $user = Auth::user();
                $user->update([
                    'stream_key' => $key
                ]);

                return Redirect::route('settings.index');
            }
        }
    }
}
