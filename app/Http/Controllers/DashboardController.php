<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        $status = $request->has('status') ? $request->get('status') : 'toate';

        $user = auth()->user();

        $tasks = Task::all()->sortByDesc('id')
            ->values()
            /**
             * Expires in less than 3 days
             */
            ->when($status == 'expira', function ($it) {
                return $it->filter(function ($task) {
                    return $task->expires_at->startOfDay()->timestamp >= now()->subDays(3)->startOfDay()->timestamp;
                });
            })
            ->map->mapForDashboard()->toArray();
        $messages = $user
            ->mentions()
            ->limit(5)
            ->with(['reply.task', 'reply.user'])
            ->get()
            ->pluck('reply')
            ->flatten()
            ->sortByDesc('id')
            ->values();

        if ($messages) {
            $messages = $messages->map
                ->formatForDashboard();
        }

        return Inertia::render('Dashboard', ['tasks' => $tasks, 'messages' => $messages->toArray()]);
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
