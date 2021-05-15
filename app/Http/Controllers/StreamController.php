<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stream;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class StreamController extends Controller
{
    public function index(Stream $stream)
    {
        $streams = Redis::zrevrange('top-streams', 0, 10, true);
    
        $output = [];
        foreach($streams as $key => $val){
            $output[] = [
                'username' => $key,
                'viewers' => $val
            ];
        }

        return Inertia::render('Stream/Index', [
            'streams' => $output,
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Stream/Show', [
            'id' => $user->username
        ]);
    }
}
