@props(['title', 'subtitle' => null])

<div class="mb-6 flex items-start justify-between gap-4">
  <div>
    <h1 class="text-xl sm:text-2xl font-semibold tracking-tight">{{ $title }}</h1>
    @if($subtitle)
      <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
    @endif
  </div>

  @isset($actions)
    <div class="flex items-center gap-2">
      {{ $actions }}
    </div>
  @endisset
</div>
