<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function index()
    {
        $tasks = Task::all()->sortByDesc('id')->values()->map->mapForDashboard()->toArray();
        return Inertia::render('Dashboard', ['tasks' => $tasks]);
    }

    public function search(Request $request, string $search_term)
    {
        $tasks = (Task::all()
            ->sortByDesc('id')
            ->values()
            ->filter(fn($it) => \Str::of($it->title)->lower()->contains(\Str::of($search_term)->lower()))
            ->map
            ->mapForSearch())
            ->toArray();
        return JsonResource::make($tasks);
    }
}
