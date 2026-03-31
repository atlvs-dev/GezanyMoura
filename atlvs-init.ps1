$ErrorActionPreference = "Stop"

Write-Host "🚀 Inicializando ATLVS Template Laravel v1.0"

# Diretórios
$dirs = @(
".github/workflows",
"docker/nginx","docker/php",
"docs",
"app/Http/Middleware",
"app/Http/Controllers/Admin",
"app/Models",
"database/migrations","database/seeders",
"routes",
"resources/views/components/ui",
"resources/views/components/form",
"resources/views/components/layout",
"resources/views/pages/admin/projects",
"resources/views/pages/admin",
"resources/css","resources/js"
)

foreach ($d in $dirs) {
    New-Item -ItemType Directory -Force -Path $d | Out-Null
}

function Write-File($path, $content) {
    $content | Out-File -FilePath $path -Encoding utf8 -Force
}

# docker-compose
Write-File "docker-compose.yml" @"
services:
  app:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    container_name: atlvs_app
    working_dir: /var/www/html
    volumes:
      - ./:/var/www/html
    depends_on:
      - db
      - redis

  nginx:
    image: nginx:alpine
    container_name: atlvs_nginx
    ports:
      - "8080:80"
    volumes:
      - ./:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app

  db:
    image: postgres:16-alpine
    container_name: atlvs_db
    environment:
      POSTGRES_DB: atlvs
      POSTGRES_USER: atlvs
      POSTGRES_PASSWORD: atlvs
    ports:
      - "5432:5432"
    volumes:
      - db_data:/var/lib/postgresql/data

  redis:
    image: redis:7-alpine
    container_name: atlvs_redis
    ports:
      - "6379:6379"

volumes:
  db_data:
"@

# nginx
Write-File "docker/nginx/default.conf" @"
server {
  listen 80;
  server_name _;
  root /var/www/html/public;

  index index.php index.html;

  location / {
    try_files \$uri \$uri/ /index.php?\$query_string;
  }

  location ~ \.php$ {
    try_files \$uri =404;
    fastcgi_pass app:9000;
    fastcgi_index index.php;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
  }
}
"@

# PHP Dockerfile
Write-File "docker/php/Dockerfile" @"
FROM php:8.3-fpm-alpine
RUN apk add --no-cache bash git unzip icu-dev oniguruma-dev libzip-dev postgresql-dev nodejs npm
RUN docker-php-ext-install intl mbstring zip pdo pdo_pgsql
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
CMD ["php-fpm"]
"@

# Middleware
Write-File "app/Http/Middleware/RequireRole.php" @"
<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class RequireRole {
  public function handle(Request \$request, Closure \$next, string \$role) {
    if (!\$request->user() || \$request->user()->role !== \$role) abort(403);
    return \$next(\$request);
  }
}
"@

# Migration role
Write-File "database/migrations/2026_02_05_000001_add_role_to_users_table.php" @"
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    Schema::table('users', function (Blueprint \$table) {
      \$table->string('role',20)->default('user');
    });
  }
  public function down(): void {
    Schema::table('users', function (Blueprint \$table) {
      \$table->dropColumn('role');
    });
  }
};
"@

# Seeder admin
Write-File "database/seeders/AdminUserSeeder.php" @"
<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder {
  public function run(): void {
    User::firstOrCreate(
      ['email'=>'admin@atlvs.local'],
      ['name'=>'Admin ATLVS','password'=>Hash::make('password'),'role'=>'admin']
    );
  }
}
"@

Write-File "database/seeders/DatabaseSeeder.php" @"
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
  public function run(): void {
    \$this->call([AdminUserSeeder::class]);
  }
}
"@

Write-Host "✅ ATLVS Template aplicado com sucesso"
