<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_requires_authentication(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_filter_projects_by_search_term(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Project::query()->create([
            'title' => 'Lideranca de Alta Performance',
            'description' => 'Treinamento para lideres.',
            'category' => 'Workshop',
            'duration' => '08 horas',
            'is_active' => true,
        ]);

        Project::query()->create([
            'title' => 'Mentoria Evoluir',
            'description' => 'Mentoria individual.',
            'category' => 'Mentoria',
            'duration' => 'Acompanhamento',
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.projects.index', ['q' => 'Lideranca']))
            ->assertOk()
            ->assertSee('Lideranca de Alta Performance')
            ->assertDontSee('Mentoria Evoluir');
    }

    public function test_admin_can_create_project(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.projects.store'), [
                'title' => 'Atendimento 5 Estrelas',
                'description' => 'Workshop para melhorar atendimento e fidelizacao.',
                'category' => 'Workshop',
                'duration' => '08 horas',
                'image_path' => null,
                'is_active' => '1',
                'images' => [
                    $this->fakePng('sala-treinamento.png'),
                    $this->fakePng('workshop.png'),
                ],
            ])
            ->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseHas('projects', [
            'title' => 'Atendimento 5 Estrelas',
            'category' => 'Workshop',
            'is_active' => true,
        ]);

        $project = Project::query()->where('title', 'Atendimento 5 Estrelas')->firstOrFail();

        $this->assertCount(2, $project->images);
        $project->images->each(fn ($image) => Storage::disk('public')->assertExists($image->path));
    }

    private function fakePng(string $name): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'project-image-');

        file_put_contents(
            $path,
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=')
        );

        return new UploadedFile($path, $name, 'image/png', null, true);
    }
}
