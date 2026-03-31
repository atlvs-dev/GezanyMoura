@props(['title' => null])

<x-atlvs.layout.app :title="$title">
  <div x-data="{ mobileNav: false }" class="min-h-screen flex bg-gray-50">
    {{-- Sidebar desktop --}}
    <x-atlvs.layout.sidebar />

    <div class="flex-1 flex flex-col min-w-0">
      {{-- Topbar --}}
      <header class="sticky top-0 z-30 border-b border-gray-200 bg-white/90 backdrop-blur">
        <div class="h-14 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
          <div class="flex items-center gap-3">
            {{-- Mobile menu button --}}
            <button
              type="button"
              class="lg:hidden h-9 w-9 rounded-xl hover:bg-gray-100 grid place-items-center"
              @click="mobileNav = true"
              aria-label="Abrir menu"
            >
              ☰
            </button>

            {{-- Brand --}}
            <div class="h-9 w-9 rounded-xl bg-gray-900 text-white grid place-items-center text-sm font-semibold">
              A
            </div>
            <div class="leading-tight">
              <div class="text-sm font-semibold tracking-tight text-gray-900">ATLVS</div>
              <div class="text-xs text-gray-500">Admin Panel</div>
            </div>
          </div>

          {{-- Account --}}
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="h-9 px-3 rounded-xl hover:bg-gray-100 text-sm font-medium" type="button">
                {{ auth()->user()->name ?? 'Conta' }}
              </button>
            </x-slot>

            <x-slot name="content">
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
      </header>

      {{-- Mobile drawer --}}
      <div class="lg:hidden">
        <div x-show="mobileNav" x-transition.opacity
             class="fixed inset-0 z-40 bg-black/30"
             @click="mobileNav = false"></div>

        <div x-show="mobileNav" x-transition
             class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-gray-200 shadow-sm">
          <div class="h-14 px-4 flex items-center justify-between border-b border-gray-200">
            <div class="flex items-center gap-3">
              <div class="h-8 w-8 rounded-xl bg-gray-900 text-white grid place-items-center text-xs font-semibold">A</div>
              <div class="text-sm font-semibold">ATLVS</div>
            </div>

            <button class="h-9 w-9 rounded-xl hover:bg-gray-100 grid place-items-center"
                    @click="mobileNav = false" aria-label="Fechar menu">
              ✕
            </button>
          </div>

          <nav class="p-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
              Dashboard
            </a>
            <a href="{{ route('admin.projects.index') }}"
               class="block px-3 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-100' : '' }}">
              Projetos
            </a>
          </nav>
        </div>
      </div>

      {{-- Content --}}
      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        {{ $slot }}

        <footer class="pt-10 pb-6 text-center text-xs text-gray-400">
          © {{ date('Y') }} ATLVS — Todos os direitos reservados
        </footer>
      </main>
    </div>
  </div>
</x-atlvs.layout.app>
