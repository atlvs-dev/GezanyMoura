@php($title = 'Editar projeto')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header title="Editar projeto" subtitle="Edição seguindo o padrão ATLVS." />

  <x-atlvs.ui.card>
    @include('pages.admin.projects._form', [
      'action' => route('admin.projects.update', $project),
      'method' => 'PUT',
      'project' => $project,
    ])
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
