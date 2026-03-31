#!/usr/bin/env bash
set -euo pipefail

# =========================
# ATLVS Template Laravel v1.0 (Laravel 11)
# - Docker (nginx + php-fpm + postgres + redis)
# - UI kit Blade + Tailwind + Alpine
# - RBAC simples (admin/user)
# - CRUD exemplo (Projects)
# - CI GitHub Actions
# =========================

mkdir -p \
  .github/workflows \
  docker/nginx docker/php \
  docs \
  app/Http/Middleware \
  app/Http/Controllers/Admin \
  app/Models \
  database/migrations database/seeders \
  routes \
  resources/views/components/ui \
  resources/views/components/form \
  resources/views/components/layout \
  resources/views/pages/admin/projects \
  resources/views/pages/admin \
  resources/css resources/js

# ---------- Docker ----------
cat > docker-compose.yml <<'YAML'
services:
  app:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    container_name: atlvs_app
    working_dir: /var/www/html
    volumes:
      - ./:/var/www/html
    depends_on:
      - db
      - redis

  nginx:
    image: nginx:alpine
    container_name: atlvs_nginx
    ports:
      - "8080:80"
    volumes:
      - ./:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app

  db:
    image: postgres:16-alpine
    container_name: atlvs_db
    environment:
      POSTGRES_DB: atlvs
      POSTGRES_USER: atlvs
      POSTGRES_PASSWORD: atlvs
    ports:
      - "5432:5432"
    volumes:
      - db_data:/var/lib/postgresql/data

  redis:
    image: redis:7-alpine
    container_name: atlvs_redis
    ports:
      - "6379:6379"

volumes:
  db_data:
YAML

cat > docker/nginx/default.conf <<'NGINX'
server {
  listen 80;
  server_name _;
  root /var/www/html/public;

  index index.php index.html;

  location / {
    try_files $uri $uri/ /index.php?$query_string;
  }

  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_pass app:9000;
    fastcgi_index index.php;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_param PATH_INFO $fastcgi_path_info;
  }

  location ~ /\.ht {
    deny all;
  }
}
NGINX

cat > docker/php/Dockerfile <<'DOCKER'
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash git unzip icu-dev oniguruma-dev libzip-dev postgresql-dev \
    nodejs npm

RUN docker-php-ext-install intl mbstring zip pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN addgroup -g 1000 www && adduser -G www -g www -s /bin/sh -D -u 1000 www
USER www

EXPOSE 9000
CMD ["php-fpm"]
DOCKER

# ---------- GitHub Actions ----------
cat > .github/workflows/ci.yml <<'YML'
name: CI

on:
  push:
    branches: [ "main" ]
  pull_request:
    branches: [ "main" ]

jobs:
  php:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          tools: composer:v2
          coverage: none

      - name: Install dependencies
        run: composer install --no-interaction --prefer-dist --no-progress

      - name: Copy env + key
        run: |
          cp .env.example .env
          php artisan key:generate

      - name: Run tests
        run: php artisan test

  node:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Setup Node
        uses: actions/setup-node@v4
        with:
          node-version: '20'

      - name: Install and build
        run: |
          npm ci
          npm run build
YML

# ---------- Docs ----------
cat > docs/FRONT_STANDARD.md <<'MD'
# Padrão Oficial de Front (ATLVS)

- Blade + Tailwind + Alpine
- Regra: se repetiu, vira componente.
- Tela monta, componente resolve.

Estrutura:
- resources/views/pages -> telas
- resources/views/components/ui -> primitives (button, card, modal...)
- resources/views/components/form -> field/errors
- resources/views/components/layout -> navbar/sidebar/app-shell
MD

cat > docs/MIDDLEWARE_SETUP.md <<'MD'
# Middleware Role — Laravel 11

Registre o alias no arquivo `bootstrap/app.php`:

Dentro de `->withMiddleware(...)`:

$middleware->alias([
  'role' => \App\Http\Middleware\RequireRole::class,
]);
MD

# ---------- RBAC Middleware ----------
cat > app/Http/Middleware/RequireRole.php <<'PHP'
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireRole
{
    /** Uso: ->middleware('role:admin') */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
PHP

# ---------- Model ----------
cat > app/Models/Project.php <<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'notes'];
}
PHP

