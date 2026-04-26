@php($title = 'Dashboard')

<x-atlvs.layout.app-shell :title="$title">
  <x-atlvs.layout.page-header
    title="Dashboard"
    subtitle="Visao geral do conteudo publico, solucoes cadastradas e atividade recente do painel."
  >
    <x-slot:actions>
      <x-atlvs.ui.button :href="route('admin.projects.create')">Nova solucao</x-atlvs.ui.button>
    </x-slot:actions>
  </x-atlvs.layout.page-header>

  <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Metricas principais">
    <x-atlvs.ui.card>
      <p class="text-sm font-semibold text-slate-500">Solucoes ativas</p>
      <p class="mt-3 text-3xl font-black tracking-tight text-slate-950">{{ $metrics['active_projects'] }}</p>
      <p class="mt-2 text-xs text-slate-500">Aparecem na landing page publica.</p>
    </x-atlvs.ui.card>
    <x-atlvs.ui.card>
      <p class="text-sm font-semibold text-slate-500">Inativas</p>
      <p class="mt-3 text-3xl font-black tracking-tight text-slate-950">{{ $metrics['inactive_projects'] }}</p>
      <p class="mt-2 text-xs text-slate-500">Guardadas sem aparecer no site.</p>
    </x-atlvs.ui.card>
    <x-atlvs.ui.card>
      <p class="text-sm font-semibold text-slate-500">Categorias</p>
      <p class="mt-3 text-3xl font-black tracking-tight text-slate-950">{{ $metrics['categories'] }}</p>
      <p class="mt-2 text-xs text-slate-500">Organizacao das ofertas.</p>
    </x-atlvs.ui.card>
    <x-atlvs.ui.card>
      <p class="text-sm font-semibold text-slate-500">Administradores</p>
      <p class="mt-3 text-3xl font-black tracking-tight text-slate-950">{{ $metrics['admins'] }}</p>
      <p class="mt-2 text-xs text-slate-500">Usuarios com acesso ao painel.</p>
    </x-atlvs.ui.card>
  </section>

  <section class="mt-6 grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
    <x-atlvs.ui.card>
      <x-slot:header>
        <div class="flex items-center justify-between gap-3">
          <div>
            <h2 class="font-bold text-slate-950">Atualizacoes recentes</h2>
            <p class="mt-1 text-sm text-slate-500">Ultimas solucoes editadas no painel.</p>
          </div>
          <x-atlvs.ui.button variant="secondary" :href="route('admin.projects.index')">Ver todas</x-atlvs.ui.button>
        </div>
      </x-slot:header>

      <div class="divide-y divide-slate-100">
        @forelse($recentProjects as $project)
          <div class="flex flex-col gap-3 py-4 first:pt-0 last:pb-0 sm:flex-row sm:items-center sm:justify-between">
            <div>
              <div class="flex items-center gap-2">
                <h3 class="font-semibold text-slate-950">{{ $project->title }}</h3>
                <x-atlvs.ui.badge :variant="$project->is_active ? 'success' : 'default'">
                  {{ $project->is_active ? 'Ativa' : 'Inativa' }}
                </x-atlvs.ui.badge>
              </div>
              <p class="mt-1 text-sm text-slate-500">
                {{ $project->category }} @if($project->duration) · {{ $project->duration }} @endif
              </p>
            </div>
            <a href="{{ route('admin.projects.edit', $project) }}" class="text-sm font-bold text-sky-700 hover:text-sky-900">Editar</a>
          </div>
        @empty
          <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
            <p class="font-semibold text-slate-950">Nenhuma solucao cadastrada ainda.</p>
            <p class="mt-2 text-sm text-slate-500">Cadastre a primeira oferta para alimentar a area publica do site.</p>
            <x-atlvs.ui.button class="mt-5" :href="route('admin.projects.create')">Criar primeira solucao</x-atlvs.ui.button>
          </div>
        @endforelse
      </div>
    </x-atlvs.ui.card>

    <x-atlvs.ui.card>
      <x-slot:header>
        <h2 class="font-bold text-slate-950">Checklist operacional</h2>
        <p class="mt-1 text-sm text-slate-500">Pontos que aumentam confianca e conversao.</p>
      </x-slot:header>

      <ul class="space-y-4 text-sm text-slate-600">
        <li class="flex gap-3"><span class="mt-0.5 grid h-5 w-5 place-items-center rounded-full bg-emerald-50 text-xs font-black text-emerald-700">1</span><span>Manter apenas solucoes atuais como ativas.</span></li>
        <li class="flex gap-3"><span class="mt-0.5 grid h-5 w-5 place-items-center rounded-full bg-sky-50 text-xs font-black text-sky-700">2</span><span>Revisar copy de cada servico com promessa clara e publico definido.</span></li>
        <li class="flex gap-3"><span class="mt-0.5 grid h-5 w-5 place-items-center rounded-full bg-amber-50 text-xs font-black text-amber-700">3</span><span>Configurar WhatsApp, e-mail e Instagram no ambiente.</span></li>
      </ul>
    </x-atlvs.ui.card>
  </section>
</x-atlvs.layout.app-shell>
