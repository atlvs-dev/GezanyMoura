<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectStoreRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');
        $category = (string) $request->query('category', '');
        $status = (string) $request->query('status', '');

        $projects = Project::query()
            ->select(['id', 'title', 'description', 'category', 'duration', 'is_active', 'updated_at'])
            ->withCount('images')
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
        $project = Project::create($this->projectData($request->validated()));

        $this->storeImages($request, $project);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Solucao criada com sucesso.');
    }

    public function edit(Project $project)
    {
        $project->load('images');

        return view('pages.admin.projects.edit', compact('project'));
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->update($this->projectData($validated));

        $this->removeImages($project, $validated['remove_image_ids'] ?? []);
        $this->storeImages($request, $project);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Solucao atualizada com sucesso.');
    }

    public function destroy(Project $project)
    {
        $project->load('images');
        $project->images->each(fn (ProjectImage $image) => Storage::disk('public')->delete($image->path));

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Solucao removida com sucesso.');
    }

    private function projectData(array $validated): array
    {
        return Arr::except($validated, ['images', 'remove_image_ids']);
    }

    private function storeImages(Request $request, Project $project): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $nextOrder = (int) $project->images()->max('sort_order') + 1;

        foreach ($request->file('images') as $image) {
            $path = $image->store('projects', 'public');

            $project->images()->create([
                'path' => $path,
                'original_name' => $image->getClientOriginalName(),
                'sort_order' => $nextOrder++,
            ]);
        }
    }

    private function removeImages(Project $project, array $imageIds): void
    {
        if ($imageIds === []) {
            return;
        }

        $project->images()
            ->whereIn('id', $imageIds)
            ->get()
            ->each(function (ProjectImage $image): void {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            });
    }
}
