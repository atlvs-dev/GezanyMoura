<header class="sticky top-0 z-30 border-b bg-white/90 backdrop-blur">
  <div class="px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
    <a href="{{ route('admin.dashboard') }}" class="font-semibold hover:opacity-80">
      {{ config('app.name', 'ATLVS') }}
    </a>

    <x-dropdown align="right" width="48">
      <x-slot name="trigger">
        <button class="h-9 px-3 rounded-lg hover:bg-gray-100 text-sm font-medium" type="button">
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
