<x-atlvs.layout.app>
    <section class="bg-white py-24 px-6 text-center border-b border-slate-100">
        <h1 class="text-5xl font-extrabold text-slate-900 sm:text-7xl tracking-tight">
            Gezany Moura
        </h1>
        <p class="mt-6 text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Desenvolvimento Comportamental e Liderança de Alta Performance. Capacitando líderes e equipes para impulsionar o crescimento pessoal e profissional.
        </p>
        <div class="mt-10 flex justify-center gap-4">
            <x-atlvs.ui.button href="#servicos">
                Ver Treinamentos
            </x-atlvs.ui.button>
            <x-atlvs.ui.button href="#contato" variant="secondary">
                Falar no WhatsApp
            </x-atlvs.ui.button>
        </div>
    </section>

    <section id="sobre" class="py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="aspect-[4/5] bg-slate-100 rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                        <div class="flex items-center justify-center h-full text-slate-400 bg-slate-200">
                            <span class="text-center px-4 font-medium italic">Foto Profissional<br>Gezany Moura</span>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white p-8 rounded-2xl shadow-xl hidden md:block">
                        <p class="text-4xl font-bold">+22</p>
                        <p class="text-sm uppercase tracking-wider font-semibold">Anos de Mercado</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-8 flex items-center">
                        <span class="w-8 h-1 bg-blue-600 mr-4"></span>
                        Trajetória e Propósito
                    </h2>
                    <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                        Atuo há mais de **22 anos na área administrativa comercial** e há mais de **16 anos no ensino superior** em Administração. Ajudo mulheres empreendedoras e profissionais a alavancar seus projetos por meio do autoconhecimento.
                    </p>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        Desenvolvo carreiras de líderes que desejam expandir resultados com **segurança, clareza e estratégia**.
                    </p>
                    
                    <ul class="grid grid-cols-1 gap-4">
                        <li class="flex items-start bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <span class="text-blue-600 font-bold mr-3">✔</span>
                            <span class="text-slate-700 font-medium">Mestranda em Educação (UFRRJ) e Especialista em Gestão de Pessoas.</span>
                        </li>
                        <li class="flex items-start bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <span class="text-blue-600 font-bold mr-3">✔</span>
                            <span class="text-slate-700 font-medium">Master Analista Comportamental (IBC e ILG).</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold">Diferenciais que Geram Valor</h2>
                <div class="h-1 w-20 bg-blue-500 mx-auto mt-4"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="space-y-4">
                    <div class="text-4xl">🔬</div>
                    <h3 class="text-xl font-bold italic">Embasamento Científico</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Experiência prática aliada a fundamentação teórica robusta.</p>
                </div>
                <div class="space-y-4">
                    <div class="text-4xl">⚙</div>
                    <h3 class="text-xl font-bold italic">Metodologia Estruturada</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Processos personalizados e metodologias exclusivas para cada líder.</p>
                </div>
                <div class="space-y-4">
                    <div class="text-4xl">📊</div>
                    <h3 class="text-xl font-bold italic">Foco em Resultados</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Desenvolvimento sustentável focado em resultados mensuráveis.</p>
                </div>
                <div class="space-y-4">
                    <div class="text-4xl">🌱</div>
                    <h3 class="text-xl font-bold italic">Qualidade de Vida</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Performance voltada para a saúde física e mental dos colaboradores.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="servicos" class="py-20 bg-slate-50 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900">Portfólio de Soluções</h2>
                <p class="text-slate-500 mt-2">Treinamentos estruturados para aumentar produtividade e engajamento.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <x-atlvs.ui.card class="hover:shadow-2xl transition-shadow duration-300">
                        <div class="p-8">
                            <x-atlvs.ui.badge class="mb-4 bg-blue-100 text-blue-700">{{ $service->category }}</x-atlvs.ui.badge>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $service->title }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">{{ $service->description }}</p>
                            
                            @if($service->duration)
                                <div class="flex items-center text-xs font-bold text-slate-400 uppercase tracking-widest border-t border-slate-100 pt-4">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Duração: {{ $service->duration }}
                                </div>
                            @endif
                        </div>
                    </x-atlvs.ui.card>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-16 italic text-slate-900">Depoimentos</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-slate-50 p-8 rounded-3xl relative">
                    <p class="text-slate-600 italic mb-6">"A ferramenta utilizada me fez mudar a visão para com meus liderados. Gerou grande mudança na organização e nos trouxe resultados reais para a equipe."</p>
                    <p class="font-bold text-slate-900">Sara Emília</p>
                    <p class="text-sm text-blue-600 uppercase font-bold tracking-tighter">CEO - Habib's</p>
                </div>
                
                <div class="bg-slate-50 p-8 rounded-3xl">
                    <p class="text-slate-600 italic mb-6">"Foi maravilhoso descobrir que estou no caminho certo. Agora sei como gosto de ser reconhecida e como motivar minha equipe. Autoconhecimento é fundamental."</p>
                    <p class="font-bold text-slate-900">Marluce Oliveira</p>
                    <p class="text-sm text-blue-600 uppercase font-bold tracking-tighter">Gestora de RH</p>
                </div>
            </div>
        </div>
    </section>

    <footer id="contato" class="py-12 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <blockquote class="text-xl text-slate-700 italic max-w-3xl mx-auto mb-8">
                "A tecnologia reinventará os negócios, mas as relações humanas continuarão sendo a chave do sucesso."
            </blockquote>
            <p class="text-slate-400 text-sm">© {{ date('Y') }} Gezany Moura - Desenvolvimento Comportamental.</p>
        </div>
    </footer>
</x-atlvs.layout.app>