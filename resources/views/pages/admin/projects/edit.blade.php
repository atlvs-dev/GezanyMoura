@php($title = 'Editar solucao')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header title="Editar solucao" subtitle="Atualize o posicionamento, status e descricao exibidos no site.">
    <x-slot:actions>
      <x-atlvs.ui.button variant="secondary" :href="route('admin.projects.index')">Voltar</x-atlvs.ui.button>
    </x-slot:actions>
  </x-atlvs.layout.page-header>

  <x-atlvs.ui.card>
    @include('pages.admin.projects._form', [
      'action' => route('admin.projects.update', $project),
      'method' => 'PUT',
      'project' => $project,
    ])
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
