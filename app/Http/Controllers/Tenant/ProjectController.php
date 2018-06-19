<?php

namespace App\Http\Controllers\Tenant;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = cache()->remember("projects-{$request->tenant->id}", 10, function () {
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

        return back();
    }

    public function show(Project $project)
    {
        return $project;
    }
}
