<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $messages = $user->mentions()->with(['reply'])->get()->pluck('reply')->flatten()->unique()->map->formatForMessages();
        return Inertia::render('Messages/Messages', [
            'messages' => $messages
        ]);
    }
}
