@props([
  'action',
  'method' => 'POST',
  'project' => null
])

<form method="POST" action="{{ $action }}" class="space-y-6">
  @csrf
  @if($method !== 'POST') @method($method) @endif

  <div class="grid gap-5 lg:grid-cols-[1fr_260px]">
    <div class="space-y-5">
      <div>
        <label for="title" class="text-sm font-semibold text-slate-700">Titulo</label>
        <input id="title" name="title" value="{{ old('title', $project?->title) }}" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Ex.: Lideranca de Alta Performance" required maxlength="120" />
        @error('title') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="description" class="text-sm font-semibold text-slate-700">Descricao comercial</label>
        <textarea id="description" name="description" rows="7" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm leading-6 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Descreva a promessa, publico e resultado esperado desta solucao." required maxlength="1200">{{ old('description', $project?->description) }}</textarea>
        <p class="mt-1 text-xs text-slate-500">Use linguagem clara, orientada a resultado e sem jargoes internos.</p>
        @error('description') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="space-y-5 rounded-lg border border-slate-200 bg-slate-50 p-4">
      <div>
        <label for="category" class="text-sm font-semibold text-slate-700">Categoria</label>
        <input id="category" name="category" value="{{ old('category', $project?->category) }}" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Workshop, Mentoria..." required maxlength="80" />
        @error('category') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="duration" class="text-sm font-semibold text-slate-700">Duracao</label>
        <input id="duration" name="duration" value="{{ old('duration', $project?->duration) }}" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="08 ou 16 horas" maxlength="80" />
        @error('duration') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="image_path" class="text-sm font-semibold text-slate-700">Imagem</label>
        <input id="image_path" name="image_path" value="{{ old('image_path', $project?->image_path) }}" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="images/nome-do-arquivo.png" maxlength="255" />
        <p class="mt-1 text-xs text-slate-500">Campo preparado para upload/asset futuro.</p>
        @error('image_path') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        @php($isActive = (string) old('is_active', $project?->is_active ?? '1'))
        <label for="is_active" class="text-sm font-semibold text-slate-700">Status publico</label>
        <select id="is_active" name="is_active" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
          <option value="1" @selected($isActive === '1')>Ativa no site</option>
          <option value="0" @selected($isActive === '0')>Inativa</option>
        </select>
        @error('is_active') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
      </div>
    </div>
  </div>

  <div class="flex flex-col-reverse gap-2 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
    <x-atlvs.ui.button variant="ghost" :href="route('admin.projects.index')">Cancelar</x-atlvs.ui.button>
    <x-atlvs.ui.button type="submit">Salvar solucao</x-atlvs.ui.button>
  </div>
</form>
