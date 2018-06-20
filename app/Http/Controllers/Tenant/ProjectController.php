<?php

namespace App\Http\Controllers\Tenant;

use App\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = cache()->remember('projects', 10, function () {
            return Project::all();
        });
        return view('tenant.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Project::create([
            'name' => $request->name
        ]);

        cache()->forget('projects');

        return back();
    }

    public function show(Project $project)
    {
        return view('tenant.projects.show', compact('project'));
    }
}
