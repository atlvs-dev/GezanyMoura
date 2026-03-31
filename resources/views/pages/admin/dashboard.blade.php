@php($title = 'Admin')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header title="Dashboard" subtitle="Painel administrativo ATLVS." />

  <x-atlvs.ui.card>
    <div class="text-sm text-gray-700">
      Se você está vendo isso, auth + RBAC estão funcionando ✅
    </div>
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
