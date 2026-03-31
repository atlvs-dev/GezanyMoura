# 🚀 ATLVS – Laravel Template (Laravel 11)

Template oficial da **ATLVS** para desenvolvimento de aplicações web com Laravel 11, focado em **padronização**, **produtividade** e **escala**.

Este repositório serve como **base inicial** para todos os projetos da empresa.

---

## 🎯 Objetivo do Template

Este template existe para garantir que todos os projetos:

- sigam o **mesmo padrão técnico**
- sejam fáceis de manter por qualquer membro da equipe
- tenham **auth + RBAC** prontos desde o início
- rodem de forma consistente em qualquer máquina (Docker)
- evitem decisões repetidas de stack e estrutura

> ❗ **Todo projeto novo da ATLVS deve nascer a partir deste template.**

---

## 🧱 Stack Oficial ATLVS

### Backend
- Laravel 11
- PHP 8.3
- PostgreSQL
- Redis

### Frontend
- Blade
- Tailwind CSS
- Alpine.js

### Infra / DevOps
- Docker + Docker Compose
- Nginx
- GitHub Actions (CI)
- Vite

---

## 📁 Estrutura Geral do Projeto

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   └── Middleware/
│       └── RequireRole.php
│
database/
├── migrations/
├── seeders/
│   ├── AdminUserSeeder.php
│   └── DatabaseSeeder.php
│
resources/
├── views/
│   ├── components/
│   │   ├── atlvs/
│   │   │   ├── layout/
│   │   │   └── ui/
│   │   └── (components do Breeze)
│   └── pages/
│       └── admin/
│
routes/
├── web.php
└── admin.php
```

🔐 Autenticação e RBAC
Autenticação

Implementada com Laravel Breeze (Blade)

RBAC (Role-Based Access Control)

Campo role na tabela users

Roles iniciais:

admin

user

Middleware de Role
```text
middleware('role:admin')
```

Arquivo:
```text
app/Http/Middleware/RequireRole.php
```

Registro do alias (Laravel 11):
```text
// bootstrap/app.php
$middleware->alias([
    'role' => \App\Http\Middleware\RequireRole::class,
]);
```

👤 Usuário Admin Padrão

Criado automaticamente via seeder:
```text
Email: admin@atlvs.local
Senha: password
Role: admin
```

Seeder:
```text
database/seeders/AdminUserSeeder.php
```

🧭 Painel Administrativo

URL: /admin/dashboard

Protegido por:

auth

role:admin

Arquivo de rotas:
```text
routes/admin.php
```

🧩 CRUD de Exemplo (Projects)

Este template inclui um CRUD completo de exemplo (Projects) para demonstrar o padrão oficial de desenvolvimento da ATLVS.

O objetivo não é o domínio em si, mas servir como referência para novos módulos.

📍 Localização dos Arquivos

Controller
```text
app/Http/Controllers/Admin/ProjectController.php
```
Model
```text
app/Models/Project.php
```
Form Requests (validação)
```text
app/Http/Requests/ProjectStoreRequest.php
app/Http/Requests/ProjectUpdateRequest.php
```
Migration
```text
database/migrations/*_create_projects_table.php
```
Views
```text
resources/views/pages/admin/projects/
├── index.blade.php
├── create.blade.php
├── edit.blade.php
└── _form.blade.php
```
Rotas
```text
routes/admin.php
```
🧠 Padrões Adotados no CRUD
✔️ Form Requests

Toda validação fica fora do controller

Controllers devem permanecer finos

Facilita testes, reutilização e APIs futuras

Exemplo:
```text
public function store(ProjectStoreRequest $request)
{
    Project::create($request->validated());
}
```
✔️ UI Components (ATLVS)

O CRUD utiliza componentes reutilizáveis da ATLVS:
```text
<x-atlvs.ui.alert />
<x-atlvs.ui.badge />
<x-atlvs.ui.button />
<x-atlvs.ui.card />
```
Local:
```text
resources/views/components/atlvs/ui/
```
✔️ UX Corporativa

Ações em dropdown

Empty state com CTA

Feedback visual claro (alerts e badges)

Busca integrada à listagem

📐 Padrão para Novos Módulos

Todo novo módulo administrativo deve seguir este fluxo:

Migration

Model

Form Requests

Controller (Admin)

Views (pages/admin)

Rotas protegidas por auth + role

❌ Evitar:

Validação inline em controllers

Lógica de negócio em views

Rotas admin sem middleware

🐳 Rodando o Projeto com Docker
Subir o projeto
```text
docker compose up -d --build
```
Rodar migrations + seed
```text
docker compose exec app php artisan migrate:fresh --seed
```
Acessar
```text
http://localhost:8080
```
🗺️ Roadmap do Template
v1.0 ✅

Docker

Auth

RBAC

Admin dashboard

UI base

v1.1 ✅

CRUD exemplo (Projects)

Form Requests

UX corporativa

v1.2 (próximo)

Policies

Service Layer

Logs e auditoria

✍️ Autor

ATLVS
Template mantido internamente pela equipe de desenvolvimento.
