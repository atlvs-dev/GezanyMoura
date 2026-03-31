@php($title = 'Projetos')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header title="Projetos" subtitle="CRUD de exemplo do template ATLVS.">
    <x-slot:actions>
      <x-atlvs.ui.button :href="route('admin.projects.create')">Novo</x-atlvs.ui.button>
    </x-slot:actions>
  </x-atlvs.layout.page-header>

  @if(session('success'))
    <x-atlvs.ui.alert variant="success" class="mb-4">
      {{ session('success') }}
    </x-atlvs.ui.alert>
  @endif

  <x-atlvs.ui.card>
    <x-slot:header>
      <form method="GET" class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
        <div>
          <div class="font-semibold">Lista de projetos</div>
          <div class="text-sm text-gray-600">Busque, edite ou remova projetos do painel.</div>
        </div>

        <div class="w-full sm:w-72">
          <input
            name="q"
            value="{{ $q }}"
            placeholder="Buscar por nome..."
            class="h-10 w-full rounded-xl border border-gray-200 px-3 text-sm outline-none focus:ring-2 focus:ring-gray-300"
          />
        </div>
      </form>
    </x-slot:header>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50 text-gray-700">
          <tr>
            <th class="text-left px-4 py-3 font-medium">Nome</th>
            <th class="text-left px-4 py-3 font-medium">Status</th>
            <th class="text-right px-4 py-3 font-medium">Ações</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @forelse($projects as $project)
            @php($variant = match($project->status) {
              'active' => 'success',
              'paused' => 'warning',
              'done'   => 'default',
              default  => 'default',
            })

            <tr>
              <td class="px-4 py-3">
                <div class="font-medium text-gray-900">{{ $project->name }}</div>
                @if($project->notes)
                  <div class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $project->notes }}</div>
                @endif
              </td>

              <td class="px-4 py-3">
                <x-atlvs.ui.badge :variant="$variant">{{ $project->status }}</x-atlvs.ui.badge>
              </td>

              <td class="px-4 py-3 text-right">
                <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <button class="h-9 px-3 rounded-lg hover:bg-gray-100 text-sm" type="button">
                      Opções
                    </button>
                  </x-slot>

                  <x-slot name="content">
                    <x-dropdown-link :href="route('admin.projects.edit', $project)">
                      Editar
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                          onsubmit="return confirm('Remover este projeto?')">
                      @csrf
                      @method('DELETE')

                      <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 text-red-600">
                        Remover
                      </button>
                    </form>
                  </x-slot>
                </x-dropdown>
              </td>
            </tr>
          @empty
            <tr>
              <td class="px-4 py-10 text-center text-gray-600" colspan="3">
                <div class="space-y-3">
                  <div class="text-sm">Nenhum projeto encontrado.</div>
                  <x-atlvs.ui.button :href="route('admin.projects.create')">
                    Criar primeiro projeto
                  </x-atlvs.ui.button>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <x-slot:footer>
      {{ $projects->links() }}
    </x-slot:footer>
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
