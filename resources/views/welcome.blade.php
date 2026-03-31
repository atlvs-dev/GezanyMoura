<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'ATLVS') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50">
  {{-- Top bar --}}
  <header class="sticky top-0 z-30 border-b border-gray-200 bg-white/90 backdrop-blur">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="h-9 w-9 rounded-xl bg-gray-900 text-white grid place-items-center text-sm font-semibold">
          A
        </div>
        <div class="leading-tight">
          <div class="text-sm font-semibold tracking-tight text-gray-900">ATLVS</div>
          <div class="text-xs text-gray-500">Laravel Template</div>
        </div>
      </div>

      <nav class="flex items-center gap-2">
        @auth
          <a href="{{ route('admin.dashboard') }}"
             class="h-9 px-3 rounded-xl bg-gray-900 text-white text-sm font-medium grid place-items-center hover:bg-gray-800">
            Abrir painel
          </a>
        @else
          @if (Route::has('login'))
            <a href="{{ route('login') }}"
               class="h-9 px-3 rounded-xl bg-gray-900 text-white text-sm font-medium grid place-items-center hover:bg-gray-800">
              Entrar
            </a>
          @endif

          @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="h-9 px-3 rounded-xl border border-gray-300 text-sm font-medium grid place-items-center hover:bg-gray-100">
              Criar conta
            </a>
          @endif
        @endauth
      </nav>
    </div>
  </header>

  {{-- Hero --}}
  <main class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10">
  {{-- Hero card --}}
  <section class="relative overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-white to-gray-50"></div>
    <div class="absolute -top-24 -right-24 h-64 w-64 rounded-full bg-gray-900/5 blur-2xl"></div>
    <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-gray-900/5 blur-2xl"></div>

    <div class="relative p-6 sm:p-10">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
        <div class="space-y-4 max-w-2xl">
          <h1 class="text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900">
            Base oficial ATLVS para projetos em Laravel
          </h1>

          <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
            Template pensado para a equipe desenvolver com consistência: Docker, Auth, RBAC, Admin e um CRUD de referência.
            Menos decisões repetidas. Mais entrega.
          </p>

          <div class="flex flex-col sm:flex-row gap-3 pt-2">
            @auth
              <a href="{{ route('admin.projects.index') }}"
                 class="h-10 px-4 rounded-xl bg-gray-900 text-white text-sm font-medium inline-flex items-center justify-center hover:bg-gray-800">
                Ver projetos (CRUD)
              </a>
            @else
              @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   class="h-10 px-4 rounded-xl bg-gray-900 text-white text-sm font-medium inline-flex items-center justify-center hover:bg-gray-800">
                  Entrar
                </a>
              @endif

              @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="h-10 px-4 rounded-xl border border-gray-300 text-sm font-medium inline-flex items-center justify-center hover:bg-gray-100">
                  Criar conta
                </a>
              @endif
            @endauth
          </div>
        </div>

        {{-- Quick facts --}}
        <div class="grid grid-cols-2 gap-3 w-full lg:w-[360px]">
          <div class="rounded-2xl border border-gray-200 bg-white/70 p-4">
            <div class="text-xs text-gray-500">Auth</div>
            <div class="text-sm font-semibold text-gray-900">Breeze (Blade)</div>
          </div>
          <div class="rounded-2xl border border-gray-200 bg-white/70 p-4">
            <div class="text-xs text-gray-500">Acesso</div>
            <div class="text-sm font-semibold text-gray-900">RBAC</div>
          </div>
          <div class="rounded-2xl border border-gray-200 bg-white/70 p-4">
            <div class="text-xs text-gray-500">Infra</div>
            <div class="text-sm font-semibold text-gray-900">Docker + Nginx</div>
          </div>
          <div class="rounded-2xl border border-gray-200 bg-white/70 p-4">
            <div class="text-xs text-gray-500">Exemplo</div>
            <div class="text-sm font-semibold text-gray-900">CRUD Projects</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Feature grid --}}
  @php($items = [
    ['title' => 'Padrão de Pastas', 'desc' => 'Admin separado, components ATLVS e views organizadas por módulo.'],
    ['title' => 'Form Requests', 'desc' => 'Validação fora do controller para manter o código limpo e testável.'],
    ['title' => 'UI Reutilizável', 'desc' => 'Cards, badges, alerts e botões com identidade base.'],
    ['title' => 'Pronto para escalar', 'desc' => 'Base ideal para adicionar Policies, Services e auditoria depois.'],
  ])

  <section class="mt-8">
    <div class="flex items-end justify-between gap-4 mb-4">
      <div>
        <h2 class="text-base font-semibold text-gray-900">O que vem pronto</h2>
        <p class="text-sm text-gray-600">Uma base moderna e consistente para começar qualquer projeto.</p>
      </div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
      @foreach($items as $it)
        <div class="group rounded-2xl border border-gray-200 bg-white shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">
          <div class="flex items-start justify-between gap-3">
            <div class="text-sm font-semibold text-gray-900">{{ $it['title'] }}</div>
            <span class="h-8 w-8 rounded-xl bg-gray-900/5 grid place-items-center text-xs text-gray-700">
              ✓
            </span>
          </div>
          <div class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $it['desc'] }}</div>
        </div>
      @endforeach
    </div>
  </section>

  <footer class="pt-10 text-center text-xs text-gray-400">
    © {{ date('Y') }} ATLVS — Template interno.
  </footer>
</main>

</body>
</html>