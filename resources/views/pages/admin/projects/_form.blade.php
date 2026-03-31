@props([
  'action',
  'method' => 'POST',
  'project' => null
])

<form method="POST" action="{{ $action }}" class="space-y-4">
  @csrf
  @if($method !== 'POST') @method($method) @endif

  <div>
    <label class="text-sm font-medium">Nome</label>
    <input
      name="name"
      value="{{ old('name', $project?->name) }}"
      class="mt-1 h-10 w-full rounded-xl border border-gray-200 px-3 text-sm outline-none focus:ring-2 focus:ring-gray-300"
      placeholder="Ex.: Sistema Academia"
    />
    @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="text-sm font-medium">Status</label>
    @php($val = old('status', $project?->status ?? 'active'))
    <select name="status" class="mt-1 h-10 w-full rounded-xl border border-gray-200 px-3 text-sm outline-none focus:ring-2 focus:ring-gray-300">
      <option value="active" @selected($val==='active')>active</option>
      <option value="paused" @selected($val==='paused')>paused</option>
      <option value="done" @selected($val==='done')>done</option>
    </select>
    @error('status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="text-sm font-medium">Notas</label>
    <textarea
      name="notes"
      rows="4"
      class="mt-1 w-full rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-gray-300"
      placeholder="Opcional"
    >{{ old('notes', $project?->notes) }}</textarea>
    @error('notes') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div class="flex justify-end gap-2 pt-2">
    <x-atlvs.ui.button variant="ghost" :href="route('admin.projects.index')">Cancelar</x-atlvs.ui.button>
    <x-atlvs.ui.button type="submit">Salvar</x-atlvs.ui.button>
  </div>
</form>
