@php($title = 'Solucoes')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header
    title="Solucoes"
    subtitle="Gerencie os treinamentos, mentorias e consultorias exibidos na landing page."
  >
    <x-slot:actions>
      <x-atlvs.ui.button :href="route('admin.projects.create')">Nova solucao</x-atlvs.ui.button>
    </x-slot:actions>
  </x-atlvs.layout.page-header>

  @if(session('success'))
    <x-atlvs.ui.alert variant="success" class="mb-4">{{ session('success') }}</x-atlvs.ui.alert>
  @endif

  <x-atlvs.ui.card>
    <x-slot:header>
      <form method="GET" class="grid gap-3 lg:grid-cols-[1fr_180px_160px_auto] lg:items-end">
        <div>
          <label for="q" class="text-sm font-semibold text-slate-700">Busca</label>
          <input id="q" name="q" value="{{ $q }}" placeholder="Titulo, descricao ou categoria" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" />
        </div>

        <div>
          <label for="category" class="text-sm font-semibold text-slate-700">Categoria</label>
          <select id="category" name="category" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
            <option value="">Todas</option>
            @foreach($categories as $item)
              <option value="{{ $item }}" @selected($category === $item)>{{ $item }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label for="status" class="text-sm font-semibold text-slate-700">Status</label>
          <select id="status" name="status" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
            <option value="">Todos</option>
            <option value="active" @selected($status === 'active')>Ativas</option>
            <option value="inactive" @selected($status === 'inactive')>Inativas</option>
          </select>
        </div>

        <div class="flex gap-2">
          <x-atlvs.ui.button type="submit">Filtrar</x-atlvs.ui.button>
          @if($q || $category || $status)
            <x-atlvs.ui.button variant="secondary" :href="route('admin.projects.index')">Limpar</x-atlvs.ui.button>
          @endif
        </div>
      </form>
    </x-slot:header>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
          <tr>
            <th class="px-4 py-3 text-left font-bold">Solucao</th>
            <th class="px-4 py-3 text-left font-bold">Categoria</th>
            <th class="px-4 py-3 text-left font-bold">Duracao</th>
            <th class="px-4 py-3 text-left font-bold">Status</th>
            <th class="px-4 py-3 text-right font-bold">Acoes</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-slate-100">
          @forelse($projects as $project)
            <tr class="bg-white transition hover:bg-slate-50">
              <td class="min-w-80 px-4 py-4">
                <div class="font-bold text-slate-950">{{ $project->title }}</div>
                <div class="mt-1 max-w-xl truncate text-sm text-slate-500">{{ $project->description }}</div>
              </td>
              <td class="px-4 py-4 text-slate-700">{{ $project->category }}</td>
              <td class="px-4 py-4 text-slate-600">{{ $project->duration ?: 'A definir' }}</td>
              <td class="px-4 py-4">
                <x-atlvs.ui.badge :variant="$project->is_active ? 'success' : 'default'">
                  {{ $project->is_active ? 'Ativa' : 'Inativa' }}
                </x-atlvs.ui.badge>
              </td>
              <td class="px-4 py-4 text-right">
                <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <button class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-950" type="button">Opcoes</button>
                  </x-slot>

                  <x-slot name="content">
                    <x-dropdown-link :href="route('admin.projects.edit', $project)">Editar</x-dropdown-link>
                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Remover esta solucao? Ela deixara de aparecer no painel e no site.')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50">Remover</button>
                    </form>
                  </x-slot>
                </x-dropdown>
              </td>
            </tr>
          @empty
            <tr>
              <td class="px-4 py-14 text-center" colspan="5">
                <div class="mx-auto max-w-md">
                  <div class="mx-auto grid h-12 w-12 place-items-center rounded-lg bg-slate-100 text-slate-500">
                    <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h10"/></svg>
                  </div>
                  <p class="mt-4 font-bold text-slate-950">Nenhuma solucao encontrada.</p>
                  <p class="mt-2 text-sm leading-6 text-slate-500">Ajuste os filtros ou cadastre uma nova solucao para exibir no site publico.</p>
                  <x-atlvs.ui.button class="mt-5" :href="route('admin.projects.create')">Criar solucao</x-atlvs.ui.button>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <x-slot:footer>
      <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-slate-500">Exibindo {{ $projects->firstItem() ?? 0 }}-{{ $projects->lastItem() ?? 0 }} de {{ $projects->total() }} solucoes</p>
        {{ $projects->links() }}
      </div>
    </x-slot:footer>
  </x-atlvs.ui.card>
</x-atlvs.layout.app-shell>
