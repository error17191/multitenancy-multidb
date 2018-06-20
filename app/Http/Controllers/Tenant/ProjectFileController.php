<?php

namespace App\Http\Controllers\Tenant;

use App\File;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function store(Project $project, Request $request)
    {
        if ($path = Storage::disk('tenant')->putFile('/', $request->file('file'))) {
            $file = File::make([
                'name' => $request->file('file')->getClientOriginalName(),
                'path' => $path
            ]);

            $project->files()->save($file);
        }

        return back();
    }

    public function show(Project $project, File $file)
    {
        return Storage::disk('tenant')->download($file->path, $file->name);
    }
}
