@props([
  'type' => 'button',
  'variant' => 'primary', // primary|secondary|ghost|danger
  'href' => null,
])

@php
  $base = 'inline-flex items-center justify-center rounded-xl font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 disabled:pointer-events-none h-10 px-4 text-sm';
  $variants = [
    'primary' => 'bg-gray-900 text-white hover:bg-gray-800 focus:ring-gray-900',
    'secondary' => 'bg-white text-gray-900 border border-gray-200 hover:bg-gray-50 focus:ring-gray-300',
    'ghost' => 'bg-transparent text-gray-900 hover:bg-gray-100 focus:ring-gray-300',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-600',
  ];
  $cls = $base.' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</button>
@endif
