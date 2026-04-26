<aside class="hidden lg:flex lg:w-72 lg:flex-col border-r border-slate-200 bg-white">
  {{-- Brand --}}
  <div class="flex h-16 items-center border-b border-slate-200 px-5">
    <div class="flex items-center gap-3">
      <div class="grid h-9 w-9 place-items-center rounded-lg bg-slate-950 text-xs font-black text-white">
        A
      </div>

      <div class="leading-tight">
        <div class="text-sm font-black tracking-tight text-slate-950">
          Gezany Admin
        </div>
        <div class="text-xs text-slate-500">
          Conteudo e operacoes
        </div>
      </div>
    </div>
  </div>

  {{-- Navigation --}}
  <nav class="flex-1 space-y-1 p-4" aria-label="Navegacao administrativa">
    <a href="{{ route('admin.dashboard') }}"
       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition
              {{ request()->routeIs('admin.dashboard') ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
      <span class="grid h-8 w-8 place-items-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : 'bg-slate-100 text-slate-500 group-hover:bg-white' }}" aria-hidden="true">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 13h8V3H3v10ZM13 21h8V3h-8v18ZM3 21h8v-6H3v6Z"/></svg>
      </span>
      <span>Dashboard</span>
    </a>

    <a href="{{ route('admin.projects.index') }}"
       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition
              {{ request()->routeIs('admin.projects.*') ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
      <span class="grid h-8 w-8 place-items-center rounded-lg {{ request()->routeIs('admin.projects.*') ? 'bg-white/10' : 'bg-slate-100 text-slate-500 group-hover:bg-white' }}" aria-hidden="true">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h10"/></svg>
      </span>
      <span>Solucoes</span>
    </a>
  </nav>

  {{-- Footer --}}
  <div class="border-t border-slate-200 p-4 text-xs text-slate-500">
    <div class="flex items-center justify-between">
      <span>Painel administrativo</span>
      <span>v1.2</span>
    </div>
  </div>
</aside>
