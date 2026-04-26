<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    'title',
    'description',
    'category',
    'duration',
    'image_path',
    'is_active',
];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
