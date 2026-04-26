@props([
  'title' => null,
  'description' => 'Mentoria, treinamentos e consultoria em lideranca, comportamento e empreendedorismo com foco em resultados sustentaveis.',
  'image' => null,
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{{ $description }}">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#0f172a">
  <link rel="canonical" href="{{ url()->current() }}">

  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $title ?? config('app.name') }}">
  <meta property="og:description" content="{{ $description }}">
  <meta property="og:url" content="{{ url()->current() }}">
  @if($image)
    <meta property="og:image" content="{{ $image }}">
  @endif

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
  <meta name="twitter:description" content="{{ $description }}">
  @if($image)
    <meta name="twitter:image" content="{{ $image }}">
  @endif

  <title>{{ $title ?? config('app.name') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-950 antialiased">
  <a href="#conteudo" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-slate-900 focus:shadow">
    Pular para o conteudo
  </a>
  {{ $slot }}
</body>
</html>
