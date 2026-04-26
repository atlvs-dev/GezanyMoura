@php
    $heroImage = asset('images/gezany-consultoria-hero.png');
    $whatsappUrl = config('services.contact.whatsapp_url');
    $email = config('services.contact.email');
    $instagramUrl = config('services.contact.instagram_url');

    $primaryCtaUrl = $whatsappUrl ?: '#contato';

    $stats = [
        ['value' => '+22', 'label' => 'anos de experiencia administrativa e comercial'],
        ['value' => '+16', 'label' => 'anos no ensino superior em Administracao'],
        ['value' => 'DISC', 'label' => 'analise comportamental aplicada a lideranca'],
    ];

    $differentials = [
        [
            'title' => 'Diagnostico comportamental',
            'copy' => 'Leitura objetiva de perfil, maturidade e contexto para orientar decisoes de desenvolvimento.',
            'icon' => 'target',
        ],
        [
            'title' => 'Metodo aplicavel',
            'copy' => 'Workshops, devolutivas e mentorias com ferramentas que viram rotina, nao apenas inspiracao.',
            'icon' => 'workflow',
        ],
        [
            'title' => 'Gestao com humanidade',
            'copy' => 'Performance, comunicacao e qualidade de vida tratadas como partes do mesmo sistema.',
            'icon' => 'spark',
        ],
    ];

    $process = [
        ['step' => '01', 'title' => 'Mapear', 'copy' => 'Entendimento do momento, dos desafios e das metas do lider, equipe ou negocio.'],
        ['step' => '02', 'title' => 'Desenvolver', 'copy' => 'Plano de acao com encontros, ferramentas e praticas alinhadas ao contexto real.'],
        ['step' => '03', 'title' => 'Sustentar', 'copy' => 'Acompanhamento para transformar aprendizado em comportamento, decisao e resultado.'],
    ];

    $testimonials = [
        [
            'quote' => 'A ferramenta utilizada mudou minha visao sobre meus liderados. Gerou uma grande mudanca na organizacao e trouxe resultados reais para a equipe.',
            'name' => 'Sara Emilia',
            'role' => 'CEO - Habib\'s',
        ],
        [
            'quote' => 'Foi maravilhoso descobrir que estou no caminho certo. Agora sei como gosto de ser reconhecida e como motivar minha equipe.',
            'name' => 'Marluce Oliveira',
            'role' => 'Gestora de RH',
        ],
    ];

    $faqs = [
        ['question' => 'Para quem e o trabalho?', 'answer' => 'Para empreendedoras, lideres, equipes comerciais e profissionais que precisam melhorar comunicacao, tomada de decisao e performance.'],
        ['question' => 'Os encontros podem ser personalizados?', 'answer' => 'Sim. A proposta considera objetivo, carga horaria, formato e maturidade do publico antes da definicao do plano.'],
        ['question' => 'Qual e o primeiro passo?', 'answer' => 'Uma conversa breve para entender o desafio, indicar o melhor formato e definir proximas etapas.'],
    ];

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Gezany Moura',
        'description' => 'Mentoria, treinamentos e consultoria em lideranca, comportamento e empreendedorismo.',
        'url' => url('/'),
        'image' => $heroImage,
        'areaServed' => 'Brasil',
        'serviceType' => ['Mentoria', 'Treinamento corporativo', 'Consultoria comportamental'],
    ];
@endphp

<x-atlvs.layout.app
    title="Gezany Moura | Lideranca, comportamento e empreendedorismo"
    description="Mentoria, treinamentos e consultoria para lideres, equipes e empreendedoras que buscam clareza, performance e crescimento sustentavel."
    :image="$heroImage"
