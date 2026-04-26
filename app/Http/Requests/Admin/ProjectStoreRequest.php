<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:1200'],
            'category' => ['required', 'string', 'max:80'],
            'duration' => ['nullable', 'string', 'max:80'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', Rule::in(['0', '1'])],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'titulo',
            'description' => 'descricao',
            'category' => 'categoria',
            'duration' => 'duracao',
            'image_path' => 'imagem',
            'is_active' => 'status',
        ];
    }
}
