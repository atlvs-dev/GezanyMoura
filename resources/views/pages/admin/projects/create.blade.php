@php($title = 'Nova solucao')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header title="Nova solucao" subtitle="Cadastre uma oferta que podera aparecer na landing page publica.">
    <x-slot:actions>
      <x-atlvs.ui.button variant="secondary" :href="route('admin.projects.index')">Voltar</x-atlvs.ui.button>
    </x-slot:actions>
  </x-atlvs.layout.page-header>

  <x-atlvs.ui.card>
    @include('pages.admin.projects._form', [
      'action' => route('admin.projects.store'),
      'method' => 'POST',
      'project' => null,
    ])
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
