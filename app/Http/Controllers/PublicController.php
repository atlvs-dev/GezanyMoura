<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Busca todos os serviços ativos que inserimos via Seeder
        $services = Project::where('is_active', true)->get();

        // Retorna a view 'welcome' passando os dados
        return view('welcome', compact('services'));
    }
}