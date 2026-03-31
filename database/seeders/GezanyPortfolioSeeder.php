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
                'description' => 'Transformando o atendimento ao cliente em resultados consistentes e fidelização[cite: 112].',
                'category' => 'Workshop',
                'duration' => '08 ou 16 horas',
                'is_active' => true,
            ],
            [
                'title' => 'Liderança de Alta Performance',
                'description' => 'Foco em resultados, gestão estratégica e desenvolvimento de competências para líderes[cite: 92, 107].',
                'category' => 'Workshop',
                'duration' => '08 ou 16 horas',
                'is_active' => true,
            ],
            [
                'title' => 'Inteligência Relacional',
                'description' => 'Melhorando relacionamentos interpessoais e resultados organizacionais através da comunicação[cite: 121].',
                'category' => 'Workshop',
                'duration' => 'Carga horária a definir',
                'is_active' => true,
            ],
            [
                'title' => 'Mapeamento de Perfil DISC',
                'description' => 'Processo estruturado de autoconhecimento profissional com aplicação da ferramenta DISC e devolutivas personalizadas[cite: 136, 141].',
                'category' => 'Consultoria',
                'duration' => 'Sessões individuais',
                'is_active' => true,
            ],
            [
                'title' => 'Mentoria Evoluir',
                'description' => 'Processo personalizado de desenvolvimento profissional com foco em resultados concretos[cite: 131, 133].',
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