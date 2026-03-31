@php($title = 'Entrar')

<x-guest-layout>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md">
      {{-- Brand --}}
      <div class="text-center mb-6">
        <div class="mx-auto h-12 w-12 rounded-2xl bg-gray-900 text-white grid place-items-center text-lg font-semibold">A</div>
        <div class="mt-3 text-xl font-semibold tracking-tight text-gray-900">ATLVS</div>
        <div class="mt-1 text-sm text-gray-600">Acesse sua conta para continuar</div>
      </div>

      <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
          <div class="text-sm font-semibold text-gray-900">Login</div>
          <div class="text-sm text-gray-600">Informe seus dados de acesso</div>
        </div>

        <div class="px-6 py-6">
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
              <x-input-label for="email" value="Email" />
              <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" required autofocus />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
              <x-input-label for="password" value="Senha" />
              <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-gray-900" name="remember">
                <span class="ms-2 text-sm text-gray-600">Manter conectado</span>
              </label>

              <a href="{{ route('password.request') }}" class="text-sm underline text-gray-700 hover:text-gray-900">
                Esqueci minha senha
              </a>
            </div>

            <div class="pt-2 space-y-3">
              <button class="w-full h-10 rounded-xl bg-gray-900 text-white text-sm font-medium hover:bg-gray-800">
                Entrar
              </button>

              <a href="{{ route('register') }}"
                 class="w-full h-10 rounded-xl border border-gray-300 text-sm font-medium hover:bg-gray-100 inline-flex items-center justify-center">
                Criar conta
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
