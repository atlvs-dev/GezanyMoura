@props([
  'action',
  'method' => 'POST',
  'project' => null
])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
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
        <label for="images" class="text-sm font-semibold text-slate-700">Fotos da solucao</label>
        <input
          id="images"
          name="images[]"
          type="file"
          multiple
          accept="image/jpeg,image/png,image/webp"
          class="mt-1 block w-full rounded-lg border border-slate-200 bg-white text-sm text-slate-600 file:mr-3 file:border-0 file:bg-slate-950 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800"
        />
        <p class="mt-1 text-xs text-slate-500">Envie ate 8 fotos por vez. Formatos: JPG, PNG ou WebP ate 4MB cada.</p>
        @error('images') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        @error('images.*') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
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

  @if($project?->images?->isNotEmpty())
    <section class="rounded-lg border border-slate-200 bg-white p-4">
      <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <h2 class="font-bold text-slate-950">Fotos cadastradas</h2>
          <p class="text-sm text-slate-500">Marque as imagens que deseja remover ao salvar.</p>
        </div>
        <span class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $project->images->count() }} foto(s)</span>
      </div>

      <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($project->images as $image)
          <label class="group overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
            <img src="{{ $image->url }}" alt="Foto cadastrada para {{ $project->title }}" class="aspect-[4/3] w-full object-cover" loading="lazy">
            <span class="flex items-center gap-2 px-3 py-3 text-sm font-semibold text-slate-700">
              <input type="checkbox" name="remove_image_ids[]" value="{{ $image->id }}" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
              Remover foto
            </span>
          </label>
        @endforeach
      </div>
    </section>
  @endif

  <div class="flex flex-col-reverse gap-2 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
    <x-atlvs.ui.button variant="ghost" :href="route('admin.projects.index')">Cancelar</x-atlvs.ui.button>
    <x-atlvs.ui.button type="submit">Salvar solucao</x-atlvs.ui.button>
  </div>
</form>
