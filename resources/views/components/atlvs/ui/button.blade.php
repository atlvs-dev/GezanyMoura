@props([
  'type' => 'button',
  'variant' => 'primary', // primary|secondary|ghost|danger
  'href' => null,
])

@php
  $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 disabled:pointer-events-none min-h-11 px-5 text-sm';
  $variants = [
    'primary' => 'bg-slate-950 text-white shadow-sm hover:bg-slate-800 focus:ring-slate-900',
    'secondary' => 'bg-white text-slate-950 border border-slate-200 shadow-sm hover:bg-slate-50 focus:ring-slate-300',
    'ghost' => 'bg-transparent text-slate-900 hover:bg-slate-100 focus:ring-slate-300',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-600',
  ];
  $cls = $base.' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</button>
@endif
