<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class GezanyPortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Workshops e Treinamentos
        $servicos = [
            [
                'title' => 'Atendimento 5 Estrelas',
                'description' => 'Transforma atendimento ao cliente em relacionamento, recorrencia e fidelizacao com processos simples de aplicar.',
                'category' => 'Workshop',
                'duration' => '08 ou 16 horas',
                'is_active' => true,
            ],
            [
                'title' => 'Liderança de Alta Performance',
                'description' => 'Desenvolve liderancas com clareza de papel, gestao estrategica, comunicacao e foco em resultados sustentaveis.',
                'category' => 'Workshop',
                'duration' => '08 ou 16 horas',
                'is_active' => true,
            ],
            [
                'title' => 'Inteligência Relacional',
                'description' => 'Aprimora comunicacao, colaboracao e relacoes interpessoais para reduzir conflitos e elevar performance.',
                'category' => 'Workshop',
                'duration' => 'Carga horária a definir',
                'is_active' => true,
            ],
            [
                'title' => 'Mapeamento de Perfil DISC',
                'description' => 'Processo estruturado de autoconhecimento profissional com aplicacao DISC e devolutivas praticas.',
                'category' => 'Consultoria',
                'duration' => 'Sessões individuais',
                'is_active' => true,
            ],
            [
                'title' => 'Mentoria Evoluir',
                'description' => 'Acompanhamento personalizado para empreendedoras e lideres que precisam decidir, priorizar e evoluir com metodo.',
                'category' => 'Mentoria',
                'duration' => 'Acompanhamento estratégico',
                'is_active' => true,
            ],
        ];

        foreach ($servicos as $servico) {
            Project::create($servico);
        }
    }
}
