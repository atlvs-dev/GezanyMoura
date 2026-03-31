@php($title = 'Novo projeto')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header title="Novo projeto" subtitle="Cadastro seguindo o padrão ATLVS." />

  <x-atlvs.ui.card>
    @include('pages.admin.projects._form', [
      'action' => route('admin.projects.store'),
      'method' => 'POST',
      'project' => null,
    ])
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
