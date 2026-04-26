<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectStoreRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');
        $category = (string) $request->query('category', '');
        $status = (string) $request->query('status', '');

        $projects = Project::query()
            ->select(['id', 'title', 'description', 'category', 'duration', 'is_active', 'updated_at'])
            ->when($q, function ($query) use ($q) {
                $query->where(function ($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('category', 'like', "%{$q}%");
                });
            })
            ->when($category, fn ($query) => $query->where('category', $category))
            ->when($status !== '', fn ($query) => $query->where('is_active', $status === 'active'))
            ->latest('updated_at')
            ->paginate(8)
            ->withQueryString();

        $categories = Project::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('pages.admin.projects.index', compact('projects', 'q', 'category', 'status', 'categories'));
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
            ->with('success', 'Solucao criada com sucesso.');
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
            ->with('success', 'Solucao atualizada com sucesso.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Solucao removida com sucesso.');
    }
}