>
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/90 backdrop-blur-xl">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="Navegacao principal">
            <a href="{{ route('home') }}" class="text-sm font-bold uppercase tracking-[0.18em] text-slate-950" aria-label="Gezany Moura, inicio">
                Gezany Moura
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                <a class="transition hover:text-slate-950" href="#sobre">Sobre</a>
                <a class="transition hover:text-slate-950" href="#solucoes">Solucoes</a>
                <a class="transition hover:text-slate-950" href="#depoimentos">Resultados</a>
                <a class="transition hover:text-slate-950" href="#contato">Contato</a>
            </div>

            <x-atlvs.ui.button
                href="{{ $primaryCtaUrl }}"
                :target="$whatsappUrl ? '_blank' : null"
                :rel="$whatsappUrl ? 'noopener noreferrer' : null"
                aria-label="Agendar uma conversa com Gezany Moura"
                class="hidden sm:inline-flex"
            >
                Agendar conversa
            </x-atlvs.ui.button>
        </nav>
    </header>

    <main id="conteudo">
        <section class="relative overflow-hidden bg-slate-950 text-white">
            <div class="absolute inset-x-0 top-0 h-40 bg-white/5" aria-hidden="true"></div>
            <div class="mx-auto grid min-h-[calc(100vh-4rem)] max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-20">
                <div class="relative z-10 max-w-3xl">
                    <p class="mb-5 inline-flex rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-sky-100">
                        Lideranca, comportamento e empreendedorismo
                    </p>
                    <h1 class="max-w-4xl text-4xl font-black tracking-tight text-white sm:text-6xl lg:text-7xl">
                        Desenvolva lideres e negocios com clareza, metodo e humanidade.
                    </h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                        Gezany Moura ajuda empreendedoras, lideres e equipes a transformar autoconhecimento em decisao, comunicacao e resultados sustentaveis.
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <x-atlvs.ui.button
                            href="{{ $primaryCtaUrl }}"
                            :target="$whatsappUrl ? '_blank' : null"
                            :rel="$whatsappUrl ? 'noopener noreferrer' : null"
                            class="bg-white text-slate-950 hover:bg-slate-100 focus:ring-white"
                        >
                            Quero uma proposta
                            <svg class="h-4 w-4" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.64l-3.22-3.22a.75.75 0 1 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 1 1-1.06-1.06l3.22-3.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/></svg>
                        </x-atlvs.ui.button>
                        <x-atlvs.ui.button href="#solucoes" variant="secondary" class="border-white/20 bg-white/10 text-white hover:bg-white/15 focus:ring-white">
                            Ver solucoes
                        </x-atlvs.ui.button>
                    </div>

                    <dl class="mt-12 grid gap-4 sm:grid-cols-3">
                        @foreach($stats as $stat)
                            <div class="border-l border-white/20 pl-4">
                                <dt class="text-3xl font-black text-white">{{ $stat['value'] }}</dt>
                                <dd class="mt-1 text-sm leading-5 text-slate-300">{{ $stat['label'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="relative z-10">
                    <img
                        src="{{ $heroImage }}"
                        alt="Consultora de lideranca em ambiente profissional de estrategia"
                        class="aspect-[4/5] w-full rounded-lg object-cover shadow-2xl shadow-black/30 ring-1 ring-white/10"
                        width="1024"
                        height="1280"
                        fetchpriority="high"
                    >
                </div>
            </div>
        </section>

        <section id="sobre" class="bg-white py-20 sm:py-28">
            <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-700">Trajetoria e autoridade</p>
                    <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                        Experiencia academica, pratica de mercado e desenvolvimento humano no mesmo metodo.
                    </h2>
                </div>
                <div class="space-y-6 text-lg leading-8 text-slate-600">
                    <p>
                        Gezany Moura atua ha mais de 22 anos na area administrativa comercial e ha mais de 16 anos no ensino superior em Administracao. Sua abordagem combina gestao, comportamento e educacao para apoiar pessoas que precisam crescer sem perder consistencia.
                    </p>
                    <p>
                        Como mestranda em Educacao pela UFRRJ, especialista em Gestao de Pessoas e Master Analista Comportamental, conduz processos de desenvolvimento para lideres, equipes e empreendedoras com foco em clareza, estrategia e aplicacao pratica.
                    </p>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                            <p class="font-bold text-slate-950">Para empresas</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Treinamentos e workshops para lideranca, atendimento, comunicacao e cultura.</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                            <p class="font-bold text-slate-950">Para profissionais</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Mentoria e mapeamento comportamental para decisao, carreira e posicionamento.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-slate-50 py-20 sm:py-28" aria-labelledby="diferenciais-title">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-700">Por que funciona</p>
                    <h2 id="diferenciais-title" class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                        Desenvolvimento que sai da sala e entra na rotina.
                    </h2>
                </div>

                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    @foreach($differentials as $item)
                        <article class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="mb-6 flex h-11 w-11 items-center justify-center rounded-lg bg-sky-50 text-sky-700" aria-hidden="true">
                                @if($item['icon'] === 'target')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>
                                @elseif($item['icon'] === 'workflow')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 4v16M18 4v16"/><path d="M6 8h6a6 6 0 0 1 6 6v2"/><path d="M15 13l3 3 3-3"/></svg>
                                @else
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l1.7 5.2L19 10l-5.3 1.8L12 17l-1.7-5.2L5 10l5.3-1.8L12 3Z"/><path d="M5 17l.7 2.1L8 20l-2.3.9L5 23l-.7-2.1L2 20l2.3-.9L5 17Z"/></svg>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-slate-950">{{ $item['title'] }}</h3>
                            <p class="mt-3 leading-7 text-slate-600">{{ $item['copy'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="solucoes" class="bg-white py-20 sm:py-28" aria-labelledby="solucoes-title">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div class="max-w-3xl">
                        <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-700">Solucoes</p>
                        <h2 id="solucoes-title" class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                            Formatos para acelerar lideranca, atendimento e autoconhecimento.
                        </h2>
                    </div>
                    <x-atlvs.ui.button href="{{ $primaryCtaUrl }}" :target="$whatsappUrl ? '_blank' : null" :rel="$whatsappUrl ? 'noopener noreferrer' : null">
                        Solicitar proposta
                    </x-atlvs.ui.button>
                </div>

                <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($services as $service)
                        @php
                            $description = preg_replace('/\s*\[cite:[^\]]+\]/', '', $service->description);
                        @endphp
                        <article class="flex min-h-72 flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-sky-200 hover:shadow-xl">
                            @if($service->images->isNotEmpty())
                                <div
                                    x-data="{ active: 0, total: {{ $service->images->count() }} }"
                                    class="relative bg-slate-100"
                                    aria-label="Fotos de {{ $service->title }}"
                                >
                                    <div class="aspect-[4/3] overflow-hidden">
                                        @foreach($service->images as $image)
                                            <img
                                                x-show="active === {{ $loop->index }}"
                                                @unless($loop->first) x-cloak @endunless
                                                x-transition.opacity
                                                src="{{ $image->url }}"
                                                alt="Foto de {{ $service->title }}"
                                                class="h-full w-full object-cover"
                                                loading="lazy"
                                            >
                                        @endforeach
                                    </div>

                                    @if($service->images->count() > 1)
                                        <button type="button" class="absolute left-3 top-1/2 grid h-9 w-9 -translate-y-1/2 place-items-center rounded-full bg-white/90 text-slate-900 shadow hover:bg-white" @click="active = active === 0 ? total - 1 : active - 1" aria-label="Foto anterior">
                                            <svg class="h-4 w-4" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 0 1-.02 1.06L9.06 10l3.71 3.71a.75.75 0 1 1-1.06 1.06l-4.24-4.24a.75.75 0 0 1 0-1.06l4.24-4.24a.75.75 0 0 1 1.08 0Z" clip-rule="evenodd"/></svg>
                                        </button>
                                        <button type="button" class="absolute right-3 top-1/2 grid h-9 w-9 -translate-y-1/2 place-items-center rounded-full bg-white/90 text-slate-900 shadow hover:bg-white" @click="active = active === total - 1 ? 0 : active + 1" aria-label="Proxima foto">
                                            <svg class="h-4 w-4" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.08 0Z" clip-rule="evenodd"/></svg>
                                        </button>

                                        <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-1.5">
                                            @foreach($service->images as $image)
                                                <button type="button" class="h-2 w-2 rounded-full bg-white/70 ring-1 ring-black/10" :class="{ 'bg-slate-950': active === {{ $loop->index }} }" @click="active = {{ $loop->index }}" aria-label="Ver foto {{ $loop->iteration }}"></button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="flex flex-1 flex-col p-6">
                                <div class="flex items-center justify-between gap-3">
                                    <x-atlvs.ui.badge variant="info">{{ $service->category }}</x-atlvs.ui.badge>
                                    @if($service->duration)
                                        <span class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $service->duration }}</span>
                                    @endif
                                </div>
                                <h3 class="mt-7 text-2xl font-black tracking-tight text-slate-950">{{ $service->title }}</h3>
                                <p class="mt-4 flex-1 leading-7 text-slate-600">{{ $description }}</p>
                                <a href="{{ $primaryCtaUrl }}" target="{{ $whatsappUrl ? '_blank' : '_self' }}" rel="{{ $whatsappUrl ? 'noopener noreferrer' : '' }}" class="mt-8 inline-flex items-center gap-2 text-sm font-bold text-sky-700 hover:text-sky-900">
                                    Conversar sobre esta solucao
                                    <svg class="h-4 w-4" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.64l-3.22-3.22a.75.75 0 1 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 1 1-1.06-1.06l3.22-3.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/></svg>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-8 text-slate-600 md:col-span-2 lg:col-span-3">
                            As solucoes ainda nao foram cadastradas. Ative os servicos no painel administrativo para exibi-los aqui.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="bg-slate-950 py-20 text-white sm:py-28" aria-labelledby="metodo-title">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-300">Metodo</p>
                        <h2 id="metodo-title" class="mt-4 text-3xl font-black tracking-tight sm:text-5xl">
                            Um processo simples para gerar tracao sem perder profundidade.
                        </h2>
                    </div>
                    <div class="grid gap-4">
                        @foreach($process as $item)
                            <div class="rounded-lg border border-white/10 bg-white/[0.04] p-6">
                                <div class="flex gap-5">
                                    <span class="text-sm font-black text-sky-300">{{ $item['step'] }}</span>
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $item['title'] }}</h3>
                                        <p class="mt-2 leading-7 text-slate-300">{{ $item['copy'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="depoimentos" class="bg-white py-20 sm:py-28" aria-labelledby="depoimentos-title">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-700">Prova social</p>
                    <h2 id="depoimentos-title" class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                        Clientes percebem mudanca em decisao, comunicacao e lideranca.
                    </h2>
                </div>
                <div class="mt-12 grid gap-5 md:grid-cols-2">
                    @foreach($testimonials as $testimonial)
                        <figure class="rounded-lg border border-slate-200 bg-slate-50 p-8">
                            <blockquote class="text-lg leading-8 text-slate-700">
                                "{{ $testimonial['quote'] }}"
                            </blockquote>
                            <figcaption class="mt-8">
                                <p class="font-bold text-slate-950">{{ $testimonial['name'] }}</p>
                                <p class="text-sm font-semibold text-sky-700">{{ $testimonial['role'] }}</p>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-slate-50 py-20 sm:py-28" aria-labelledby="faq-title">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-700">Perguntas frequentes</p>
                    <h2 id="faq-title" class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                        Antes de agendar
                    </h2>
                </div>
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <details class="group rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-lg font-bold text-slate-950">
                                {{ $faq['question'] }}
                                <span class="text-sky-700 transition group-open:rotate-45" aria-hidden="true">+</span>
                            </summary>
                            <p class="mt-4 leading-7 text-slate-600">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="contato" class="bg-white py-20 sm:py-28">
            <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-sky-700">Proximo passo</p>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                    Vamos entender seu desafio e desenhar o melhor formato?
                </h2>
                <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                    Agende uma conversa para avaliar objetivos, publico, carga horaria e o caminho mais adequado para sua equipe ou carreira.
                </p>
                <div class="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
                    <x-atlvs.ui.button href="{{ $primaryCtaUrl }}" :target="$whatsappUrl ? '_blank' : null" :rel="$whatsappUrl ? 'noopener noreferrer' : null">
                        Agendar conversa
                    </x-atlvs.ui.button>
                    @if($email)
                        <x-atlvs.ui.button href="mailto:{{ $email }}" variant="secondary">
                            Enviar e-mail
                        </x-atlvs.ui.button>
                    @endif
                    @if($instagramUrl)
                        <x-atlvs.ui.button href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" variant="ghost">
                            Instagram
                        </x-atlvs.ui.button>
                    @endif
                </div>
                @unless($whatsappUrl || $email || $instagramUrl)
                    <p class="mt-6 text-sm text-slate-500">
                        Configure CONTACT_WHATSAPP_URL, CONTACT_EMAIL ou CONTACT_INSTAGRAM_URL no ambiente para ativar os canais de contato.
                    </p>
                @endunless
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-slate-950 px-4 py-8 text-white sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 text-sm text-slate-300 sm:flex-row sm:items-center sm:justify-between">
            <p class="font-semibold text-white">Gezany Moura</p>
            <p>© {{ date('Y') }} Desenvolvimento comportamental, lideranca e empreendedorismo.</p>
        </div>
    </footer>
</x-atlvs.layout.app>
