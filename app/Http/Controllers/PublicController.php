<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Schema;
class PublicController extends Controller
{
    public function index()
    {
        if (! Schema::hasTable('projects')) {
            return view('welcome', ['services' => collect()]);
        }

        $services = Project::query()
            ->where('is_active', true)
            ->with('images')
            ->select(['id', 'title', 'description', 'category', 'duration'])
            ->latest()
            ->get();

        return view('welcome', compact('services'));
    }
}
