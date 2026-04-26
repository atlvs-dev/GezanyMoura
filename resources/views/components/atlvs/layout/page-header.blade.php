@props(['title', 'subtitle' => null])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">{{ $title }}</h1>
    @if($subtitle)
      <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">{{ $subtitle }}</p>
    @endif
  </div>

  @isset($actions)
    <div class="flex shrink-0 items-center gap-2">
      {{ $actions }}
    </div>
  @endisset
</div>