# ---------- Controller ----------
cat > app/Http/Controllers/Admin/ProjectController.php <<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $projects = Project::query()
            ->when($q, fn($query) => $query->where('name', 'ilike', "%{$q}%"))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.projects.index', compact('projects', 'q'));
    }

    public function create()
    {
        return view('pages.admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'status' => ['required', 'in:active,paused,done'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Projeto criado com sucesso.');
    }

    public function edit(Project $project)
    {
        return view('pages.admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'status' => ['required', 'in:active,paused,done'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Projeto atualizado.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Projeto removido.');
    }
}
PHP

# ---------- Migrations ----------
cat > database/migrations/2026_02_05_000001_add_role_to_users_table.php <<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('user')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
PHP

cat > database/migrations/2026_02_05_000002_create_projects_table.php <<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('status', 20)->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
PHP

# ---------- Seeders ----------
cat > database/seeders/AdminUserSeeder.php <<'PHP'
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@atlvs.local'],
            [
                'name' => 'Admin ATLVS',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
PHP

# Atualiza DatabaseSeeder (sobrescreve)
cat > database/seeders/DatabaseSeeder.php <<'PHP'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
PHP

# ---------- Routes ----------
cat > routes/admin.php <<'PHP'
<?php

use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('pages.admin.dashboard');
        })->name('dashboard');

        Route::resource('projects', ProjectController::class)->except(['show']);
    });
PHP

cat > routes/web.php <<'PHP'
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

require __DIR__ . '/admin.php';
PHP

# ---------- Assets ----------
cat > resources/css/app.css <<'CSS'
@tailwind base;
@tailwind components;
@tailwind utilities;
CSS

cat > resources/js/app.js <<'JS'
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
JS

# ---------- Layout components ----------
cat > resources/views/components/layout/app.blade.php <<'BLADE'
@props(['title' => null])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
  {{ $slot }}
</body>
</html>
BLADE

cat > resources/views/components/layout/app-shell.blade.php <<'BLADE'
@props(['title' => null])

<x-layout-app :title="$title">
  <div class="min-h-screen flex">
    <x-layout-sidebar />
    <div class="flex-1 flex flex-col">
      <x-layout-navbar />
      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        {{ $slot }}
      </main>
    </div>
  </div>
</x-layout-app>
BLADE

cat > resources/views/components/layout/navbar.blade.php <<'BLADE'
<header class="sticky top-0 z-30 border-b bg-white/90 backdrop-blur">
  <div class="px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
    <a href="{{ route('admin.dashboard') }}" class="font-semibold hover:opacity-80">
      {{ config('app.name', 'ATLVS') }}
    </a>

    <x-ui-dropdown align="right">
      <x-slot:trigger>
        <button type="button" class="h-9 px-3 rounded-lg hover:bg-gray-100 text-sm font-medium">
          {{ auth()->user()->name ?? 'Conta' }}
        </button>
      </x-slot:trigger>

      <x-slot:content>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50">
            Sair
          </button>
        </form>
      </x-slot:content>
    </x-ui-dropdown>
  </div>
</header>
BLADE

cat > resources/views/components/layout/sidebar.blade.php <<'BLADE'
<aside class="hidden lg:flex lg:flex-col lg:w-64 border-r bg-white">
  <div class="h-14 px-4 flex items-center border-b">
    <div class="font-semibold">Painel</div>
  </div>

  <nav class="p-3 space-y-1">
    <a href="{{ route('admin.dashboard') }}"
      class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-50' : '' }}">
      Dashboard
    </a>

    <a href="{{ route('admin.projects.index') }}"
      class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-50' : '' }}">
      Projetos
    </a>
  </nav>
</aside>
BLADE

cat > resources/views/components/layout/page-header.blade.php <<'BLADE'
@props(['title', 'subtitle' => null])

<div class="mb-6 flex items-start justify-between gap-4">
  <div>
    <h1 class="text-xl sm:text-2xl font-semibold tracking-tight">{{ $title }}</h1>
    @if($subtitle)
      <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
    @endif
  </div>

  @isset($actions)
    <div class="flex items-center gap-2">
      {{ $actions }}
    </div>
  @endisset
</div>
BLADE

