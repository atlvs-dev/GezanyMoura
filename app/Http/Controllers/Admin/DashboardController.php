<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $metrics = [
            'active_projects' => Project::query()->where('is_active', true)->count(),
            'inactive_projects' => Project::query()->where('is_active', false)->count(),
            'categories' => Project::query()->distinct('category')->count('category'),
            'admins' => User::query()->where('role', 'admin')->count(),
        ];

        $recentProjects = Project::query()
            ->select(['id', 'title', 'category', 'duration', 'is_active', 'updated_at'])
            ->latest('updated_at')
            ->limit(5)
            ->get();

        return view('pages.admin.dashboard', compact('metrics', 'recentProjects'));
    }
}
