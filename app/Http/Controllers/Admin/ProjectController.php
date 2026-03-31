<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');

        $projects = Project::query()
            ->when($q, fn ($query) => $query->where('name', 'like', "%{$q}%"))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.projects.index', compact('projects', 'q'));
    }

    public function create()
    {
        return view('pages.admin.projects.create');
    }

    public function store(ProjectStoreRequest $request)
    {
        Project::create($request->validated());

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projeto criado com sucesso.');
    }

    public function edit(Project $project)
    {
        return view('pages.admin.projects.edit', compact('project'));
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projeto atualizado.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projeto removido.');
    }
}