# ---------- UI components ----------
cat > resources/views/components/ui/button.blade.php <<'BLADE'
@props([
  'type' => 'button',
  'variant' => 'primary',
  'size' => 'md',
  'href' => null,
])

@php
  $base = 'inline-flex items-center justify-center rounded-xl font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 disabled:pointer-events-none';

  $sizes = [
    'sm' => 'h-9 px-3 text-sm',
    'md' => 'h-10 px-4 text-sm',
    'lg' => 'h-11 px-5 text-base',
  ];

  $variants = [
    'primary' => 'bg-gray-900 text-white hover:bg-gray-800 focus:ring-gray-900',
    'secondary' => 'bg-white text-gray-900 border border-gray-200 hover:bg-gray-50 focus:ring-gray-300',
    'ghost' => 'bg-transparent text-gray-900 hover:bg-gray-100 focus:ring-gray-300',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-600',
  ];

  $cls = $base.' '.($sizes[$size] ?? $sizes['md']).' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</button>
@endif
BLADE

cat > resources/views/components/ui/card.blade.php <<'BLADE'
@props(['padded' => true])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-2xl shadow-sm']) }}>
  @isset($header)
    <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
      {{ $header }}
    </div>
  @endisset

  <div class="{{ $padded ? 'px-4 sm:px-6 py-5' : '' }}">
    {{ $slot }}
  </div>

  @isset($footer)
    <div class="px-4 sm:px-6 py-4 border-t border-gray-100">
      {{ $footer }}
    </div>
  @endisset
</div>
BLADE

cat > resources/views/components/ui/alert.blade.php <<'BLADE'
@props(['variant' => 'info'])

@php
  $map = [
    'info' => 'bg-blue-50 text-blue-900 border-blue-100',
    'success' => 'bg-emerald-50 text-emerald-900 border-emerald-100',
    'warning' => 'bg-amber-50 text-amber-900 border-amber-100',
    'danger' => 'bg-red-50 text-red-900 border-red-100',
  ];
@endphp

<div {{ $attributes->merge(['class' => 'border rounded-2xl px-4 py-3 text-sm '.$map[$variant]]) }}>
  {{ $slot }}
</div>
BLADE

cat > resources/views/components/ui/badge.blade.php <<'BLADE'
@props(['variant' => 'default'])

