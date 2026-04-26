@props(['title' => null])

<x-atlvs.layout.app :title="$title">
  <div x-data="{ mobileNav: false }" class="flex min-h-screen bg-slate-50">
    <x-atlvs.layout.sidebar />

    <div class="flex min-w-0 flex-1 flex-col">
      <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur-xl">
        <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
          <div class="flex items-center gap-3">
            <button
              type="button"
              class="grid h-10 w-10 place-items-center rounded-lg text-slate-700 hover:bg-slate-100 lg:hidden"
              @click="mobileNav = true"
              aria-label="Abrir menu"
            >
              <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <div class="grid h-10 w-10 place-items-center rounded-lg bg-slate-950 text-sm font-black text-white lg:hidden">
              A
            </div>
            <div class="leading-tight">
              <div class="text-sm font-black tracking-tight text-slate-950">Gezany Admin</div>
              <div class="text-xs text-slate-500">Gestao do site</div>
            </div>
          </div>

          <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-950 sm:inline-flex">
              Ver site
            </a>

            <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                <button class="flex h-10 items-center gap-2 rounded-lg px-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" type="button" aria-label="Abrir menu da conta">
                  <span class="grid h-8 w-8 place-items-center rounded-lg bg-slate-100 text-xs font-black text-slate-700">
                    {{ str(auth()->user()->name ?? 'A')->substr(0, 1)->upper() }}
                  </span>
                  <span class="hidden sm:inline">{{ auth()->user()->name ?? 'Conta' }}</span>
                </button>
              </x-slot>

              <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                  Perfil
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Sair
                  </x-dropdown-link>
                </form>
              </x-slot>
            </x-dropdown>
          </div>
        </div>
      </header>

      <div class="lg:hidden">
        <div x-show="mobileNav" x-transition.opacity
             class="fixed inset-0 z-40 bg-slate-950/40"
             @click="mobileNav = false"></div>

        <div x-show="mobileNav" x-transition
             class="fixed inset-y-0 left-0 z-50 w-80 border-r border-slate-200 bg-white shadow-xl">
          <div class="flex h-16 items-center justify-between border-b border-slate-200 px-4">
            <div class="flex items-center gap-3">
              <div class="grid h-9 w-9 place-items-center rounded-lg bg-slate-950 text-xs font-black text-white">A</div>
              <div class="text-sm font-black text-slate-950">Gezany Admin</div>
            </div>

            <button class="grid h-10 w-10 place-items-center rounded-lg hover:bg-slate-100"
                    @click="mobileNav = false" aria-label="Fechar menu">
              <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
          </div>

          <nav class="space-y-1 p-4" aria-label="Navegacao administrativa mobile">
            <a href="{{ route('admin.dashboard') }}"
               class="block rounded-lg px-3 py-2.5 text-sm font-semibold hover:bg-slate-100 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-950 text-white' : 'text-slate-700' }}">
              Dashboard
            </a>
            <a href="{{ route('admin.projects.index') }}"
               class="block rounded-lg px-3 py-2.5 text-sm font-semibold hover:bg-slate-100 {{ request()->routeIs('admin.projects.*') ? 'bg-slate-950 text-white' : 'text-slate-700' }}">
              Solucoes
            </a>
          </nav>
        </div>
      </div>

      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        {{ $slot }}

        <footer class="pb-6 pt-10 text-center text-xs text-slate-400">
          © {{ date('Y') }} Gezany Moura - Painel administrativo
        </footer>
      </main>
    </div>
  </div>
</x-atlvs.layout.app>
