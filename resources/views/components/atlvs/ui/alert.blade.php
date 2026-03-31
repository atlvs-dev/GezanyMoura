@props(['variant' => 'info'])

@php
  $map = [
    'info' => 'bg-blue-50 text-blue-900 border-blue-100',
    'success' => 'bg-emerald-50 text-emerald-900 border-emerald-100',
    'warning' => 'bg-amber-50 text-amber-900 border-amber-100',
    'danger' => 'bg-red-50 text-red-900 border-red-100',
  ];
@endphp

<div {{ $attributes->merge(['class' => 'border rounded-2xl px-4 py-3 text-sm '.$map[$variant]]) }}>
  {{ $slot }}
</div>
