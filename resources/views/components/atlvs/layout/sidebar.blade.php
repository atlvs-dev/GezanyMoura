<aside class="hidden lg:flex lg:flex-col lg:w-64 border-r border-gray-200 bg-white">
  {{-- Brand --}}
  <div class="h-14 px-4 flex items-center border-b border-gray-200">
    <div class="flex items-center gap-3">
      <div class="h-8 w-8 rounded-xl bg-gray-900 text-white grid place-items-center text-xs font-semibold">
        A
      </div>

      <div class="leading-tight">
        <div class="text-sm font-semibold tracking-tight text-gray-900">
          ATLVS
        </div>
        <div class="text-xs text-gray-500">
          Admin Panel
        </div>
      </div>
    </div>
  </div>

  {{-- Navigation --}}
  <nav class="flex-1 p-3 space-y-1">
    <a href="{{ route('admin.dashboard') }}"
       class="group flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
              {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
      <span class="h-2 w-2 rounded-full {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'bg-gray-300 group-hover:bg-gray-400' }}"></span>
      <span>Dashboard</span>
    </a>

    <a href="{{ route('admin.projects.index') }}"
       class="group flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
              {{ request()->routeIs('admin.projects.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
      <span class="h-2 w-2 rounded-full {{ request()->routeIs('admin.projects.*') ? 'bg-gray-900' : 'bg-gray-300 group-hover:bg-gray-400' }}"></span>
      <span>Projetos</span>
    </a>
  </nav>

  {{-- Footer --}}
  <div class="p-3 border-t border-gray-200 text-xs text-gray-400">
    <div class="flex items-center justify-between">
      <span>ATLVS</span>
      <span>v1.1</span>
    </div>
  </div>
</aside>