@php
  $map = [
    'default' => 'bg-gray-100 text-gray-800',
    'success' => 'bg-emerald-100 text-emerald-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'danger' => 'bg-red-100 text-red-800',
  ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium '.$map[$variant]]) }}>
  {{ $slot }}
</span>
BLADE

cat > resources/views/components/ui/dropdown.blade.php <<'BLADE'
@props(['align' => 'left'])

@php
  $alignClass = $align === 'right' ? 'right-0' : 'left-0';
@endphp

<div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
  <div @click="open = !open">
    {{ $trigger }}
  </div>

  <div
    x-show="open"
    x-cloak
    @click.outside="open = false"
    class="absolute mt-2 min-w-48 {{ $alignClass }} rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden z-40"
  >
    <div class="py-1">
      {{ $content }}
    </div>
  </div>
</div>
BLADE

cat > resources/views/components/ui/table.blade.php <<'BLADE'
<div class="overflow-x-auto rounded-2xl border border-gray-200 bg-white">
  <table class="min-w-full text-sm">
    @isset($head)
      <thead class="bg-gray-50 text-gray-700">
        {{ $head }}
      </thead>
    @endisset

    <tbody class="divide-y divide-gray-100">
      {{ $slot }}
    </tbody>
  </table>
</div>
BLADE

cat > resources/views/components/ui/input.blade.php <<'BLADE'
@props(['name', 'type' => 'text'])
@php($hasError = $errors->has($name))

<input
  name="{{ $name }}"
  type="{{ $type }}"
  value="{{ old($name, $attributes->get('value')) }}"
  {{ $attributes->merge([
    'class' => 'h-10 w-full rounded-xl border px-3 text-sm outline-none transition focus:ring-2 focus:ring-offset-1 '
      . ($hasError ? 'border-red-300 focus:ring-red-300' : 'border-gray-200 focus:ring-gray-300')
  ]) }}
/>
BLADE

cat > resources/views/components/ui/select.blade.php <<'BLADE'
@props(['name'])
@php($hasError = $errors->has($name))

<select
  name="{{ $name }}"
  {{ $attributes->merge([
    'class' => 'h-10 w-full rounded-xl border px-3 text-sm outline-none transition focus:ring-2 focus:ring-offset-1 '
      . ($hasError ? 'border-red-300 focus:ring-red-300' : 'border-gray-200 focus:ring-gray-300')
  ]) }}
>
  {{ $slot }}
</select>
BLADE

cat > resources/views/components/ui/textarea.blade.php <<'BLADE'
@props(['name', 'rows' => 4])
@php($hasError = $errors->has($name))

<textarea
  name="{{ $name }}"
  rows="{{ $rows }}"
  {{ $attributes->merge([
    'class' => 'w-full rounded-xl border px-3 py-2 text-sm outline-none transition focus:ring-2 focus:ring-offset-1 '
      . ($hasError ? 'border-red-300 focus:ring-red-300' : 'border-gray-200 focus:ring-gray-300')
  ]) }}
>{{ old($name, $attributes->get('value')) }}</textarea>
BLADE

# ---------- Form components ----------
cat > resources/views/components/form/field.blade.php <<'BLADE'
@props(['label' => null, 'for' => null, 'hint' => null, 'required' => false])

<div class="space-y-1">
  @if($label)
    <label @if($for) for="{{ $for }}" @endif class="text-sm font-medium text-gray-900">
      {{ $label }} @if($required)<span class="text-red-600">*</span>@endif
    </label>
  @endif

  <div>{{ $slot }}</div>

  @if($hint)
    <p class="text-xs text-gray-500">{{ $hint }}</p>
  @endif

  {{ $errors ?? '' }}
</div>
BLADE

cat > resources/views/components/form/errors.blade.php <<'BLADE'
@props(['name'])

@error($name)
  <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
@enderror
BLADE

# ---------- Pages ----------
cat > resources/views/pages/admin/dashboard.blade.php <<'BLADE'
@php($title = 'Dashboard')

<x-layout-app-shell :title="$title">
  <x-layout-page-header title="Dashboard" subtitle="Base do painel administrativo (ATLVS Template v1.0).">
    <x-slot:actions>
      <x-ui-button :href="route('admin.projects.index')" variant="secondary">Projetos</x-ui-button>
    </x-slot:actions>
  </x-layout-page-header>

  @if(session('success'))
    <x-ui-alert variant="success" class="mb-4">{{ session('success') }}</x-ui-alert>
  @endif

  <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
    <x-ui-card><x-slot:header><div class="text-sm font-medium text-gray-700">Template</div></x-slot:header>
      <div class="text-2xl font-semibold">v1.0</div>
    </x-ui-card>

    <x-ui-card><x-slot:header><div class="text-sm font-medium text-gray-700">RBAC</div></x-slot:header>
      <div class="text-2xl font-semibold">admin/user</div>
    </x-ui-card>

    <x-ui-card><x-slot:header><div class="text-sm font-medium text-gray-700">Stack</div></x-slot:header>
      <div class="text-sm text-gray-700">Laravel 11 + Blade + Tailwind + Alpine + Docker</div>
    </x-ui-card>
  </div>
</x-layout-app-shell>
BLADE

cat > resources/views/pages/admin/projects/index.blade.php <<'BLADE'
@php($title = 'Projetos')

<x-layout-app-shell :title="$title">
  <x-layout-page-header title="Projetos" subtitle="CRUD de exemplo do template ATLVS.">
    <x-slot:actions>
      <x-ui-button :href="route('admin.projects.create')">Novo</x-ui-button>
    </x-slot:actions>
  </x-layout-page-header>

  @if(session('success'))
    <x-ui-alert variant="success" class="mb-4">{{ session('success') }}</x-ui-alert>
  @endif

  <x-ui-card>
    <x-slot:header>
      <form method="GET" class="flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
        <div>
          <div class="font-semibold">Lista</div>
          <div class="text-sm text-gray-600">Busca e ações padronizadas.</div>
        </div>

        <div class="w-full sm:w-72">
          <x-ui-input name="q" :value="$q" placeholder="Buscar por nome..." />
        </div>
      </form>
    </x-slot:header>

    <x-ui-table>
      <x-slot:head>
        <tr>
          <th class="text-left px-4 py-3 font-medium">Nome</th>
          <th class="text-left px-4 py-3 font-medium">Status</th>
          <th class="text-right px-4 py-3 font-medium">Ações</th>
        </tr>
      </x-slot:head>

      @forelse($projects as $project)
        <tr>
          <td class="px-4 py-3">{{ $project->name }}</td>
          <td class="px-4 py-3">
            @php($map = ['active' => 'success', 'paused' => 'warning', 'done' => 'default'])
            <x-ui-badge :variant="$map[$project->status] ?? 'default'">{{ $project->status }}</x-ui-badge>
          </td>
          <td class="px-4 py-3 text-right">
            <x-ui-dropdown align="right">
              <x-slot:trigger>
                <button class="h-9 px-3 rounded-lg hover:bg-gray-100 text-sm">Opções</button>
              </x-slot:trigger>
              <x-slot:content>
                <a href="{{ route('admin.projects.edit', $project) }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Editar</a>
                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Remover este projeto?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50">Remover</button>
                </form>
              </x-slot:content>
            </x-ui-dropdown>
          </td>
        </tr>
      @empty
        <tr>
          <td class="px-4 py-6 text-center text-gray-600" colspan="3">Nenhum projeto encontrado.</td>
        </tr>
      @endforelse
    </x-ui-table>

    <x-slot:footer>
      {{ $projects->links() }}
    </x-slot:footer>
  </x-ui-card>
</x-layout-app-shell>
BLADE

cat > resources/views/pages/admin/projects/_form.blade.php <<'BLADE'
@props(['action', 'method' => 'POST', 'project' => null])

<form method="POST" action="{{ $action }}" class="space-y-4">
  @csrf
  @if($method !== 'POST') @method($method) @endif

  <x-form-field label="Nome" for="name" required>
    <x-ui-input name="name" id="name" :value="old('name', $project?->name)" placeholder="Ex.: Projeto Academia" />
    <x-slot:errors><x-form-errors name="name" /></x-slot:errors>
  </x-form-field>

  <x-form-field label="Status" for="status" required hint="active/paused/done">
    @php($val = old('status', $project?->status ?? 'active'))
    <x-ui-select name="status" id="status">
      <option value="active" @selected($val==='active')>active</option>
      <option value="paused" @selected($val==='paused')>paused</option>
      <option value="done" @selected($val==='done')>done</option>
    </x-ui-select>
    <x-slot:errors><x-form-errors name="status" /></x-slot:errors>
  </x-form-field>

  <x-form-field label="Notas" for="notes" hint="Opcional">
    <x-ui-textarea name="notes" id="notes" rows="4" :value="old('notes', $project?->notes)" />
    <x-slot:errors><x-form-errors name="notes" /></x-slot:errors>
  </x-form-field>

  <div class="flex justify-end gap-2 pt-2">
    <x-ui-button variant="ghost" :href="route('admin.projects.index')">Cancelar</x-ui-button>
    <x-ui-button type="submit">Salvar</x-ui-button>
  </div>
</form>
BLADE

cat > resources/views/pages/admin/projects/create.blade.php <<'BLADE'
@php($title = 'Novo projeto')

<x-layout-app-shell :title="$title">
  <x-layout-page-header title="Novo projeto" subtitle="Cadastro seguindo o padrão ATLVS." />
  <x-ui-card>
    @include('pages.admin.projects._form', [
      'action' => route('admin.projects.store'),
      'method' => 'POST',
      'project' => null,
    ])
  </x-ui-card>
</x-layout-app-shell>
BLADE

cat > resources/views/pages/admin/projects/edit.blade.php <<'BLADE'
@php($title = 'Editar projeto')

<x-layout-app-shell :title="$title">
  <x-layout-page-header title="Editar projeto" subtitle="Edição seguindo o padrão ATLVS." />
  <x-ui-card>
    @include('pages.admin.projects._form', [
      'action' => route('admin.projects.update', $project),
      'method' => 'PUT',
      'project' => $project,
    ])
  </x-ui-card>
</x-layout-app-shell>
BLADE

echo "✅ ATLVS Template v1.0 aplicado. Próximo passo: configurar middleware alias (Laravel 11) e auth."
