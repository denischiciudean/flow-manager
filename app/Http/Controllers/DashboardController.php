<?php

namespace App\Http\Controllers;

use App\Components\TimeHelpers;
use App\Models\Task;
use Inertia\Inertia;

class DashboardController extends Controller
{


    public function index()
    {
        $tasks = Task::all()->sortByDesc('id')->values()->map(fn($it) => [
            'id' => $it->id,
            'title' => $it->title,
            'description' => $it->description,
            'department_path' => $it->department->ancestorsAndSelf()->get()->sortBy('id')->map(fn($dep) => $dep->name)->toArray(), #here we will make the path generation
            'created' => TimeHelpers::convertTimestampToDayHoursLeft($it->created_at, 'Acum {days} zile, {hours} ore ({date})'),
            'assigned_to' => $it->currentStep && $it->currentStep->assignedTo ? 'Atribuit lui ' . $it->currentStep->assignedTo->name . ' acum ' . TimeHelpers::convertTimestampToDayHoursLeft($it->currentStep->updated_at, '{days} zile, {hours} ore') : 'Neatribuit',
            'expires_at' => TimeHelpers::timeLeft($it->expires_at->timestamp)[1]
        ])->toArray();
        return Inertia::render('Dashboard', ['tasks' => $tasks]);
    }
}
